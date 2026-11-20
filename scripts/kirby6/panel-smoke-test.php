<?php

/**
 * Smoke-Test für das Panel über HTTP, so wie der Browser es benutzt.
 *
 * Ergänzt Teil 2 und 3 von smoke-test.php: Dort werden die Panel-Ansichten
 * direkt in PHP aufgebaut. Hier läuft jede Anfrage durch Router, Login,
 * Session, CSRF-Prüfung, Panel-Bereiche und API, also durch alles, was
 * im Browser dazwischen liegt. Vue/JavaScript wird nicht ausgeführt.
 *
 * Ablauf: Arbeitskopie des Projekts anlegen, dort einen Admin und pro
 * eingeschränkter Rolle (kgs.bereichsrechte) einen Testbenutzer anlegen,
 * PHP-Server starten, jeden Benutzer über das echte Login-Formular
 * anmelden und dann die Anfragen stellen.
 *
 *   admin   Jede Ansicht (Site, Seiten mit allen Tabs, Dateien, Benutzer,
 *           Konto, System), die Dialoge jeder Seite (Status, Titel, Vorlage,
 *           Löschen, Duplizieren, Verschieben, Sortieren), „Seite anlegen“
 *           für jede erlaubte Vorlage, die Dropdowns, Seiten- und
 *           Dateilisten (API), Picker-Dialoge und ausgewählte Elemente,
 *           das Formular jedes Block-Typs und die Picker in Blöcken, die
 *           Dialoge der Dateien, die Suche und den Seitenbaum.
 *           Gemeldet werden Abstürze (5xx, kaputtes JSON), Fehlerboxen in
 *           Ansichten und Ansichten, die nicht laden.
 *
 *   Rollen  Startseite und Menü des Panels, Bereiche (Site, Benutzer,
 *           System) gemäß den Rechten der Rolle, jede Seite: innerhalb des
 *           Bereichs ladbar, außerhalb muss Ansicht, API, Dropdown und
 *           Dialog abgelehnt werden (auch für Dateien). Seitenlisten und
 *           die Suche dürfen keine Seiten außerhalb des Bereichs zeigen.
 *
 * Aufruf (im Projektordner):
 *   php scripts/kirby6/panel-smoke-test.php
 *   php scripts/kirby6/panel-smoke-test.php --schnell        # Stichprobe
 *   php scripts/kirby6/panel-smoke-test.php --rollen=admin,blogger
 *
 * Optionen:
 *   --rollen=admin,blogger   nur diese Benutzer (Standard: admin + alle
 *                            Rollen aus kgs.bereichsrechte)
 *   --schnell                pro Vorlage nur zwei Seiten und pro
 *                            Dateivorlage eine Datei
 *   --worker=8               parallele Anfragen
 *   --port=8766              Port des PHP-Servers
 *   --projekt=/pfad          anderes Projekt testen
 *   -v                       alle betroffenen Stellen und Hinweise zeigen
 *
 * Exit-Code 0 = keine Fehler, 1 = Fehler gefunden, 2 = Test konnte nicht laufen.
 */

require __DIR__ . '/lib.php';
require __DIR__ . '/smoke-lib.php';

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Form\Field\BlocksField;
use Kirby\Form\Field\ModelListField;
use Kirby\Form\Field\ModelPickerField;
use Kirby\Form\Field\PageListField;
use Kirby\Form\Fields;

// ---------------------------------------------------------------------------
// Optionen
// ---------------------------------------------------------------------------

$opts = getopt('v', ['rollen:', 'schnell', 'worker:', 'port:', 'projekt:', 'hilfe']);

if (isset($opts['hilfe'])) {
    preg_match('!/\*\*(.*?)\*/!s', file_get_contents(__FILE__), $m);
    echo preg_replace('!^ ?\* ?!m', '', $m[1]), "\n";
    exit(0);
}

