<?php

/**
 * Gemeinsame Funktionen der Smoke-Tests (smoke-test.php, panel-smoke-test.php).
 *
 * Erwartet die globale Variable $projectRoot: das Projekt, in dem getestet
 * wird (die Arbeitskopie). Pfade in Meldungen werden relativ dazu ausgegeben.
 */

use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Cms\User;

/**
 * Gleiche Meldungen werden zusammengefasst: Ein kaputtes Feld in einem
 * Block, den 400 Seiten benutzen, erscheint einmal mit der Liste der Seiten.
 */
final class Report
{
    /** @var array<string, array<string, array{0: string, 1: string, 2: array<string, true>}>> Teil => key => [stufe, was, wo[]] */
    public static array $items = [];
    public static array $counts = [];

    public static function add(string $part, string $level, string $where, string $what): void
    {
        $key = $level . '|' . $what;
        self::$items[$part][$key] ??= [$level, $what, []];
        self::$items[$part][$key][2][$where] = true;
    }

    public static function has(string $part, string $level, string $what): bool
    {
        return isset(self::$items[$part][$level . '|' . $what]);
    }

    public static function count(string $part, string $what, int $n = 1): void
    {
        self::$counts[$part][$what] = (self::$counts[$part][$what] ?? 0) + $n;
    }

    public static function errors(string|null $part = null): int
    {
        $n = 0;
        foreach (self::$items as $p => $items) {
            if ($part !== null && $p !== $part) {
                continue;
            }
            foreach ($items as [$level]) {
                $n += $level === 'FEHLER' ? 1 : 0;
            }
        }
        return $n;
    }

    public static function print(string $part, bool $verbose): void
    {
        $items = array_values(self::$items[$part] ?? []);
        $order = ['FEHLER' => 0, 'WARNUNG' => 1, 'HINWEIS' => 2];
        usort($items, fn ($a, $b) => [$order[$a[0]], -count($a[2]), $a[1]] <=> [$order[$b[0]], -count($b[2]), $b[1]]);

        foreach (self::$counts[$part] ?? [] as $what => $n) {
            printf("  %-34s %6d\n", $what . ':', $n);
        }

        $hidden = 0;
        foreach ($items as [$level, $what, $wheres]) {
            if ($level === 'HINWEIS' && !$verbose) {
                $hidden++;
                continue;
            }

            $lines = explode("\n", $what);
            echo "\n  [$level] ", array_shift($lines), "\n";
            foreach ($lines as $line) {
                echo "      $line\n";
            }

            $wheres = array_keys($wheres);
            $show   = $verbose ? $wheres : array_slice($wheres, 0, 5);
            echo '      ', count($wheres) === 1 ? 'bei:' : 'bei ' . count($wheres) . ' Stellen:', "\n";
            foreach ($show as $where) {
                echo "        - $where\n";
            }
            if (count($show) < count($wheres)) {
                echo '        ... und ', count($wheres) - count($show), " weitere (alle mit -v)\n";
            }
        }

        $byLevel = array_count_values(array_column($items, 0));
        printf(
            "\n  => %d Fehler, %d Warnungen, %d Hinweise (verschiedene Meldungen)%s\n",
            $byLevel['FEHLER'] ?? 0,
            $byLevel['WARNUNG'] ?? 0,
            $byLevel['HINWEIS'] ?? 0,
            $hidden > 0 ? ' – Hinweise mit -v anzeigen' : ''
        );
    }
}

function heading(string $text): void
{
    echo "\n", str_repeat('=', 78), "\n", $text, "\n", str_repeat('=', 78), "\n";
}

function progress(string $label, int $done, int $total): void
{
    if (!stream_isatty(STDOUT)) {
        return;
    }
    printf("\r  %s %d/%d   ", $label, $done, $total);
    if ($done >= $total) {
        echo "\r", str_repeat(' ', 60), "\r";
    }
}

/** Pfad relativ zum Projekt, damit die Meldungen kurz bleiben. */
function rel(string $file): string
{
    global $projectRoot;
    return str_starts_with($file, $projectRoot . '/') ? substr($file, strlen($projectRoot) + 1) : $file;
}

/**
 * Erste Stelle im eigenen Code (site/, index.php) im Stacktrace,
 * sonst die Stelle, an der die Exception geworfen wurde.
 */
function ownFrame(Throwable $e): string
{
    global $projectRoot;
    $frames = [['file' => $e->getFile(), 'line' => $e->getLine()], ...$e->getTrace()];
    foreach ($frames as $frame) {
        $file = $frame['file'] ?? '';
        if (str_starts_with($file, $projectRoot . '/site/') || $file === $projectRoot . '/index.php') {
            return rel($file) . ':' . ($frame['line'] ?? '?');
        }
    }
    return rel($e->getFile()) . ':' . $e->getLine();
}

