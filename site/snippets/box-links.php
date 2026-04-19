<?php
$links = [
  ['url' => 'https://kgs-rastede.webuntis.com/', 'bild' => 'webuntis.png',     'alt' => 'Webuntis'],
  ['url' => 'https://kgs-rastede.eu',             'bild' => 'IServ_Logo.svg',   'alt' => 'IServ'],
  ['url' => 'https://foerderverein.kgsraste.de/', 'bild' => 'foerderverein.png','alt' => 'Förderverein'],
  ['url' => 'https://kgs-rastede.l-e-o.eu',       'bild' => 'mensa.png',        'alt' => 'Mensa'],
  ['url' => 'http://kgs-rastede.de/unterricht/erasmus', 'bild' => 'eu.svg',     'alt' => 'EU'],
];
?>

<div class="flex justify-center w-full mb-2 px-5 sm:px-0">
  <div class="grid grid-cols-1 max-w-7xl gap-2 sm:gap-4 md:grid-cols-6 md:gap-4 xl:gap-6 mx-auto">
    <?php foreach ($links as $eintrag): ?>
      <a href="<?= $eintrag['url'] ?>" target="_blank" rel="noopener" class="flex justify-center items-center">
        <img src="<?= $kirby->url('assets') ?>/bilder/<?= $eintrag['bild'] ?>"
          alt="<?= $eintrag['alt'] ?>"
          class="max-h-16 md:max-h-32">
      </a>
    <?php endforeach; ?>
  </div>
</div>