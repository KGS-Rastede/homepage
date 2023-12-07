<?php /* $links_bilder: Die URL zur Seite => Der Name des Bildes (im Ordner assets/bilder), $alt: Alternativtext für das Bild
!!Beide arrays müssen gleich lang sein!! */
$links_bilder =
    array(
        'https://thalia.webuntis.com/WebUntis/?school=kgs-rastede' => 'webuntis.png',
        'https://www.schuelerzeitung.kgs-rastede.de/' => 'irregulaer.png',
        'https://kgs-rastede.eu' => 'IServ_Logo.svg',
        'foerderverein' => 'foerderverein.png',
        'https://kgs-rastede.l-e-o.eu' => 'mensa.png',
    );
$alt =
    array(
        'Webuntis',
        'Schülerzeitung',
        'IServ',
        'Förderverein',
        'Mensa'
    );

$count = -1;
?>

<div class="container mx-auto mb-2 sm:p-0 px-5 sm:px-0">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-2 xl:gap-4 sm:gap-5 md:gap-2 mx-3">
        <?php foreach ($links_bilder as $link => $bild):
            $count++ ?>
            <a href="<?= $link ?>" target="_blank" rel="noopener">

                <img src="<?= $kirby->url('assets') ?>/bilder/<?= $bild ?>" alt="<?= $alt[$count] ?>" class="w-full">

            </a>
        <?php endforeach ?>
    </div>
</div>