$sourceRoot = realpath($opts['projekt'] ?? dirname(__DIR__, 2));
$quick      = isset($opts['schnell']);
$workers    = max(1, (int)($opts['worker'] ?? 8));
$port       = (int)($opts['port'] ?? 8766);
$verbose    = isset($opts['v']);
$onlyRoles  = isset($opts['rollen']) ? array_map('trim', explode(',', $opts['rollen'])) : null;

if ($sourceRoot === false || !is_file($sourceRoot . '/kirby/bootstrap.php')) {
    fwrite(STDERR, "Kein Kirby-Projekt gefunden: " . ($opts['projekt'] ?? '') . "\n");
    exit(2);
}

ini_set('memory_limit', '1G');
$startTime = microtime(true);
echo "Panel-Smoke-Test: ", $sourceRoot, "\n";
$projectRoot = makeCopy($sourceRoot);
echo "Arbeitskopie: ", $projectRoot, "\n";

$kirby = k6Boot($projectRoot);

if (version_compare(App::version(), '6.0.0-alpha', '<')) {
    fwrite(STDERR, "Der Panel-Test braucht Kirby 6 (gefunden: " . App::version() . ")\n");
    exit(2);
}

echo "Kirby ", App::version(), ", PHP ", PHP_VERSION, $quick ? ", Stichprobe (--schnell)" : '', "\n";

// ---------------------------------------------------------------------------
// Hilfsfunktionen
// ---------------------------------------------------------------------------

/** Panel-/API-Pfad eines Models: site, pages/a+b, pages/a+b/files/x.jpg, users/id */
function modelPath(ModelWithContent $model): string
{
    return match (true) {
        $model instanceof Site => 'site',
        $model instanceof Page => 'pages/' . str_replace('/', '+', $model->id()),
        $model instanceof File => modelPath($model->parent()) . '/files/' . rawurlencode($model->filename()),
        default                => 'users/' . $model->id(),
    };
}

/** Ist die Aktion im Panel anklickbar (wie Kirby es für Buttons und Dropdowns prüft)? */
function isAvailable(ModelWithContent $model, string $action): bool
{
    try {
        return $model->guards()->isAvailable($action);
    } catch (Throwable) {
        return false;
    }
}

/** Seiten-ID aus einem Panel-Link wie /pages/blogs+artikel */
function idFromLink(string $link): string|null
{
    if (preg_match('!(?:^|/)pages/([^/?]+)!', $link, $m)) {
        return str_replace('+', '/', rawurldecode($m[1]));
    }
    return null;
}

/** Felder eines Models als Kirby-Field-Objekte (wie in der Panel-Ansicht). */
function modelFields(ModelWithContent $model): Fields
{
    return Fields::for($model, 'current');
}

/**
 * Wertet eine Antwort des Panels oder der API aus.
 *
 * @return array{code: int, message: string|null, data: array|null}
 */
function evaluate(array $res, string $kind): array
{
    global $projectRoot;

    if ($res['fehler'] !== null) {
        return ['code' => 0, 'message' => 'Keine Antwort: ' . $res['fehler'], 'data' => null];
    }

    if (in_array($res['status'], [301, 302, 303, 307], true)) {
        return ['code' => $res['status'], 'message' => 'Weiterleitung nach ' . $res['location'], 'data' => null];
    }

    $data = json_decode($res['body'], true);

    if (!is_array($data)) {
        $msg = 'Antwort ist kein JSON (Status ' . $res['status'] . ')';
        if ($whoops = whoopsMessage($res['body'])) {
            $msg .= "\n" . $whoops;
        }
        return ['code' => $res['status'] >= 400 ? $res['status'] : 500, 'message' => $msg, 'data' => null];
    }

    // API und Panel-Requests (z. B. site/tree) liefern die Daten direkt
    $state = in_array($kind, ['api', 'request'], true) ? $data : ($data[$kind] ?? null);
    $code  = $state['code'] ?? $data['code'] ?? $res['status'];
    $code  = is_numeric($code) ? (int)$code : $res['status'];

    if (($data['status'] ?? null) === 'error' || isset($data['exception'])) {
        $code = is_numeric($data['code'] ?? null) ? (int)$data['code'] : max($res['status'], 400);
    }

    $message = $state['error'] ?? $data['message'] ?? null;

    // Debug-Modus: Datei und Zeile der Exception
    if (isset($data['file']) && $code >= 500) {
        $file     = str_replace(['{kirby}', '{site}', '{index}', $projectRoot . '/'], ['kirby', 'site', '', ''], (string)$data['file']);
        $message .= "\nbei " . ltrim($file, '/') . ':' . ($data['line'] ?? '?');
    }

    if ($state === null && !in_array($kind, ['api', 'request'], true) && $code < 400) {
        return ['code' => 500, 'message' => "Antwort ohne '$kind'-Daten", 'data' => $data];
    }

    return ['code' => $code, 'message' => $message, 'data' => $state];
}

