<?php

/**
 * Schreibt YAML-Felder, die Kirby 6 anders lesen würde als Kirby 5, im
 * Format von Kirby 6 neu. Der Inhalt bleibt dabei exakt gleich: Jedes Feld
 * wird vor dem Schreiben mit beiden Parsern zurückgelesen und muss genau
 * die Daten ergeben, die Kirby 5 vorher gelesen hat. Sonst wird es
 * übersprungen. Alle anderen Felder der Datei bleiben byte-genau erhalten.
 *
 * Ohne --write wird nur angezeigt, was geändert würde.
 *
 * Aufruf (im Projektordner):
 *   php scripts/kirby6/content-fix.php                   # Probelauf auf content/
 *   php scripts/kirby6/content-fix.php --write           # schreibt in content/
 *   php scripts/kirby6/content-fix.php /pfad/content --write
 *
 * Vorgehen beim Umstieg: Content frisch vom Server holen, Skript mit
 * --write ausführen, die geänderten Dateien (Liste am Ende) sofort
 * hochladen, damit keine Änderungen aus dem Panel überschrieben werden.
 */

require __DIR__ . '/lib.php';

$args        = array_slice($argv, 1);
$write       = in_array('--write', $args, true);
$args        = array_values(array_diff($args, ['--write']));
$projectRoot = dirname(__DIR__, 2);
$kirby       = k6Boot($projectRoot, $args[0] ?? null);
$contentRoot = $kirby->root('content');

$changedFiles = [];
$skipped      = [];

foreach (k6ContentFiles($kirby) as $path => $info) {
    if ($info['fields'] === []) {
        continue;
    }

    $raw          = file_get_contents($path);
    $content      = Kirby\Data\Txt::decode($raw);
    $replacements = [];
    $rel          = substr($path, strlen($contentRoot) + 1);

    foreach ($info['fields'] as $field => $type) {
        if (!isset($content[$field])) {
            continue;
        }

        $result = k6AnalyzeField($content[$field]);
        if (!in_array($result['status'], ['anders', 'fehler'], true)) {
            continue;
        }

        $yaml = is_array($result['spyc']) ? k6Reencode($result['spyc']) : null;
        if ($yaml === null) {
            $skipped[] = "{$rel} [{$field}]";
            continue;
        }

        $replacements[$field] = $yaml;
    }

    if ($replacements === []) {
        continue;
    }

    $newRaw = k6ReplaceFields($raw, $replacements);

    // Gegenprobe über die ganze Datei: nur die ersetzten Felder dürfen sich
    // ändern, und die müssen in Kirby 5 dieselben Daten ergeben wie vorher.
    $newContent = Kirby\Data\Txt::decode($newRaw);
    $ok = array_keys($newContent) === array_keys($content);
    foreach ($content as $field => $value) {
        if (!$ok) {
            break;
        }
        $ok = isset($replacements[$field])
            ? Kirby\Data\YamlSpyc::decode($newContent[$field]) === Kirby\Data\YamlSpyc::decode($value)
            : $newContent[$field] === $value;
    }

    if (!$ok) {
        $skipped[] = "{$rel} (Gegenprobe der ganzen Datei fehlgeschlagen)";
        continue;
    }

    $changedFiles[] = $rel;
    echo ($write ? 'geändert: ' : 'würde ändern: ') . $rel . '  [' . implode(', ', array_keys($replacements)) . "]\n";

    if ($write) {
        file_put_contents($path, $newRaw);
    }
}

echo "\n" . count($changedFiles) . ' Datei(en) ' . ($write ? 'geändert' : 'würden geändert') . "\n";

if ($skipped !== []) {
    echo "\nÜbersprungen (bitte von Hand prüfen):\n  " . implode("\n  ", $skipped) . "\n";
}

if (!$write && $changedFiles !== []) {
    echo "\nProbelauf, nichts geschrieben. Zum Schreiben: --write anhängen.\n";
}
