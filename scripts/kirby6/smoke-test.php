<?php

/**
 * Smoke-Test für die ganze Homepage: findet Fehler, ohne dass man jede
 * Seite von Hand öffnen muss.
 *
 * Der Test läuft auf einer Kopie des Projekts im Temp-Ordner (unter macOS
 * per APFS-Clone: sofort fertig, kein zusätzlicher Platz). Das ist nötig,
 * weil Kirby beim Aufbau von Panel-Ansichten und beim Rendern fehlende
 * UUIDs erzeugt und in die Content-Dateien schreibt. Am echten Projekt
 * (content/, media/, site/) ändert sich dadurch nichts.
 *
 * Drei Teile (einzeln abwählbar mit --nur=...):
 *
 *   frontend  Startet einen lokalen PHP-Server (wie `php -S`) und ruft jede
 *             veröffentlichte Seite auf, dazu Repräsentationen (.json, .xml),
 *             Sitemap, Suche, Blog-Pagination, Tag-Filter und die 404-Seite.
 *             Gemeldet werden Statuscodes, PHP-Fehler/Warnungen/Deprecations
 *             (Debug-Modus ist lokal an, Whoops macht daraus eine 500),
 *             leere Seiten und Seiten ohne <title>.
 *             Danach werden alle internen Links, CSS- und JS-Dateien aus den
 *             Seiten geprüft. Viele Fehler zeigen sich nur dort (z. B. auf
 *             Seite 28 der Blog-Pagination). Mit --medien auch Bilder und
 *             Downloads unter /media (erzeugt dabei Thumbnails, dauert länger).
 *
 *   panel     Baut für Site, jede Seite (auch Entwürfe), jede Datei und jeden
 *             Benutzer die Panel-Ansicht so auf, wie Kirby sie ans Panel
 *             schickt: alle Tabs, alle Felder und Sections, Seitenlisten
 *             (mit Daten), Picker. Kirby 6 ersetzt kaputte Felder durch eine
 *             rote Fehlerbox, statt abzubrechen; genau diese Boxen sucht der
 *             Test. Außerdem wird für jede Vorlage, die irgendwo angelegt
 *             werden darf, eine neue (nicht gespeicherte) Seite aufgebaut,
 *             wie im Dialog „Seite anlegen“. Damit werden auch Blueprints
 *             geprüft, für die es noch keinen Content gibt.
 *
 *   rechte    Legt in einem temporären Ordner pro eingeschränkter Rolle
 *             (kgs.bereichsrechte) einen Benutzer an und prüft für jede
 *             Seite: außerhalb des Bereichs nicht zugänglich und keine
 *             Aktion erlaubt, innerhalb zugänglich und Panel-Ansicht ohne
 *             Fehler. Dateien außerhalb des Bereichs dürfen nicht
 *             zugänglich sein. Panel-Startseite und Menü müssen auf
 *             existierende Seiten zeigen.
 *
 * Aufruf (im Projektordner):
 *   php scripts/kirby6/smoke-test.php
 *   php scripts/kirby6/smoke-test.php --nur=frontend --medien
 *   php scripts/kirby6/smoke-test.php --speichern=/tmp/k6.json
 *   php scripts/kirby6/smoke-test.php --vergleich=/tmp/k5.json
 *
 * Optionen:
 *   --nur=frontend,panel,rechte   nur diese Teile (Standard: alle)
 *   --ohne-links                  interne Links, CSS und JS nicht prüfen
 *   --medien                      zusätzlich Dateien unter /media prüfen
 *   --worker=8                    parallele Anfragen an den PHP-Server
 *   --port=8765                   Port des PHP-Servers
 *   --projekt=/pfad               anderes Projekt testen (z. B. ein
 *                                 Worktree von master mit Kirby 5)
 *   --speichern=datei.json        Ergebnis der Seiten speichern (Referenz)
 *   --vergleich=datei.json        mit gespeicherter Referenz vergleichen:
 *                                 geänderte Statuscodes, Titel und
 *                                 sichtbarer Text werden gemeldet
 *   -v                            auch Hinweise und Details ausgeben
 *
 * Referenz unter Kirby 5 erstellen (nur der Frontend-Teil läuft dort).
 * Der Content muss in beiden Ständen gleich sein, sonst vergleicht man
 * Content-Änderungen statt Kirby-Versionen:
 *   git worktree add /tmp/homepage-k5 master
 *   (cd /tmp/homepage-k5 && composer install)
 *   php scripts/kirby6/smoke-test.php --projekt=/tmp/homepage-k5 \
 *       --nur=frontend --speichern=/tmp/k5.json
 *   php scripts/kirby6/smoke-test.php --vergleich=/tmp/k5.json
 *   git worktree remove /tmp/homepage-k5
 *
 * Was der Vergleich findet, sieht man im Fehlerlog nicht: z. B. Felder, die
 * Kirby 6 anders liest (fehlende Fächer, Downloads). Der Kalender auf der
 * Startseite hängt vom Abruf der ICS-Datei ab und kann sich zwischen zwei
 * Läufen unterscheiden.
 *
 * Exit-Code 0 = keine Fehler, 1 = Fehler gefunden, 2 = Test konnte nicht laufen.
 */