/** Meldet sich über das echte Login-Formular an. */
function login(string $base, string $email, string $password): array
{
    $jar = tempnam(sys_get_temp_dir(), 'kgs-smoke-jar-');

    $request = function (string $url, array $options = []) use ($jar) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $options + [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIEJAR      => $jar,
            CURLOPT_COOKIEFILE     => $jar,
            CURLOPT_TIMEOUT        => 60,
        ]);
        $body   = (string)curl_exec($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        return [$status, $body];
    };

    $csrfFrom = fn (string $html) => preg_match('!"csrf":"([a-f0-9]+)"!', $html, $m) ? $m[1] : null;

    try {
        [$status, $html] = $request($base . '/panel/login');
        $csrf = $csrfFrom($html);
        if ($status !== 200 || $csrf === null) {
            return ['fehler' => "Login-Seite lädt nicht (Status $status, CSRF-Token " . ($csrf ? 'da' : 'fehlt') . ')'];
        }

        [$status, $body] = $request($base . '/api/auth/login', [
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER    => ['Content-Type: application/json', 'X-CSRF: ' . $csrf],
            CURLOPT_POSTFIELDS    => json_encode(['email' => $email, 'password' => $password, 'long' => false]),
        ]);
        $result = json_decode($body, true);
        if ($status !== 200 || ($result['status'] ?? null) !== 'ok' || !isset($result['user'])) {
            return ['fehler' => "Login fehlgeschlagen (Status $status): " . ($result['message'] ?? mb_strimwidth($body, 0, 200))];
        }

        // Nach dem Login gilt ein neues CSRF-Token aus der Session
        [, $html] = $request($base . '/panel/site');
        $csrf     = $csrfFrom($html) ?? $csrf;

        $cookies = [];
        foreach (file($jar, FILE_IGNORE_NEW_LINES) as $line) {
            $parts = explode("\t", $line);
            if (count($parts) === 7) {
                $cookies[] = $parts[5] . '=' . $parts[6];
            }
        }

        return ['cookie' => implode('; ', $cookies), 'csrf' => $csrf];
    } finally {
        @unlink($jar);
    }
}

// ---------------------------------------------------------------------------
// Testbenutzer anlegen (nur in der Arbeitskopie)
// ---------------------------------------------------------------------------

$config   = $kirby->option('kgs.bereichsrechte', []);
$password = 'Smoke-' . bin2hex(random_bytes(8));
$users    = [];

foreach (['admin' => null, ...$config] as $role => $roots) {
    if ($onlyRoles !== null && !in_array($role, $onlyRoles, true)) {
        continue;
    }
    if ($kirby->roles()->find($role) === null) {
        Report::add('setup', 'FEHLER', "kgs.bereichsrechte.$role", "Die Rolle '$role' gibt es nicht");
        continue;
    }
    $email = "smoke-$role@example.com";
    $kirby->users()->create([
        'email'    => $email,
        'password' => $password,
        'role'     => $role,
        'language' => 'de',
        'name'     => "Smoke $role",
    ]);
    $users[$role] = ['email' => $email, 'roots' => $roots];
}

