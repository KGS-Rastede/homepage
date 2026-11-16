<?php

/**
 * Prüft, ob die Content-Dateien unter Kirby 6 genauso gelesen werden wie
 * unter Kirby 5. Ändert nichts.
 *
 * Aufruf (im Projektordner):
 *   php scripts/kirby6/content-check.php              # prüft content/
 *   php scripts/kirby6/content-check.php /pfad/content  # prüft eine Kopie
 *
 * Exit-Code 0 = alles in Ordnung, 1 = es gibt Felder, die korrigiert werden
 * müssen (siehe content-fix.php).
 */

require __DIR__ . '/lib.php';

$projectRoot = dirname(__DIR__, 2);
$contentRoot = $argv[1] ?? null;
$kirby       = k6Boot($projectRoot, $contentRoot);

$files = k6ContentFiles($kirby);
$stats = ['dateien' => count($files), 'yamlfelder' => 0, 'gleich' => 0, 'anders' => 0, 'fehler' => 0];
$found = [];

foreach ($files as $path => $info) {
    if ($info['fields'] === []) {
        continue;
    }

    $content = Kirby\Data\Txt::decode(file_get_contents($path));

    foreach ($info['fields'] as $field => $type) {
        if (!isset($content[$field])) {
            continue;
        }

        $result = k6AnalyzeField($content[$field]);
        if (in_array($result['status'], ['leer', 'json'], true)) {
            continue;
        }

        $stats['yamlfelder']++;
        $stats[$result['status']]++;

        if ($result['status'] !== 'gleich') {
            $found[] = [substr($path, strlen($kirby->root('content')) + 1), $field, $type, $result];
        }
    }
}

foreach ($found as [$file, $field, $type, $result]) {
    echo "\n{$file}  [{$field}, {$type}]\n";
    if ($result['status'] === 'fehler') {
        echo "  FEHLER: {$result['fehler']}\n";
    } else {
        $d = $result['diff'];
        echo "  {$d['pfad']}\n";
        echo '    Kirby 5: ' . k6Short($d['kirby5']) . "\n";
        echo '    Kirby 6: ' . k6Short($d['kirby6']) . "\n";
    }
}

$unused = k6UnusedContentFiles($kirby, $files);
if ($unused !== []) {
    echo "\nVon Kirby nicht verwendete Content-Dateien (nicht geprüft):\n  " . implode("\n  ", $unused) . "\n";
}

echo "\n";
echo "Content-Dateien:      {$stats['dateien']} (+ " . count($unused) . " nicht verwendet)\n";
echo "YAML-Felder:          {$stats['yamlfelder']}\n";
echo "  gleich gelesen:     {$stats['gleich']}\n";
echo "  anders gelesen:     {$stats['anders']}\n";
echo "  Parser-Fehler:      {$stats['fehler']}\n";

exit($stats['anders'] + $stats['fehler'] > 0 ? 1 : 0);