require __DIR__ . '/lib.php';

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Cms\User;

// ---------------------------------------------------------------------------
// Optionen
// ---------------------------------------------------------------------------

$opts = getopt('v', ['nur:', 'ohne-links', 'medien', 'worker:', 'port:', 'projekt:', 'speichern:', 'vergleich:', 'hilfe']);

if (isset($opts['hilfe'])) {
    preg_match('!/\*\*(.*?)\*/!s', file_get_contents(__FILE__), $m);
    echo preg_replace('!^ ?\* ?!m', '', $m[1]), "\n";
    exit(0);
}

$projectRoot = realpath($opts['projekt'] ?? dirname(__DIR__, 2));
$parts       = isset($opts['nur']) ? array_map('trim', explode(',', $opts['nur'])) : ['frontend', 'panel', 'rechte'];
$checkLinks  = !isset($opts['ohne-links']);
$checkMedia  = isset($opts['medien']);
$workers     = max(1, (int)($opts['worker'] ?? 8));
$port        = (int)($opts['port'] ?? 8765);
$verbose     = isset($opts['v']);

if ($projectRoot === false || !is_file($projectRoot . '/kirby/bootstrap.php')) {
    fwrite(STDERR, "Kein Kirby-Projekt gefunden: " . ($opts['projekt'] ?? '') . "\n");
    exit(2);
}

// ---------------------------------------------------------------------------
// Ergebnisse sammeln und ausgeben
// ---------------------------------------------------------------------------

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

// ---------------------------------------------------------------------------
// Kopie des Projekts anlegen und Kirby darin starten
// ---------------------------------------------------------------------------

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

$sourceRoot  = $projectRoot;
echo "Smoke-Test: ", $sourceRoot, "\n";
$projectRoot = makeCopy($sourceRoot);
echo "Arbeitskopie: ", $projectRoot, "\n";

$kirby     = k6Boot($projectRoot);
$isKirby6  = version_compare(App::version(), '6.0.0-alpha', '>=');
$startTime = microtime(true);

echo "Kirby ", App::version(), ", PHP ", PHP_VERSION, "\n";