// ---------------------------------------------------------------------------
// Modelle und Felder einsammeln (als Admin)
// ---------------------------------------------------------------------------

$site  = $kirby->site();
$pages = allPages($site);

// --schnell: pro Vorlage die ersten zwei Seiten
if ($quick) {
    $perTemplate = [];
    $pages       = array_values(array_filter($pages, function (Page $page) use (&$perTemplate) {
        $tpl = $page->intendedTemplate()->name();
        $perTemplate[$tpl] = ($perTemplate[$tpl] ?? 0) + 1;
        return $perTemplate[$tpl] <= 2;
    }));
}

/**
 * API-Endpunkte der Felder eines Models.
 *
 * @return array{listen: list<string>, rest: list<array{0: string, 1: string, 2: string}>} rest: [kind, url, beschreibung]
 */
function fieldEndpoints(ModelWithContent $model, bool $withDetails): array
{
    $path   = modelPath($model);
    $listen = [];
    $rest   = [];

    foreach (modelFields($model) as $field) {
        $name = $field->name();

        if ($field instanceof ModelListField) {
            $listen[] = "api/$path/fields/$name";
            if ($withDetails && $field instanceof PageListField && $field->add()) {
                $rest[] = ['dialog', "panel/dialogs/$path/fields/$name/create", "Liste $name: Seite anlegen"];
            }
        }

        if (!$withDetails) {
            continue;
        }

        if ($field instanceof ModelPickerField) {
            $rest[] = ['dialog', "panel/dialogs/$path/fields/$name/picker", "Picker $name: Auswahl-Dialog"];
            $ids = array_column($field->toFormValue(), 'id');
            if ($ids !== []) {
                $rest[] = ['api', "api/$path/fields/$name/items?items=" . rawurlencode(implode(',', $ids)), "Picker $name: ausgewählte Elemente"];
            }
        }

        if ($field instanceof BlocksField) {
            foreach ($field->fieldsets() as $type => $fieldset) {
                $rest[] = ['api', "api/$path/fields/$name/fieldsets/$type", "Block $type in $name: Formular"];
                foreach ($fieldset->fields() as $fieldName => $props) {
                    if (in_array($props['type'] ?? null, ['pages', 'files', 'users', 'pagepicker', 'filepicker', 'userpicker'], true)) {
                        $rest[] = ['dialog', "panel/dialogs/$path/fields/$name/fieldsets/$type/fields/$fieldName/picker", "Block $type in $name: Picker $fieldName"];
                    }
                }
            }
        }
    }

    return ['listen' => $listen, 'rest' => $rest];
}

/** Ein Eintrag pro Request: [kind, url, erwartung, wo, prüfung] */
$plan  = [];
$add   = function (string $user, string $kind, string $url, string $expect, string $where, Closure|null $check = null) use (&$plan) {
    $plan[$user][$kind . ' ' . $url] = compact('kind', 'url', 'expect', 'where', 'check');
};

echo "  Sammle Ansichten, Dialoge und Felder ...\n";

$detailsDone   = [];  // Vorlage => true (Picker, Blöcke nur einmal pro Vorlage)
$createDone    = [];  // Eltern-Vorlage > Kind-Vorlage
$fileDone      = [];  // Seitenvorlage > Dateivorlage
$modelInfo     = [];  // pfad => [id, label, listen, dateien]

