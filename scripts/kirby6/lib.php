<?php

/**
 * Gemeinsame Funktionen für die Kirby-6-Content-Skripte.
 *
 * Hintergrund: Kirby 5 liest YAML in Content-Dateien mit Spyc, Kirby 6 mit
 * dem strengeren Symfony-Parser. Einige Werte werden dadurch anders gelesen,
 * z. B. bekommen `>`-Blöcke (lange URLs, Bild-IDs) einen Zeilenumbruch
 * angehängt und unquotierte Daten werden zu Unix-Zeitstempeln.
 *
 * Geprüft werden nur Felder, die laut Blueprint YAML speichern
 * (siehe YAML_FIELD_TYPES). Normale Textfelder, die zufällig wie YAML
 * aussehen (z. B. das Impressum), werden nie angefasst.
 */

use Kirby\Cms\App;
use Kirby\Cms\ModelWithContent;
use Kirby\Content\VersionId;
use Kirby\Data\YamlSpyc;
use Kirby\Data\YamlSymfony;
use Kirby\Toolkit\A;
use Symfony\Component\Yaml\Yaml as Symfony;

const YAML_FIELD_TYPES = ['structure', 'object', 'blocks', 'layout'];

/**
 * Startet Kirby mit dem Projekt-Code, optional mit einem anderen content-Ordner
 * (z. B. einer frisch vom Server geholten Kopie).
 */
function k6Boot(string $projectRoot, string|null $contentRoot = null): App
{
    require_once $projectRoot . '/kirby/bootstrap.php';

    $roots = ['index' => $projectRoot];
    if ($contentRoot !== null) {
        $roots['content'] = $contentRoot;
    }

    $kirby = new App(['roots' => $roots]);
    $kirby->impersonate('kirby');
    return $kirby;
}

/**
 * Liefert alle Content-Dateien von Site, Seiten (inkl. Entwürfen) und
 * Dateien, jeweils mit den YAML-Feldern aus dem Blueprint.
 *
 * @return array<string, array{model: string, fields: array<string, string>}>
 *         Pfad => [Model-ID, Feldname (klein) => Feldtyp]
 */
function k6ContentFiles(App $kirby): array
{
    $result = [];

    $add = function (ModelWithContent $model) use (&$result) {
        $fields = [];
        foreach ($model->blueprint()->fields() as $name => $props) {
            $type = $props['type'] ?? null;
            if (in_array($type, YAML_FIELD_TYPES, true)) {
                $fields[strtolower($name)] = $type;
            }
        }

        foreach ([VersionId::latest(), VersionId::changes()] as $version) {
            foreach ($model->storage()->contentFiles($version) as $file) {
                if (is_file($file)) {
                    $result[realpath($file)] = ['model' => $model->id() ?? 'site', 'fields' => $fields];
                }
            }
        }
    };

    $site = $kirby->site();
    $add($site);
    foreach ($site->files() as $file) {
        $add($file);
    }

    // Nicht $site->index(true): Gibt es eine Seite als Entwurf und
    // veröffentlicht mit derselben ID, enthält der Index nur eine davon.
    $walk = function ($parent) use (&$walk, $add) {
        foreach ([$parent->children(), $parent->drafts()] as $pages) {
            foreach ($pages as $page) {
                $add($page);
                foreach ($page->files() as $file) {
                    $add($file);
                }
                $walk($page);
            }
        }
    };
    $walk($site);

    return $result;
}

/**
 * Content-Dateien, die keinem Model gehören und von Kirby nie gelesen
 * werden (z. B. eine zweite Vorlagen-Datei im selben Seitenordner).
 *
 * @param array<string, mixed> $mapped Ergebnis von k6ContentFiles()
 * @return string[] Pfade relativ zum content-Ordner
 */
function k6UnusedContentFiles(App $kirby, array $mapped): array
{
    $root   = $kirby->root('content');
    $unused = [];
    $it     = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));

    foreach ($it as $file) {
        if ($file->getExtension() === 'txt' && !isset($mapped[realpath($file->getPathname())])) {
            $unused[] = substr($file->getPathname(), strlen($root) + 1);
        }
    }

    sort($unused);
    return $unused;
}

/** '' und null sind für Kirby gleichwertig leer. */
function k6Normalize(mixed $value): mixed
{
    if (is_array($value)) {
        return array_map('k6Normalize', $value);
    }
    return $value === null ? '' : $value;
}