if (!$isKirby6) {
    $skipped = array_intersect($parts, ['panel', 'rechte']);
    if ($skipped !== []) {
        echo "Hinweis: Teile ", implode(', ', $skipped), " gibt es nur unter Kirby 6, werden übersprungen.\n";
    }
    $parts = array_values(array_diff($parts, ['panel', 'rechte']));
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

// ===========================================================================
// Teil 1: Frontend
// ===========================================================================

/**
 * Liste der zu prüfenden URLs (Pfad => Infos).
 *
 * @return array<string, array{erwartet: list<int>, quelle: string}>
 */
function frontendUrls(App $kirby): array
{
    $urls = [];
    $add  = function (string $path, string $source, array $expected = [200]) use (&$urls) {
        $urls[$path] ??= ['erwartet' => $expected, 'quelle' => $source];
    };

    $templates = $kirby->root('templates');

    foreach ($kirby->site()->index() as $page) {
        $path = $page->isHomePage() ? '/' : '/' . $page->uri();
        $tpl  = $page->intendedTemplate()->name();
        $file = $templates . '/' . $tpl . '.php';

        // Vorlagen, die absichtlich weiterleiten (go(...) in der ersten Zeilen)
        $redirects = is_file($file) && preg_match('!^\s*go\(!m', implode("\n", array_slice(file($file), 0, 10)));
        $expected = match (true) {
            $redirects           => [301, 302],
            $page->isErrorPage() => [404],
            default              => [200],
        };
        $add($path, 'Seite ' . $page->id(), $expected);

        // Repräsentationen wie blogs.json.php oder countdown.json.php
        foreach (glob($templates . '/' . $tpl . '.*.php') as $representation) {
            $ext = explode('.', basename($representation))[1];
            $add(rtrim($path, '/') . ($page->isHomePage() ? '/home' : '') . '.' . $ext, 'Repräsentation ' . basename($representation));
        }

        // Pagination und Tag-Filter (Controller blogs.php)
        if ($tpl === 'blogs') {
            // alle Seiten der Pagination und alle Tags: jede Seite zeigt
            // andere Blogkarten, ein Fehler steckt oft nur in einer davon
            $articles = $page->children()->listed();
            for ($n = 2; $n <= (int)ceil($articles->count() / 10); $n++) {
                $add($path . '/page:' . $n, 'Pagination ' . $page->id());
            }
            foreach ($articles->pluck('tags', ',', true) as $tag) {
                $add($path . '?tag=' . rawurlencode($tag), 'Tag-Filter ' . $page->id());
            }
        }

        if ($tpl === 'search') {
            $add($path . '?q=schule', 'Suche mit Treffern');
            $add($path . '?q=' . rawurlencode('ö"<x>'), 'Suche mit Sonderzeichen');
            $add($path, 'Suche ohne Begriff');
        }
    }

    // Routen aus der Config
    $add('/sitemap.xml', 'Route sitemap.xml');
    $add('/sitemap', 'Route sitemap (Weiterleitung)', [301]);

    // Fehlerseite
    $add('/smoke-test-gibt-es-nicht', 'Fehlerseite', [404]);

    // Panel muss erreichbar sein (leitet ohne Login auf die Anmeldung um)
    $add('/' . trim($kirby->option('panel.slug', 'panel'), '/'), 'Panel', [200, 302]);

    return $urls;
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
 * Ruft URLs parallel ab.
 *
 * @param list<string> $paths
 * @return array<string, array{status: int, type: string, location: string|null, body: string, zeit: float, fehler: string|null}>
 */
function fetchAll(string $base, array $paths, int $parallel, string $label): array
{
    $results = [];
    $queue   = $paths;
    $total   = count($paths);
    $multi   = curl_multi_init();
    $active  = [];

    $start = function (string $path) use ($base, $multi, &$active) {
        $ch = curl_init($base . $path);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Accept: text/html,application/xhtml+xml,*/*;q=0.8'],
            CURLOPT_ENCODING       => '',
        ]);
        curl_multi_add_handle($multi, $ch);
        $active[(int)$ch] = [$ch, $path, microtime(true)];
    };

    while ($queue !== [] || $active !== []) {
        while ($queue !== [] && count($active) < $parallel) {
            $start(array_shift($queue));
        }

        curl_multi_exec($multi, $running);
        curl_multi_select($multi, 0.2);

        while ($info = curl_multi_info_read($multi)) {
            $ch               = $info['handle'];
            [, $path, $begin] = $active[(int)$ch];
            unset($active[(int)$ch]);

            $results[$path] = [
                'status'   => (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
                'type'     => (string)curl_getinfo($ch, CURLINFO_CONTENT_TYPE),
                'location' => curl_getinfo($ch, CURLINFO_REDIRECT_URL) ?: null,
                'body'     => (string)curl_multi_getcontent($ch),
                'zeit'     => microtime(true) - $begin,
                'fehler'   => $info['result'] !== CURLE_OK ? curl_error($ch) : null,
            ];

            curl_multi_remove_handle($multi, $ch);
            progress($label, count($results), $total);
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

/** Sichtbarer Text einer HTML-Seite (für den Vergleich mit der Referenz). */
function visibleText(string $html): string
{
    $html = preg_replace('!<(script|style|noscript|svg|template)\b.*?</\1>!is', ' ', $html);
    $html = preg_replace('#<!--.*?-->#s', ' ', $html);
    $text = html_entity_decode(strip_tags(preg_replace('!<[^>]+>!', ' $0 ', $html)), ENT_QUOTES | ENT_HTML5);
    // Media-Hashes (/media/pages/…/496cbb8ee4-1795155947/bild.jpg) ändern
    // sich mit der Kirby-Version, das ist kein inhaltlicher Unterschied
    $text = preg_replace('!/[a-f0-9]{10}-\d+/!', '/#/', $text);
    return trim(preg_replace('!\s+!u', ' ', $text));
}

/**
 * Interne Links und eingebundene Dateien einer HTML-Seite.
 *
 * @return list<string> Pfade inkl. Query
 */
function internalLinks(string $html, string $pagePath, string $base): array
{
    preg_match_all('!\b(?:href|src)\s*=\s*(["\'])(.*?)\1!is', $html, $m);
    preg_match_all('!\bsrcset\s*=\s*(["\'])(.*?)\1!is', $html, $s);

    $candidates = $m[2];
    foreach ($s[2] as $srcset) {
        foreach (explode(',', $srcset) as $entry) {
            $candidates[] = strtok(trim($entry), ' ');
        }
    }

    $links = [];
    foreach ($candidates as $url) {
        $url = html_entity_decode(trim($url), ENT_QUOTES | ENT_HTML5);

        // JS-/Alpine-Platzhalter wie ${station.bild} oder {{ x }} sind keine Links
        if ($url === '' || preg_match('!^(#|mailto:|tel:|javascript:|data:|webcal:)!i', $url) || preg_match('!\$\{|\{\{!', $url)) {
            continue;
        }

        // absolute URL auf den eigenen Server oder auf die Live-Domain
        if (preg_match('!^(https?:)?//([^/]+)(.*)$!i', $url, $parts)) {
            $host = strtolower($parts[2]);
            if ($base !== 'http://' . $host && !preg_match('!(^|\.)kgs-rastede\.de$!', $host)) {
                continue;
            }
            if ($base !== 'http://' . $host) {
                continue; // Links auf die Live-Domain nicht lokal prüfen
            }
            $url = $parts[3] ?: '/';
        } elseif (!str_starts_with($url, '/')) {
            // relativer Link
            $url = rtrim(dirname($pagePath . 'x'), '/') . '/' . $url;
        }

        $url = strtok($url, '#');
        if ($url !== false && $url !== '') {
            $links[] = $url;
        }
    }

    return array_values(array_unique($links));
}

function runFrontend(App $kirby, string $projectRoot, int $port, int $workers, bool $checkLinks, bool $checkMedia): array
{
    heading('Teil 1: Frontend');

    $notfall = $kirby->page('wichtige-informationen');
    if ($notfall !== null && $notfall->togglenotfall()->toBool() && $notfall->notfallredirect()->toBool()) {
        Report::add('frontend', 'WARNUNG', 'wichtige-informationen', 'Notfallmodus mit Weiterleitung ist aktiv: alle Seiten leiten auf die Startseite um.');
    }

    $urls = frontendUrls($kirby);
    $log  = tempnam(sys_get_temp_dir(), 'smoke-php-log-');
    $base = 'http://127.0.0.1:' . $port;

    echo "  Starte PHP-Server auf $base mit $workers Workern ...\n";
    $server = startServer($projectRoot, $port, $workers, $log);

    $snapshot = [];

    try {
        // Startseite einmal vorweg, damit Caches/Thumbs-Jobs nicht parallel entstehen
        fetchAll($base, ['/'], 1, 'Aufwärmen');

        $results = fetchAll($base, array_keys($urls), $workers, 'Seiten');
        $linkSources = [];

        foreach ($results as $path => $r) {
            $info     = $urls[$path];
            $where    = $path . '  (' . $info['quelle'] . ')';
            $isHtml   = str_contains($r['type'], 'html');
            $expected = $info['erwartet'];

            Report::count('frontend', 'URLs abgerufen');

            if ($r['fehler'] !== null) {
                Report::add('frontend', 'FEHLER', $where, 'Keine Antwort: ' . $r['fehler']);
                continue;
            }

            if (!in_array($r['status'], $expected, true)) {
                $msg = 'Status ' . $r['status'] . ' (erwartet ' . implode('/', $expected) . ')';
                if ($r['location']) {
                    $where .= ' -> ' . $r['location'];
                }
                if ($whoops = whoopsMessage($r['body'])) {
                    $msg .= "\n" . $whoops;
                }
                Report::add('frontend', 'FEHLER', $where, $msg);
            }

            // PHP-Ausgaben, die trotz Status 200 im HTML stehen
            if (preg_match('!(<b>)?(Fatal error|Warning|Notice|Deprecated|Parse error)(</b>)?:\s.{0,200}!', $r['body'], $m)) {
                Report::add('frontend', 'FEHLER', $where, 'PHP-Meldung im HTML: ' . strip_tags($m[0]));
            }

            if ($r['status'] === 200) {
                if (trim($r['body']) === '') {
                    Report::add('frontend', 'FEHLER', $where, 'Leere Antwort');
                } elseif ($isHtml && !preg_match('!<title>\s*\S!i', $r['body'])) {
                    Report::add('frontend', 'WARNUNG', $where, 'HTML ohne <title>');
                }

                if (str_contains($r['type'], 'json') && json_decode($r['body']) === null && json_last_error() !== JSON_ERROR_NONE) {
                    Report::add('frontend', 'FEHLER', $where, 'Ungültiges JSON: ' . json_last_error_msg());
                }

                if (str_contains($r['type'], 'xml') && !str_contains($r['type'], 'html')) {
                    libxml_use_internal_errors(true);
                    if (simplexml_load_string($r['body']) === false) {
                        Report::add('frontend', 'FEHLER', $where, 'Ungültiges XML: ' . trim(libxml_get_errors()[0]->message ?? '?'));
                    }
                    libxml_clear_errors();
                }

                if ($r['zeit'] > 5) {
                    Report::add('frontend', 'HINWEIS', $where, sprintf('Langsam: %.1f s', $r['zeit']));
                }
            }

            if ($isHtml && $r['status'] === 200) {
                preg_match('!<title>(.*?)</title>!is', $r['body'], $t);
                $text = visibleText($r['body']);
                $snapshot[$path] = [
                    'status' => $r['status'],
                    'titel'  => trim(html_entity_decode($t[1] ?? '', ENT_QUOTES | ENT_HTML5)),
                    'text'   => $text,
                    'links'  => count(internalLinks($r['body'], $path, $base)),
                ];

                if ($checkLinks) {
                    foreach (internalLinks($r['body'], $path, $base) as $link) {
                        $linkSources[$link][] = $path;
                    }
                }
            } else {
                $snapshot[$path] = ['status' => $r['status']];
            }
        }

        // ---- Links, CSS, JS, Medien ----------------------------------------
        if ($checkLinks) {
            $panel = '/' . trim($kirby->option('panel.slug', 'panel'), '/');
            $todo  = [];
            foreach (array_keys($linkSources) as $link) {
                $linkPath = strtok($link, '?');
                if (isset($results[$link]) || str_starts_with($linkPath, $panel) || str_starts_with($linkPath, '/api')) {
                    continue;
                }
                if (!$checkMedia && str_starts_with($linkPath, '/media/')) {
                    continue;
                }
                $todo[] = $link;
            }

            echo "  Prüfe ", count($todo), " interne Links und Dateien ...\n";
            foreach (fetchAll($base, $todo, $workers, 'Links') as $link => $r) {
                Report::count('frontend', 'Links/Dateien geprüft');
                if ($r['fehler'] !== null || $r['status'] >= 400) {
                    $sources = array_values(array_unique($linkSources[$link]));
                    $more    = count($sources) > 3 ? ' +' . (count($sources) - 3) : '';
                    $where   = $link . '  (verlinkt auf ' . implode(', ', array_slice($sources, 0, 3)) . $more . ')';
                    $msg     = $r['status'] >= 500 || $r['fehler'] !== null
                        ? 'Link führt zu Status ' . ($r['fehler'] ?? $r['status'])
                        : 'Toter interner Link (Status ' . $r['status'] . ')';
                    if ($whoops = whoopsMessage($r['body'])) {
                        $msg .= "\n" . $whoops;
                    }
                    Report::add('frontend', $r['status'] >= 500 || $r['fehler'] !== null ? 'FEHLER' : 'WARNUNG', $where, $msg);
                }
            }
        }
    } finally {
        stopServer($server);
    }

    // ---- PHP-Fehlerlog des Servers -----------------------------------------
    $logLines = is_file($log) ? file($log, FILE_IGNORE_NEW_LINES) : [];
    foreach ($logLines as $line) {
        if (!preg_match('!PHP (Fatal error|Warning|Notice|Deprecated|Parse error|Kirby|.*Exception)!', $line)) {
            continue;
        }
        $line = preg_replace('!^\[[^\]]+\]\s*!', '', str_replace($projectRoot . '/', '', $line));
        Report::add('frontend', str_contains($line, 'Deprecated') ? 'WARNUNG' : 'FEHLER', 'PHP-Fehlerlog des Servers', mb_strimwidth($line, 0, 400, '...'));
    }
    @unlink($log);

    return $snapshot;
}

/** Vergleicht das Frontend mit einer gespeicherten Referenz. */
function compareSnapshot(array $now, array $reference): void
{
    heading('Vergleich mit Referenz');

    $changed = 0;

    foreach ($reference as $path => $ref) {
        if (!isset($now[$path])) {
            Report::add('vergleich', 'WARNUNG', $path, 'In der Referenz, jetzt nicht mehr geprüft (Seite gelöscht?)');
            continue;
        }

        $cur = $now[$path];

        if ($ref['status'] !== $cur['status']) {
            Report::add('vergleich', 'FEHLER', $path, "Status vorher {$ref['status']}, jetzt {$cur['status']}");
            continue;
        }

        if (($ref['titel'] ?? null) !== ($cur['titel'] ?? null)) {
            Report::add('vergleich', 'WARNUNG', $path, "Titel geändert\nvorher: {$ref['titel']}\njetzt:  {$cur['titel']}");
        }

        if (isset($ref['text'], $cur['text']) && $ref['text'] !== $cur['text']) {
            $changed++;
            // erste unterschiedliche Stelle mit etwas Kontext zeigen
            $a = $ref['text'];
            $b = $cur['text'];
            $i = 0;
            $max = min(strlen($a), strlen($b));
            while ($i < $max && $a[$i] === $b[$i]) {
                $i++;
            }
            $from = max(0, $i - 40);
            $snip = fn ($s) => mb_strcut($s, $from, 120);
            Report::add('vergleich', 'WARNUNG', $path, sprintf(
                "Sichtbarer Text geändert (%d -> %d Zeichen)\nvorher: …%s…\njetzt:  …%s…",
                strlen($a),
                strlen($b),
                $snip($a),
                $snip($b)
            ));
        }

        if (isset($ref['links'], $cur['links']) && $ref['links'] !== $cur['links']) {
            Report::add('vergleich', 'HINWEIS', $path, "Anzahl interner Links vorher {$ref['links']}, jetzt {$cur['links']}");
        }
    }

    foreach (array_diff_key($now, $reference) as $path => $_) {
        Report::add('vergleich', 'HINWEIS', $path, 'Neu (nicht in der Referenz)');
    }

    Report::count('vergleich', 'Seiten verglichen', count(array_intersect_key($now, $reference)));
    Report::count('vergleich', 'davon Text geändert', $changed);
}

// ===========================================================================
// Teil 2: Panel
// ===========================================================================

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

/** Panel-Controller für ein Model, wie Kirby ihn für die Ansicht benutzt. */
function viewController(ModelWithContent $model): object
{
    return match (true) {
        $model instanceof Site => new Kirby\Panel\Controller\View\SiteViewController($model),
        $model instanceof Page => new Kirby\Panel\Controller\View\PageViewController($model),
        $model instanceof User => new Kirby\Panel\Controller\View\UserViewController($model),
        $model instanceof File && $model->parent() instanceof Page => new Kirby\Panel\Controller\View\PageFileViewController($model),
        $model instanceof File && $model->parent() instanceof User => new Kirby\Panel\Controller\View\UserFileViewController($model),
        $model instanceof File => new Kirby\Panel\Controller\View\SiteFileViewController($model),
    };
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

/**
 * Baut die komplette Panel-Ansicht eines Models auf, inklusive aller Tabs,
 * der Daten aller Listen und der Elemente aller Picker.
 *
 * @return list<string> gefundene Probleme
 */
function checkPanelView(ModelWithContent $model): array
{
    $problems = [];

    $controller = viewController($model);

    // Die Ansicht so, wie sie ans Panel geht (aktiver Tab = erster Tab)
    $view = $controller->load()->render();
    if (json_encode($view, JSON_PARTIAL_OUTPUT_ON_ERROR) === false) {
        $problems[] = 'Ansicht lässt sich nicht als JSON ausgeben: ' . json_last_error_msg();
    }
    array_push($problems, ...findErrorFields($view, 'ansicht'));

    // Alle weiteren Tabs
    $fields = $controller->fields();
    foreach ($model->blueprint()->tabs() as $tab) {
        array_push($problems, ...findErrorFields($tab->toViewProps($fields), 'tab ' . $tab->name()));
    }

    // Seiten-/Dateilisten laden ihre Daten über die API nach,
    // Picker die Anzeige der ausgewählten Elemente
    foreach ($fields as $field) {
        try {
            if ($field instanceof Kirby\Form\Field\ModelListField) {
                $state = $field->state();
                array_push($problems, ...findErrorFields($state, 'liste ' . $field->name()));
            } elseif ($field instanceof Kirby\Form\Field\ModelPickerField) {
                // löst die gespeicherte Auswahl in Panel-Elemente auf
                $field->toFormValue();
            }
        } catch (Throwable $e) {
            $problems[] = 'Feld ' . $field->name() . ': ' . describe($e);
        }
    }

    // Validierung, wie beim Veröffentlichen
    try {
        $fields->errors();
    } catch (Throwable $e) {
        $problems[] = 'Validierung: ' . describe($e);
    }

    return $problems;
}

function runPanel(App $kirby): void
{
    heading('Teil 2: Panel');

    $kirby->impersonate('kirby');

    $site   = $kirby->site();
    $models = [$site, ...$site->files()];
    foreach (allPages($site) as $page) {
        $models[] = $page;
        foreach ($page->files() as $file) {
            $models[] = $file;
        }
    }
    foreach ($kirby->users() as $user) {
        $models[] = $user;
    }

    $total = count($models);
    $usedTemplates = [];

    foreach ($models as $i => $model) {
        $label = modelLabel($model);
        progress('Panel-Ansichten', $i + 1, $total);
        Report::count('panel', match (true) {
            $model instanceof Page => 'Seiten',
            $model instanceof File => 'Dateien',
            $model instanceof User => 'Benutzer',
            default                => 'Site',
        });

        if ($model instanceof Page) {
            $usedTemplates[$model->intendedTemplate()->name()] = true;
            if (!is_file($kirby->root('blueprints') . '/pages/' . $model->intendedTemplate()->name() . '.yml')) {
                Report::add('panel', 'HINWEIS', $label, 'Kein eigener Blueprint, Kirby nimmt pages/default.yml');
            }
        }

        try {
            $problems = withErrors('panel', $label, fn () => checkPanelView($model));
            foreach ($problems as $problem) {
                Report::add('panel', 'FEHLER', $label, $problem);
            }
        } catch (Throwable $e) {
            Report::add('panel', 'FEHLER', $label, 'Ansicht bricht ab: ' . describe($e));
        }
    }

    // ---- Neue Seiten wie im Dialog „Seite anlegen“ -------------------------
    // Für jede Kombination aus Eltern-Vorlage und erlaubter Kind-Vorlage
    // eine nicht gespeicherte Seite aufbauen (MemoryStorage).
    $combos = [];
    foreach ([$site, ...allPages($site)] as $parent) {
        try {
            $blueprints = withErrors('panel', modelLabel($parent), fn () => $parent->blueprints());
        } catch (Throwable $e) {
            Report::add('panel', 'FEHLER', modelLabel($parent), 'Erlaubte Vorlagen für neue Seiten: ' . describe($e));
            continue;
        }
        $parentTpl = $parent instanceof Site ? 'site' : $parent->intendedTemplate()->name();
        foreach ($blueprints as $bp) {
            $combos[$parentTpl . ' > ' . $bp['name']] ??= [$parent, $bp['name']];
        }
    }

    $i = 0;
    foreach ($combos as $combo => [$parent, $template]) {
        progress('Neue Seiten', ++$i, count($combos));
        $label = 'Neue Seite ' . $combo . ' (unter ' . ($parent instanceof Site ? 'site' : $parent->id()) . ')';
        Report::count('panel', 'Vorlagen für neue Seiten');
        $usedTemplates[$template] = true;

        try {
            $problems = withErrors('panel', $label, function () use ($parent, $template) {
                $page = Page::factory([
                    'slug'     => 'smoke-test-' . bin2hex(random_bytes(4)),
                    'template' => $template,
                    'model'    => $template,
                    'parent'   => $parent instanceof Page ? $parent : null,
                    'content'  => ['title' => 'Smoke-Test'],
                ]);
                $page->changeStorage(Kirby\Content\MemoryStorage::class);

                $problems = checkPanelView($page);

                // Felder, die schon im Dialog abgefragt werden
                $create = $page->blueprint()->create();
                foreach ((array)($create['fields'] ?? []) as $name) {
                    if (is_string($name) && $name !== 'title' && $name !== 'slug' && $page->blueprint()->field($name) === null) {
                        $problems[] = "create.fields nennt das Feld '$name', das es im Blueprint nicht gibt";
                    }
                }

                return $problems;
            });
            foreach ($problems as $problem) {
                Report::add('panel', 'FEHLER', $label, $problem);
            }
        } catch (Throwable $e) {
            Report::add('panel', 'FEHLER', $label, 'Ansicht bricht ab: ' . describe($e));
        }
    }

    // ---- Blueprints ohne Verwendung ---------------------------------------
    foreach (glob($kirby->root('blueprints') . '/pages/*.yml') as $file) {
        $name = basename($file, '.yml');
        if (!isset($usedTemplates[$name])) {
            Report::add('panel', 'HINWEIS', 'site/blueprints/pages/' . $name . '.yml', 'Blueprint wird von keiner Seite benutzt und darf nirgends neu angelegt werden (ungeprüft)');
        }
    }

    $kirby->impersonate(null);
}

// ===========================================================================
// Teil 3: Bereichsrechte
// ===========================================================================

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

function runRechte(App $kirby): void
{
    heading('Teil 3: Bereichsrechte');

    $config = $kirby->option('kgs.bereichsrechte', []);
    if ($config === []) {
        Report::add('rechte', 'WARNUNG', 'config.php', 'kgs.bereichsrechte ist leer, nichts zu prüfen');
        return;
    }

    // Konfiguration selbst prüfen
    foreach ($config as $role => $roots) {
        if ($kirby->roles()->find($role) === null) {
            Report::add('rechte', 'FEHLER', "kgs.bereichsrechte.$role", "Die Rolle '$role' gibt es nicht (site/blueprints/users/$role.yml fehlt)");
        }
        foreach ($roots as $root) {
            if ($kirby->page($root) === null) {
                Report::add('rechte', 'FEHLER', "kgs.bereichsrechte.$role", "Bereich '$root' gibt es nicht als Seite");
            }
        }
    }
    foreach ($kirby->roles() as $role) {
        if ($role->id() !== 'admin' && !isset($config[$role->id()])) {
            Report::add('rechte', 'WARNUNG', 'site/blueprints/users/' . $role->id() . '.yml', 'Rolle ohne Eintrag in kgs.bereichsrechte: sieht das ganze Panel');
        }
    }

    // Temporäre Benutzer in einem eigenen accounts-Ordner, damit
    // site/accounts unangetastet bleibt
    $accounts = sys_get_temp_dir() . '/smoke-accounts-' . bin2hex(random_bytes(4));
    mkdir($accounts);

    foreach (array_keys($config) as $role) {
        $id = 'smoke' . substr(md5($role), 0, 3);
        mkdir("$accounts/$id");
        file_put_contents("$accounts/$id/index.php", '<?php return ' . var_export([
            'email'    => "smoke-$role@example.invalid",
            'language' => 'de',
            'name'     => "Smoke $role",
            'role'     => $role,
        ], true) . ';');
    }

    try {
        $kirby = $kirby->clone(['roots' => ['accounts' => $accounts]]);
        $pages = allPages($kirby->site());

        foreach ($config as $role => $roots) {
            if ($kirby->roles()->find($role) === null) {
                continue;
            }

            $user = $kirby->impersonate("smoke-$role@example.invalid");
            if ($user === null) {
                Report::add('rechte', 'FEHLER', $role, 'Testbenutzer konnte nicht angelegt werden');
                continue;
            }

            $tag = "Rolle $role";
            Report::count('rechte', 'Rollen');

            // Panel-Startseite und Menü
            try {
                $home = Kgs\Bereichsrechte\Bereiche::panelHome();
                $menu = Kgs\Bereichsrechte\Bereiche::panelMenu();
                foreach ([$home, ...array_column($menu ?? [], 'link')] as $link) {
                    $id = str_replace('+', '/', substr((string)$link, strlen('pages/')));
                    if ($kirby->page($id) === null) {
                        Report::add('rechte', 'FEHLER', $tag, "Panel-Startseite/Menü zeigt auf '$link', die Seite gibt es nicht");
                    }
                }
            } catch (Throwable $e) {
                Report::add('rechte', 'FEHLER', $tag, 'Panel-Startseite/Menü: ' . describe($e));
            }

            // Account-Ansicht der Rolle (Benutzer-Blueprint)
            try {
                foreach (withErrors('rechte', $tag, fn () => checkPanelView($user)) as $problem) {
                    Report::add('rechte', 'FEHLER', "$tag, eigenes Konto", $problem);
                }
            } catch (Throwable $e) {
                Report::add('rechte', 'FEHLER', "$tag, eigenes Konto", describe($e));
            }

            // Site: neue Seiten auf oberster Ebene darf keine eingeschränkte Rolle anlegen
            if (Kgs\Bereichsrechte\Bereiche::allows($kirby->site()) !== false) {
                Report::add('rechte', 'FEHLER', $tag, 'Die Site gilt als erlaubter Bereich');
            }

            $innerhalb = 0;
            $total     = count($pages);

            foreach ($pages as $i => $page) {
                progress("Rechte $role", $i + 1, $total);
                $where    = "$tag, " . modelLabel($page);
                $expected = inArea($page->id(), $roots);

                try {
                    $accessible   = $page->isAccessible();
                    $availability = $page->guards()->availability();
                } catch (Throwable $e) {
                    Report::add('rechte', 'FEHLER', $where, describe($e));
                    continue;
                }

                if ($expected === false) {
                    if ($accessible) {
                        Report::add('rechte', 'FEHLER', $where, 'Außerhalb des Bereichs, aber zugänglich');
                    }
                    $allowed = array_keys(array_filter($availability));
                    if ($allowed !== []) {
                        Report::add('rechte', 'FEHLER', $where, 'Außerhalb des Bereichs, aber erlaubt: ' . implode(', ', $allowed));
                    }
                    if (!($page instanceof Kgs\Bereichsrechte\BereichsPage)) {
                        Report::add('rechte', 'FEHLER', $where, 'Page-Model ' . get_class($page) . ' erbt nicht von BereichsPage');
                    }

                    // So lösen Panel und API eine Seite auf (/api/pages/...)
                    if (findsModel(fn () => Kirby\Cms\Find::page($page->id()))) {
                        Report::add('rechte', 'FEHLER', $where, 'Außerhalb des Bereichs, aber über Panel/API abrufbar (Find::page)');
                    }

                    $panelPath = 'pages/' . str_replace('/', '+', $page->id());
                    foreach ($page->files() as $file) {
                        $fileWhere = "$tag, " . modelLabel($file);
                        if (findsModel(fn () => Kirby\Cms\Find::file($panelPath, $file->filename()))) {
                            Report::add('rechte', 'FEHLER', $fileWhere, 'Datei außerhalb des Bereichs ist über Panel/API abrufbar (Find::file)');
                        } elseif ($file->isAccessible()) {
                            Report::add('rechte', 'HINWEIS', $fileWhere,
                                "Datei außerhalb des Bereichs meldet isAccessible() = true.\n" .
                                "Panel und API prüfen vorher die Seite, die Dateisuche nur Dateien zugänglicher Seiten.\n" .
                                "Erreichbar wäre die Datei nur über eine Picker-Query, die Dateien anderer Bereiche liefert."
                            );
                        }
                    }
                    continue;
                }

                $innerhalb++;

                if (!$accessible) {
                    Report::add('rechte', 'WARNUNG', $where, 'Im Bereich, aber nicht zugänglich (Blueprint-Optionen der Rolle?)');
                    continue;
                }

                if (!findsModel(fn () => Kirby\Cms\Find::page($page->id()))) {
                    Report::add('rechte', 'FEHLER', $where, 'Im Bereich, aber über Panel/API nicht abrufbar (Find::page)');
                }

                // Panel-Ansicht mit den Rechten der Rolle. Was schon im
                // Panel-Teil (als Admin) aufgefallen ist, nicht wiederholen.
                try {
                    foreach (withErrors('rechte', $where, fn () => checkPanelView($page)) as $problem) {
                        if (!Report::has('panel', 'FEHLER', $problem)) {
                            Report::add('rechte', 'FEHLER', $where, $problem);
                        }
                    }
                } catch (Throwable $e) {
                    Report::add('rechte', 'FEHLER', $where, 'Panel-Ansicht bricht ab: ' . describe($e));
                }
            }

            Report::count('rechte', "Seiten im Bereich $role", $innerhalb);
            $kirby->impersonate(null);
        }
    } finally {
        foreach (glob("$accounts/*/*") as $f) {
            @unlink($f);
        }
        foreach (glob("$accounts/*", GLOB_ONLYDIR) as $d) {
            @rmdir($d);
        }
        @rmdir($accounts);
        $kirby->impersonate(null);
    }
}

// ===========================================================================
// Ablauf
// ===========================================================================

$snapshot = null;

try {
    if (in_array('frontend', $parts, true)) {
        $snapshot = runFrontend($kirby, $projectRoot, $port, $workers, $checkLinks, $checkMedia);
        Report::print('frontend', $verbose);
    }

    if (in_array('panel', $parts, true)) {
        runPanel($kirby);
        Report::print('panel', $verbose);
    }

    if (in_array('rechte', $parts, true)) {
        runRechte($kirby);
        Report::print('rechte', $verbose);
    }
} catch (Throwable $e) {
    fwrite(STDERR, "\nTest abgebrochen: " . describe($e) . "\n");
    exit(2);
}

if ($snapshot !== null && isset($opts['speichern'])) {
    file_put_contents($opts['speichern'], json_encode([
        'kirby'  => App::version(),
        'datum'  => date('c'),
        'seiten' => $snapshot,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "\nReferenz gespeichert: ", $opts['speichern'], "\n";
}

if (isset($opts['vergleich'])) {
    if ($snapshot === null) {
        echo "\nVergleich braucht den Frontend-Teil.\n";
    } else {
        $ref = json_decode((string)@file_get_contents($opts['vergleich']), true);
        if (!isset($ref['seiten'])) {
            fwrite(STDERR, "Referenz nicht lesbar: {$opts['vergleich']}\n");
            exit(2);
        }
        echo "Referenz: Kirby {$ref['kirby']} vom {$ref['datum']}\n";
        compareSnapshot($snapshot, $ref['seiten']);
        Report::print('vergleich', $verbose);
    }
}

$errors = Report::errors();
heading(sprintf('Ergebnis: %d Fehler (%.0f s)', $errors, microtime(true) - $startTime));

exit($errors > 0 ? 1 : 0);