$models = [$site, ...$pages];
foreach ($models as $i => $model) {
    progress('Sammeln', $i + 1, count($models));
    $path     = modelPath($model);
    $label    = modelLabel($model);
    $template = $model instanceof Site ? 'site' : $model->intendedTemplate()->name();

    try {
        $endpoints = withErrors('admin', $label, fn () => fieldEndpoints($model, !isset($detailsDone[$template])));
        $tabs      = array_map(fn ($tab) => $tab->name(), iterator_to_array($model->blueprint()->tabs()));
        $children  = array_column($model->blueprints(), 'name');
    } catch (Throwable $e) {
        Report::add('admin', 'FEHLER', $label, 'Felder lassen sich nicht einsammeln: ' . describe($e));
        continue;
    }
    $detailsDone[$template] = true;

    // Dateien: alle Ansichten, Dialoge nur einmal pro Kombination
    $files = [];
    foreach ($model->files() as $file) {
        $fileTpl = $template . ' > ' . ($file->template() ?? 'default');
        $dialogs = [];
        if (!isset($fileDone[$fileTpl])) {
            foreach (['changeName' => 'changeName', 'changeTemplate' => 'changeTemplate', 'changeSort' => 'sort', 'delete' => 'delete'] as $dialog => $action) {
                if (isAvailable($file, $action)) {
                    $dialogs[] = $dialog;
                }
            }
        }
        $files[] = ['path' => modelPath($file), 'label' => modelLabel($file), 'dialoge' => $dialogs];
        $fileDone[$fileTpl] = true;
        if ($quick && count($files) >= 3) {
            break;
        }
    }

    $modelInfo[$path] = [
        'id'      => $model instanceof Page ? $model->id() : null,
        'label'   => $label,
        'listen'  => $endpoints['listen'],
        'dateien' => $files,
    ];

    // ---- Admin ----
    $add('admin', 'view', "panel/$path", 'ok', $label);
    foreach (array_slice($tabs, 1) as $tab) {
        $add('admin', 'view', "panel/$path?tab=" . rawurlencode($tab), 'ok', "$label, Tab $tab");
    }

    if ($model instanceof Site) {
        $add('admin', 'dialog', 'panel/dialogs/site/changeTitle', 'any', "$label, Dialog Titel");
    } else {
        $add('admin', 'dropdown', "panel/dropdowns/$path", 'ok', "$label, Dropdown");
        // Nur Dialoge, die im Panel auch anklickbar sind. Ein nicht
        // verfügbarer Dialog (z. B. Vorlage ändern ohne Alternative)
        // wirft in Kirby eine Exception mit Status 500.
        $dialogs = ['changeStatus' => 'changeStatus', 'changeTitle' => 'changeTitle', 'changeTemplate' => 'changeTemplate', 'delete' => 'delete', 'duplicate' => 'duplicate', 'move' => 'move', 'changeSort' => 'sort'];
        foreach ($dialogs as $dialog => $action) {
            if (isAvailable($model, $action)) {
                $add('admin', 'dialog', "panel/dialogs/$path/$dialog", 'any', "$label, Dialog $dialog");
            }
        }
    }

    foreach ($children as $child) {
        $combo = $template . ' > ' . $child;
        if (!isset($createDone[$combo])) {
            $createDone[$combo] = true;
            $parent = $model instanceof Site ? '/site' : '/' . $path;
            $add('admin', 'dialog', 'panel/dialogs/pages/create?parent=' . rawurlencode($parent) . '&template=' . rawurlencode($child), 'any', "Seite anlegen: $combo (unter $label)");
        }
    }

    foreach ($endpoints['listen'] as $url) {
        $add('admin', 'api', $url, 'ok', "$label, " . basename($url));
    }
    foreach ($endpoints['rest'] as [$kind, $url, $what]) {
        $add('admin', $kind, $url, $kind === 'api' ? 'ok' : 'any', "$label, $what");
    }

    foreach ($files as $file) {
        $add('admin', 'view', "panel/{$file['path']}", 'ok', $file['label']);
        $add('admin', 'dropdown', "panel/dropdowns/{$file['path']}", 'ok', "{$file['label']}, Dropdown");
        foreach ($file['dialoge'] as $dialog) {
            $add('admin', 'dialog', "panel/dialogs/{$file['path']}/$dialog", 'any', "{$file['label']}, Dialog $dialog");
        }
    }
}