function describe(Throwable $e): string
{
    $text = (new ReflectionClass($e))->getShortName() . ': ' . trim($e->getMessage()) . "\n" . 'bei ' . ownFrame($e);
    if ($e->getPrevious() !== null) {
        $text .= "\nausgelöst durch: " . trim($e->getPrevious()->getMessage());
    }
    return $text;
}

/**
 * Fängt Warnungen und Deprecations ab, die während $fn auftreten, und
 * meldet sie mit der Stelle im eigenen Code.
 */
function withErrors(string $part, string $where, Closure $fn): mixed
{
    global $projectRoot;

    set_error_handler(function (int $no, string $msg, string $file, int $line) use ($part, $where, $projectRoot) {
        // mit @ unterdrückt (z. B. exif_read_data bei PNGs in Kirby)
        if ((error_reporting() & $no) === 0) {
            return true;
        }

        $type = match ($no) {
            E_DEPRECATED, E_USER_DEPRECATED => 'Deprecated',
            E_NOTICE, E_USER_NOTICE         => 'Notice',
            default                         => 'Warning',
        };

        // Stelle im eigenen Code suchen
        $own = null;
        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $frame) {
            $f = $frame['file'] ?? '';
            if (str_starts_with($f, $projectRoot . '/site/')) {
                $own = rel($f) . ':' . ($frame['line'] ?? '?');
                break;
            }
        }

        $level = $type === 'Deprecated' ? 'WARNUNG' : 'FEHLER';
        Report::add($part, $level, $own ?? $where, "$type: $msg\n(" . rel($file) . ":$line)");
        return true;
    });

    try {
        return $fn();
    } finally {
        restore_error_handler();
    }
}

/**
 * Kopiert das Projekt ohne .git, node_modules und media in den Temp-Ordner.
 * macOS: `cp -c` (APFS-Clone), Linux: `cp --reflink=auto`, sonst normale Kopie.
 */
function makeCopy(string $source): string
{
    $target = sys_get_temp_dir() . '/kgs-smoke-' . bin2hex(random_bytes(4));
    mkdir($target);
    $target = realpath($target);

    // erst ganz am Ende löschen: Whoops (aus vendor/ der Kopie) läuft
    // ebenfalls beim Beenden und lädt dabei noch Klassen nach
    register_shutdown_function(fn () => register_shutdown_function(fn () => removeCopy($target)));

    $clone = PHP_OS_FAMILY === 'Darwin' ? 'cp -c -R' : 'cp -R --reflink=auto';

    foreach (scandir($source) as $entry) {
        if (in_array($entry, ['.', '..', '.git', 'node_modules', 'media'], true)) {
            continue;
        }
        $args = escapeshellarg("$source/$entry") . ' ' . escapeshellarg("$target/$entry");
        exec("$clone $args 2>/dev/null", $out, $code);
        if ($code !== 0) {
            exec("cp -R $args", $out, $code);
        }
        if ($code !== 0) {
            throw new RuntimeException("Kopieren von $entry fehlgeschlagen");
        }
    }

    mkdir("$target/media");
    return $target;
}

function removeCopy(string $target): void
{
    // nur den eigenen Temp-Ordner löschen
    if (str_starts_with(basename($target), 'kgs-smoke-') && str_starts_with($target, realpath(sys_get_temp_dir()) . '/') && is_dir($target)) {
        exec('rm -rf ' . escapeshellarg($target));
    }
}

/**
 * Alle Seiten inkl. Entwürfe. Nicht $site->index(true): Gibt es eine Seite
 * als Entwurf und veröffentlicht mit derselben ID, enthält der Index nur eine.
 *
 * @return list<Page>
 */
function allPages(Site $site): array
{
    $pages = [];
    $walk  = function ($parent) use (&$walk, &$pages) {
        foreach ([$parent->children(), $parent->drafts()] as $collection) {
            foreach ($collection as $page) {
                $pages[] = $page;
                $walk($page);
            }
        }
    };
    $walk($site);
    return $pages;
}

