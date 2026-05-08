<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$countdowns = $page->countdowns()->toStructure()->filter(fn($c) => $c->aktiv()->toBool());
$now = new DateTime('today');

$result = [];
foreach ($countdowns as $c) {
    $zieldatum = new DateTime($c->datum()->value());
    $diff = $now->diff($zieldatum);
    $tage = (int) $diff->format('%r%a');

    $result[] = [
        'titel' => $c->titel()->value(),
        'datum' => $zieldatum->format('Y-m-d'),
        'datum_formatiert' => $zieldatum->format('d.m.Y'),
        'tage' => $tage,
    ];
}

echo json_encode([
    'countdowns' => $result,
    'generiert' => date('c'),
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
