<?php /* $links_bilder: Die URL zur Seite => Der Name des Bildes (im Ordner assets/bilder), $alt: Alternativtext für das Bild
 !!Beide arrays müssen gleich lang sein!! */
$links_bilder = [
  'https://thalia.webuntis.com/WebUntis/?school=kgs-rastede' => 'webuntis.png',
  'https://kgs-rastede.eu' => 'IServ_Logo.svg',
  'https://foerderverein.kgsraste.de/' => 'foerderverein.png',
  'https://kgs-rastede.l-e-o.eu' => 'mensa.png',
  'http://kgs-rastede.de/unterricht/erasmus' => 'eu.svg',
];
$alt = ['Webuntis', 'IServ', 'Förderverein', 'Mensa', 'EU'];

$count = -1;
?>

<div class="flex justify-center w-full mb-2 px-5 sm:px-0">
  <div class="grid grid-cols-1 max-w-7xl gap-2 sm:gap-4 md:grid-cols-6 md:gap-4 xl:gap-6 mx-auto">
    <?php foreach ($links_bilder as $link => $bild):
      $count++; ?>
      <a href="<?= $link ?>" target="_blank" rel="noopener" class="flex justify-center items-center">
        <img src="<?= $kirby->url('assets') ?>/bilder/<?= $bild ?>"
          alt="<?= $alt[$count] ?>"
          class="max-h-16 md:max-h-32">
      </a>
    <?php
    endforeach; ?>
  </div>
</div>