/** Startet `php -S` mit Kirbys Router und wartet, bis der Server antwortet. */
function startServer(string $root, int $port, int $workers, string $log): mixed
{
    // Läuft dort schon etwas (z. B. ein alter Testserver), würden wir
    // gegen den falschen Server testen
    if ($socket = @fsockopen('127.0.0.1', $port, $errno, $errstr, 0.2)) {
        fclose($socket);
        throw new RuntimeException("Port $port ist schon belegt. Anderen Port mit --port=... wählen oder den Prozess beenden (lsof -i :$port)");
    }

    $cmd = [
        PHP_BINARY,
        '-d', 'display_errors=0',
        '-d', 'log_errors=1',
        '-d', 'error_reporting=' . E_ALL,
        '-d', 'error_log=' . $log,
        '-d', 'memory_limit=512M',
        '-d', 'max_execution_time=120',
        '-S', '127.0.0.1:' . $port,
        '-t', $root,
        $root . '/kirby/router.php',
    ];

    $env = [
        ...getenv(),
        'PHP_CLI_SERVER_WORKERS' => (string)$workers,
        // macOS: sonst stürzen geforkte Worker ab, sobald eine Systembibliothek
        // Objective-C initialisiert („Empty reply from server“)
        'OBJC_DISABLE_INITIALIZE_FORK_SAFETY' => 'YES',
    ];
    $proc = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['file', '/dev/null', 'a'], 2 => ['file', '/dev/null', 'a']], $pipes, $root, $env);

    if (!is_resource($proc)) {
        throw new RuntimeException('PHP-Server konnte nicht gestartet werden');
    }

    // auch bei Abbruch durch eine Exception aufräumen
    register_shutdown_function(fn () => stopServer($proc));

    for ($i = 0; $i < 100; $i++) {
        $socket = @fsockopen('127.0.0.1', $port, $errno, $errstr, 0.1);
        if ($socket) {
            fclose($socket);
            return $proc;
        }
        usleep(100_000);
    }

    proc_terminate($proc);
    throw new RuntimeException("PHP-Server antwortet nicht auf Port $port (belegt? --port=... versuchen)");
}

/**
 * Beendet den PHP-Server samt Workern. proc_terminate() allein beendet nur
 * den Hauptprozess, die Worker würden den Port weiter belegen.
 */
function stopServer(mixed $proc): void
{
    if (!is_resource($proc)) {
        return;
    }

    $pid = proc_get_status($proc)['pid'];
    exec('pkill -TERM -P ' . (int)$pid . ' 2>/dev/null');
    proc_terminate($proc);
    proc_close($proc);
}

/**
 * Ruft URLs (Pfade relativ zu $base) parallel per GET ab.
 *
 * @param list<string> $paths
 * @return array<string, array{status: int, type: string, location: string|null, body: string, zeit: float, fehler: string|null}>
 */
function fetchAll(string $base, array $paths, int $parallel, string $label, array $headers = []): array
{
    $requests = [];
    foreach ($paths as $path) {
        $requests[$path] = ['url' => $base . $path, 'headers' => $headers];
    }
    return httpMulti($requests, $parallel, $label);
}

/**
 * Standard-Accept wie ein Browser, außer die Anfrage setzt ihren eigenen.
 * Wichtig: Kirby antwortet bei Fehlern mit JSON nur, wenn der Client JSON
 * bevorzugt, sonst mit der Whoops-Seite (Status 500).
 */
function acceptHeader(array $headers): array
{
    foreach ($headers as $header) {
        if (stripos($header, 'Accept:') === 0) {
            return $headers;
        }
    }
    return [...$headers, 'Accept: text/html,application/xhtml+xml,*/*;q=0.8'];
}

/**
 * Führt HTTP-Anfragen parallel aus.
 *
 * @param array<string, array{url: string, method?: string, headers?: list<string>, body?: string, cookie?: string}> $requests
 * @param Closure|null $onResult fn(string $key, array $result): void
 * @return array<string, array{status: int, type: string, location: string|null, body: string, zeit: float, fehler: string|null}>
 */
function httpMulti(array $requests, int $parallel, string $label, Closure|null $onResult = null): array
{
    // Mit $onResult wird jede Antwort sofort verarbeitet und nicht
    // gesammelt (sonst bei >10.000 Panel-Anfragen zu viel Speicher)
    $done = 0;
    $results = [];
    $queue   = $requests;
    $total   = count($requests);
    $multi   = curl_multi_init();
    $active  = [];

    $start = function (string $key, array $req) use ($multi, &$active) {
        $ch = curl_init($req['url']);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => acceptHeader($req['headers'] ?? []),
            CURLOPT_ENCODING       => '',
            CURLOPT_CUSTOMREQUEST  => $req['method'] ?? 'GET',
        ]);
        if (isset($req['body'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req['body']);
        }
        if (isset($req['cookie'])) {
            curl_setopt($ch, CURLOPT_COOKIE, $req['cookie']);
        }
        curl_multi_add_handle($multi, $ch);
        $active[(int)$ch] = [$ch, $key, microtime(true)];
    };

    while ($queue !== [] || $active !== []) {
        while ($queue !== [] && count($active) < $parallel) {
            $key = array_key_first($queue);
            $start((string)$key, $queue[$key]);
            unset($queue[$key]);
        }

        curl_multi_exec($multi, $running);
        curl_multi_select($multi, 0.2);

        while ($info = curl_multi_info_read($multi)) {
            $ch               = $info['handle'];
            [, $path, $begin] = $active[(int)$ch];
            unset($active[(int)$ch]);

            $result = [
                'status'   => (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
                'type'     => (string)curl_getinfo($ch, CURLINFO_CONTENT_TYPE),
                'location' => curl_getinfo($ch, CURLINFO_REDIRECT_URL) ?: null,
                'body'     => (string)curl_multi_getcontent($ch),
                'zeit'     => microtime(true) - $begin,
                'fehler'   => $info['result'] !== CURLE_OK ? curl_error($ch) : null,
            ];

            curl_multi_remove_handle($multi, $ch);

            if ($onResult !== null) {
                $onResult($path, $result);
            } else {
                $results[$path] = $result;
            }
            progress($label, ++$done, $total);
        }
    }

    curl_multi_close($multi);
    return $results;
}

