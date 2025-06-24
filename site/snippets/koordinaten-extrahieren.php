<?php

// Dieser Code generiert die JSON-Elemente
foreach ($block->reise()->toBlocks() as $block) {
  $features = [
    'type' => 'Feature',
    'properties' => [
      'message' => $block->name()->value(),
      'iconSize' => [50, 50],
      'iconUrl' => ($image = $block->bild()->toFile()) ? $image->url() : '',
    ],
    'geometry' => [
      'type' => 'Point',
      'coordinates' => [
        $block->breitengrad()->value(),
        $block->laengengrad()->value(),
      ],
    ],
  ];

  $aktuelle_koordinate = [];
  $aktuelle_koordinate[0] = $block->breitengrad()->value();
  $aktuelle_koordinate[1] = $block->laengengrad()->value();
}

//Achtung, hier ist der Code passend zur Fehlermeldung. Int vs. String
$koordinaten[0] = [['53.1'], ['8.12']];
$koordinaten[2] = [['43.1'], ['7.12']];
$koordinaten[3] = [['33.1'], ['6.12']];

return $features;
?>