/** Erster Pfad, an dem sich zwei Werte unterscheiden (oder null). */
function k6FirstDiff(mixed $a, mixed $b, string $path = ''): array|null
{
    if (is_array($a) && is_array($b)) {
        foreach (array_unique([...array_keys($a), ...array_keys($b)]) as $key) {
            $diff = k6FirstDiff(
                array_key_exists($key, $a) ? $a[$key] : '<fehlt>',
                array_key_exists($key, $b) ? $b[$key] : '<fehlt>',
                $path . '.' . $key
            );
            if ($diff !== null) {
                return $diff;
            }
        }
        return null;
    }

    return $a === $b ? null : ['pfad' => ltrim($path, '.'), 'kirby5' => $a, 'kirby6' => $b];
}

function k6IsJson(string $value): bool
{
    $trimmed = ltrim($value);
    if ($trimmed === '' || ($trimmed[0] !== '[' && $trimmed[0] !== '{')) {
        return false;
    }
    json_decode($value);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * Prüft einen Feldwert.
 *
 * @return array{status: string, spyc?: mixed, diff?: array, fehler?: string}
 *         status: leer | json | gleich | anders | fehler
 */
function k6AnalyzeField(string $value): array
{
    if (trim($value) === '') {
        return ['status' => 'leer'];
    }
    if (k6IsJson($value)) {
        return ['status' => 'json'];
    }

    $spyc = YamlSpyc::decode($value);

    try {
        $symfony = A::wrap(Symfony::parse($value));
    } catch (Throwable $e) {
        return ['status' => 'fehler', 'spyc' => $spyc, 'fehler' => $e->getMessage()];
    }

    $diff = k6FirstDiff(k6Normalize($spyc), k6Normalize($symfony));
    if ($diff === null) {
        return ['status' => 'gleich'];
    }

    return ['status' => 'anders', 'spyc' => $spyc, 'diff' => $diff];
}

/**
 * Schreibt die von Kirby 5 gelesenen Daten neu im Format von Kirby 6
 * (so wie Kirby selbst beim Speichern schreibt) und prüft, dass beide
 * Parser danach exakt dasselbe lesen wie Kirby 5 vorher.
 *
 * @return string|null neuer YAML-Text, oder null wenn die Prüfung scheitert
 */
function k6Reencode(array $spycData): string|null
{
    $yaml = YamlSymfony::encode($spycData);

    try {
        $backSpyc    = YamlSpyc::decode($yaml);
        $backSymfony = A::wrap(Symfony::parse($yaml));
    } catch (Throwable) {
        return null;
    }

    if ($backSpyc !== $spycData || $backSymfony !== $spycData) {
        return null;
    }

    return $yaml;
}

/** Normalisiert einen Feldnamen wie Kirby (Txt::decode). */
function k6FieldKey(string $rawKey): string
{
    return str_replace(['-', ' '], '_', strtolower(trim($rawKey)));
}

/**
 * Ersetzt in einer Content-Datei nur die angegebenen Felder; alle anderen
 * Zeichen der Datei bleiben byte-genau erhalten.
 *
 * @param array<string, string> $replacements Feldname (klein) => neuer Wert
 */
function k6ReplaceFields(string $raw, array $replacements): string
{
    // gleiche Trennung wie Txt::decode, Trenner bleiben erhalten
    $parts = preg_split('!(\n----\s*\n*)!', $raw, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($parts as $i => $part) {
        if ($i % 2 === 1 || ($pos = strpos($part, ':')) === false || $pos === 0) {
            continue;
        }

        $rawKey = substr($part, 0, $pos);
        $key    = k6FieldKey(ltrim($rawKey, "\xEF\xBB\xBF"));

        if (!array_key_exists($key, $replacements)) {
            continue;
        }

        // Trenner innerhalb des Werts escapen, wie Txt::encodeValue
        $value = preg_replace('!(?<=\n|^)----!', '\\----', trim($replacements[$key]));
        // Leerzeilen am Ende des Felds (vor dem nächsten ----) beibehalten
        preg_match('!\s*$!', $part, $trailing);
        $parts[$i] = $rawKey . ':' . (preg_match('!\R!', $value) ? "\n\n" : ' ') . $value . $trailing[0];
    }

    return implode('', $parts);
}

/** Kurze, einzeilige Darstellung eines Werts für die Ausgabe. */
function k6Short(mixed $value): string
{
    $text = is_string($value) ? $value : var_export($value, true);
    $text = str_replace("\n", '\n', $text);
    return mb_strlen($text) > 90 ? mb_substr($text, 0, 87) . '...' : $text;
}