// Globale Ansichten und Anfragen
foreach (['users', 'account', 'system'] as $view) {
    $add('admin', 'view', "panel/$view", 'ok', "Ansicht $view");
}
foreach ($kirby->users() as $user) {
    $add('admin', 'view', 'panel/' . modelPath($user), 'ok', modelLabel($user));
}
$add('admin', 'dialog', 'panel/dialogs/users/create', 'any', 'Dialog Benutzer anlegen');
$add('admin', 'dialog', 'panel/dialogs/changes', 'any', 'Dialog Änderungen');
$add('admin', 'request', 'panel/site/tree', 'ok', 'Seitenbaum (Verschieben-Dialog)');
foreach (['pages' => 'schule', 'files' => 'pdf', 'users' => 'smoke'] as $type => $query) {
    $add('admin', 'search', "panel/search/$type?query=$query", 'ok', "Suche $type");
}

// ---- Eingeschränkte Rollen ----
$searchTerms = ['schule', 'kgs', 'die', 'a'];

foreach ($users as $role => $info) {
    if ($info['roots'] === null) {
        continue;
    }
    $roots    = $info['roots'];
    $roleObj  = $kirby->roles()->find($role);
    $tag      = "Rolle $role";
    $home     = 'pages/' . str_replace('/', '+', $roots[0]);

    // Startseite des Panels
    $add($role, 'redirect', 'panel', 'any', "$tag, Panel-Startseite", function (array $r) use ($home, $tag) {
        if (!str_ends_with((string)$r['location'], '/panel/' . $home)) {
            return ['FEHLER', "Panel-Startseite ist " . ($r['location'] ?? '(keine Weiterleitung)') . ", erwartet /panel/$home"];
        }
        return null;
    });

    // Menü: genau die Bereiche der Rolle (plus Konto)
    $add($role, 'view', "panel/$home", 'ok', "$tag, Menü", function (array $r, array $e, array $full) use ($roots) {
        $links = [];
        foreach ($full['menu']['entries'] ?? $full['menu'] ?? [] as $entry) {
            if (is_array($entry) && isset($entry['link'])) {
                $links[] = $entry['link'];
            }
        }
        $problems = [];
        foreach ($links as $link) {
            $id = idFromLink($link);
            if ($id !== null && !inArea($id, $roots)) {
                $problems[] = $link;
            }
        }
        return $problems === [] ? null : ['FEHLER', 'Menü enthält Seiten außerhalb des Bereichs: ' . implode(', ', $problems)];
    });

    // Bereiche des Panels gemäß den Rechten der Rolle
    foreach (['site' => 'site', 'users' => 'users', 'system' => 'system'] as $area => $url) {
        $allowed = $roleObj->permissions()->for('access', $area) !== false;
        $add($role, 'view', "panel/$url", $allowed ? 'any' : 'denied', "$tag, Bereich $area" . ($allowed ? '' : ' (laut Rolle gesperrt)'));
    }
    $add($role, 'view', 'panel/account', 'ok', "$tag, eigenes Konto");

    // Seiten
    foreach ($modelInfo as $path => $m) {
        if ($m['id'] === null) {
            // Site: Seitenlisten dürfen nur Seiten im Bereich zeigen
            foreach ($m['listen'] as $url) {
                $add($role, 'api', $url, 'any', "$tag, site, " . basename($url), listCheck($roots));
            }
            continue;
        }

        $where = "$tag, {$m['label']}";

        if (inArea($m['id'], $roots)) {
            $add($role, 'view', "panel/$path", 'ok', $where);
            foreach ($m['listen'] as $url) {
                $add($role, 'api', $url, 'any', "$where, " . basename($url), listCheck($roots));
            }
            continue;
        }

        $add($role, 'view', "panel/$path", 'denied', "$where (außerhalb)");
        $add($role, 'api', "api/$path", 'denied', "$where (außerhalb), API");
        $add($role, 'dropdown', "panel/dropdowns/$path", 'denied', "$where (außerhalb), Dropdown");
        $add($role, 'dialog', "panel/dialogs/$path/changeStatus", 'denied', "$where (außerhalb), Dialog changeStatus");
        $add($role, 'dialog', "panel/dialogs/$path/delete", 'denied', "$where (außerhalb), Dialog delete");
        foreach (array_slice($m['dateien'], 0, 1) as $file) {
            $add($role, 'view', "panel/{$file['path']}", 'denied', "$tag, {$file['label']} (außerhalb)");
            $add($role, 'api', "api/{$file['path']}", 'denied', "$tag, {$file['label']} (außerhalb), API");
        }
    }

    // Suche
    foreach ($searchTerms as $term) {
        $add($role, 'search', "panel/search/pages?limit=1000&query=" . rawurlencode($term), 'any', "$tag, Seitensuche '$term'", searchCheck($roots));
        $add($role, 'search', "panel/search/files?limit=1000&query=" . rawurlencode($term), 'any', "$tag, Dateisuche '$term'", searchCheck($roots));
    }
}