/** Fehlermeldung aus einer Whoops-Seite (Debug-Modus) herausholen. */
function whoopsMessage(string $html): string|null
{
    if (!preg_match('!<span id="plain-exception">(.*?)</span>!s', $html, $m)) {
        return null;
    }

    global $projectRoot;
    $plain = html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
    $lines = explode("\n", trim($plain));
    $text  = str_replace($projectRoot . '/', '', $lines[0]);

    // erste Zeile des Stacktraces im eigenen Code
    foreach ($lines as $line) {
        if (str_contains($line, $projectRoot . '/site/')) {
            $text .= "\n" . trim(str_replace($projectRoot . '/', '', $line));
            break;
        }
    }

    return $text;
}

/**
 * Sucht in den Props einer Panel-Ansicht rekursiv nach den Fehlerboxen,
 * die Kirby 6 statt eines kaputten Felds oder einer kaputten Section zeigt
 * (Blueprint::fieldError, Normalizer::sectionError, doppelte Feldnamen).
 *
 * @return list<string>
 */
function findErrorFields(mixed $props, string $path = ''): array
{
    if (!is_array($props)) {
        return [];
    }

    $found = [];

    if (
        ($props['type'] ?? null) === 'info' &&
        ($props['theme'] ?? null) === 'negative' &&
        (
            ($props['label'] ?? null) === 'Error' ||
            str_contains((string)($props['name'] ?? ''), '-duplicate-') ||
            str_starts_with((string)($props['text'] ?? ''), 'The following section types are available')
        )
    ) {
        $found[] = 'Fehlerbox im Panel: ' . trim(strip_tags((string)($props['text'] ?? ''))) . "\nFeld: " . fieldPath($path);
    }

    foreach ($props as $key => $value) {
        if (is_array($value)) {
            array_push($found, ...findErrorFields($value, $path . '.' . $key));
        }
    }

    return $found;
}

/**
 * Lesbarer Feldpfad aus dem Pfad in den Props, z. B.
 * „text > Block tabelle > tabellehead“. Gleiche Felder in der Ansicht
 * und im Tab ergeben denselben Pfad und werden zusammengefasst.
 */
function fieldPath(string $path): string
{
    $segments = explode('.', ltrim($path, '.'));
    $out      = [];
    foreach ($segments as $i => $segment) {
        $prev = $segments[$i - 1] ?? null;
        if ($prev === 'fields' && !is_numeric($segment)) {
            $out[] = $segment;
        } elseif ($prev === 'fieldsets') {
            $out[] = 'Block ' . $segment;
        }
    }
    return $out === [] ? ltrim($path, '.') : implode(' > ', $out);
}

function modelLabel(ModelWithContent $model): string
{
    return match (true) {
        $model instanceof Site => 'site',
        $model instanceof Page => ($model->isDraft() ? 'Entwurf ' : 'Seite ') . $model->id() . ' [' . $model->intendedTemplate()->name() . ']',
        $model instanceof User => 'Benutzer ' . $model->email() . ' [' . $model->role()->id() . ']',
        $model instanceof File => 'Datei ' . $model->id() . ' [' . ($model->template() ?? 'default') . ']',
    };
}

/** true, wenn Find::… das Model liefert, false bei NotFound/Permission. */
function findsModel(Closure $find): bool
{
    try {
        return $find() !== null;
    } catch (Kirby\Exception\NotFoundException | Kirby\Exception\PermissionException) {
        return false;
    }
}

/** Liegt die Seiten-ID in einem der Bereiche? (unabhängig vom Plugin berechnet) */
function inArea(string $id, array $roots): bool
{
    $id = strtolower($id);
    foreach ($roots as $root) {
        $root = strtolower($root);
        if ($id === $root || str_starts_with($id, $root . '/')) {
            return true;
        }
    }
    return false;
}
