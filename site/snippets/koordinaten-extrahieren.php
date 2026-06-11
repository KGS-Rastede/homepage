<?php

$features = [];
$koordinaten = [];

// Dieser Code generiert die JSON-Elemente
foreach ($block->reise()->toBlocks() as $block) {
  $features[] = [
    'type' => 'Feature',
    'properties' => [
      'message' => $block->name()->value(),
      'iconSize' => [50, 50],
      'iconUrl' => ($image = $block->bild()->toFile()) ? $image->url() : '',
    ],
    'geometry' => [
      'type' => 'Point',
      'coordinates' => [
        (float) $block->breitengrad()->value(),
        (float) $block->laengengrad()->value(),
      ],
    ],
  ];

  $koordinaten[] = [
    (float) $block->breitengrad()->value(),
    (float) $block->laengengrad()->value(),
  ];
}

return [
  'features' => $features,
  'koordinaten' => $koordinaten,
];
?>