/** Prüft, dass eine Seiten-/Dateiliste nur Einträge im Bereich enthält. */
function listCheck(array $roots): Closure
{
    return function (array $r, array $e) use ($roots) {
        $outside = [];
        foreach ($e['data']['models'] ?? [] as $item) {
            $id = idFromLink((string)($item['link'] ?? '')) ?? ($item['id'] ?? null);
            if (is_string($id) && !str_contains($id, '.') && !inArea($id, $roots)) {
                $outside[] = $id;
            }
        }
        return $outside === [] ? null : ['FEHLER', 'Liste zeigt Seiten außerhalb des Bereichs: ' . implode(', ', array_slice($outside, 0, 5))];
    };
}

/** Prüft, dass die Suche nur Treffer im Bereich liefert. */
function searchCheck(array $roots): Closure
{
    return function (array $r, array $e) use ($roots) {
        $outside = [];
        foreach ($e['data']['results'] ?? [] as $item) {
            $id = idFromLink((string)($item['link'] ?? ''));
            // Dateien der Site haben keine Seite, die gehören allen
            if ($id !== null && !inArea($id, $roots)) {
                $outside[] = $item['link'];
            }
        }
        return $outside === [] ? null : ['FEHLER', 'Suche findet ' . count($outside) . ' Treffer außerhalb des Bereichs, z. B. ' . implode(', ', array_slice($outside, 0, 3))];
    };
}

// ---------------------------------------------------------------------------
// Server starten, anmelden, Anfragen stellen
// ---------------------------------------------------------------------------

$log  = tempnam(sys_get_temp_dir(), 'kgs-smoke-php-log-');
register_shutdown_function(fn () => @unlink($log));
$base = 'http://127.0.0.1:' . $port;

try {
    echo "  Starte PHP-Server auf $base mit $workers Workern ...\n";
    $server = startServer($projectRoot, $port, $workers, $log);

    // Falsches Passwort: muss sauber abgelehnt werden
    $wrong = login($base, $users[array_key_first($users)]['email'] ?? 'x@example.com', 'falsch-' . $password);
    if (!isset($wrong['fehler']) || str_contains($wrong['fehler'], 'Status 5')) {
        Report::add('setup', 'FEHLER', 'Login', 'Login mit falschem Passwort: ' . ($wrong['fehler'] ?? 'wurde angenommen!'));
    }

    foreach ($users as $role => $info) {
        $part = $role === 'admin' ? 'admin' : 'rollen';
        $tag  = $role === 'admin' ? 'Admin' : "Rolle $role";

        $session = login($base, $info['email'], $password);
        if (isset($session['fehler'])) {
            Report::add($part, 'FEHLER', "$tag, Login", $session['fehler']);
            continue;
        }

        $requests = [];
        foreach ($plan[$role] ?? [] as $key => $p) {
            // wie das Panel selbst: JSON anfordern
            $headers = ['X-CSRF: ' . $session['csrf'], 'Accept: application/json'];
            if (!in_array($p['kind'], ['api', 'redirect'], true)) {
                $headers[] = 'X-Panel: true';
            }
            $requests[$key] = ['url' => $base . '/' . $p['url'], 'headers' => $headers, 'cookie' => $session['cookie']];
        }

        echo "  $tag: ", count($requests), " Anfragen ...\n";

        httpMulti($requests, $workers, $tag, function (string $key, array $res) use ($plan, $role, $part, $tag) {
            $p    = $plan[$role][$key];
            $kind = $p['kind'] === 'redirect' ? 'view' : $p['kind'];
            $e    = evaluate($res, $kind);
            $code = $e['code'];
            Report::count($part, "$tag: Anfragen");

            // Abstürze sind immer Fehler
            if ($code === 0 || $code >= 500) {
                Report::add($part, 'FEHLER', $p['where'], 'Absturz: ' . ($e['message'] ?? "Status $code"));
                return;
            }

            if ($p['kind'] === 'redirect') {
                $e['code'] = $res['status'];
            }

            switch ($p['expect']) {
                case 'ok':
                    if ($code !== 200) {
                        Report::add($part, $role === 'admin' ? 'FEHLER' : 'WARNUNG', $p['where'], "Lädt nicht (Status $code): " . ($e['message'] ?? ''));
                        return;
                    }
                    break;
                case 'denied':
                    if ($code === 200) {
                        Report::add($part, 'FEHLER', $p['where'], 'Zugriff außerhalb des Bereichs bzw. trotz fehlender Rechte möglich');
                    }
                    return;
                case 'any':
                    if ($code >= 400 && $p['kind'] !== 'redirect') {
                        // z. B. „keine andere Vorlage verfügbar“: kein Fehler,
                        // aber gut zu wissen
                        Report::add($part, 'HINWEIS', $p['where'], "Abgelehnt (Status $code): " . trim((string)$e['message']));
                        return;
                    }
                    break;
            }

            // Fehlerboxen in Ansichten und Dialogen
            if (is_array($e['data'])) {
                foreach (findErrorFields($e['data']) as $problem) {
                    Report::add($part, 'FEHLER', $p['where'], $problem);
                }
            }

            if ($p['check'] !== null) {
                $full    = json_decode($res['body'], true) ?: [];
                $problem = ($p['check'])($res, $e, $full);
                if ($problem !== null) {
                    Report::add($part, $problem[0], $p['where'], $problem[1]);
                }
            }
        });
    }
} catch (Throwable $e) {
    fwrite(STDERR, "\nTest abgebrochen: " . describe($e) . "\n");
    exit(2);
} finally {
    stopServer($server ?? null);
}

// ---- PHP-Fehlerlog des Servers ---------------------------------------------
foreach (is_file($log) ? file($log, FILE_IGNORE_NEW_LINES) : [] as $line) {
    if (!preg_match('!PHP (Fatal error|Warning|Notice|Deprecated|Parse error)!', $line)) {
        continue;
    }
    $line = preg_replace('!^\[[^\]]+\]\s*!', '', str_replace($projectRoot . '/', '', $line));
    Report::add('admin', str_contains($line, 'Deprecated') ? 'WARNUNG' : 'FEHLER', 'PHP-Fehlerlog des Servers', mb_strimwidth($line, 0, 400, '...'));
}
@unlink($log);

// ---------------------------------------------------------------------------
// Ausgabe
// ---------------------------------------------------------------------------

foreach (['setup' => 'Vorbereitung', 'admin' => 'Admin: Ansichten, Dialoge, Felder', 'rollen' => 'Eingeschränkte Rollen'] as $part => $title) {
    if (isset(Report::$items[$part]) || isset(Report::$counts[$part])) {
        heading($title);
        Report::print($part, $verbose);
    }
}

$errors = Report::errors();
heading(sprintf('Ergebnis: %d Fehler (%.0f s)', $errors, microtime(true) - $startTime));
exit($errors > 0 ? 1 : 0);
