<?php /* $links_bilder: Die URL zur Seite => Der Name des Bildes (im Ordner assets/bilder), $alt: Alternativtext für das Bild
!!Beide arrays müssen gleich lang sein!! */
$links_bilder =
    array(
        'https://thalia.webuntis.com/WebUntis/?school=kgs-rastede' => 'webuntis.png',
        'https://www.schuelerzeitung.kgs-rastede.de/' => 'irregulaer.png',
        'https://kgs-rastede.eu' => 'IServ_Logo_klein_RGB_clean.svg',
        'foerderverein/ueber_uns' => 'foerderverein.png',
        'https://www.opc-asp.de/kgs-rastede/menuplan.php?VMP' => 'mensa.png',
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

<div class="container-sm p-0 px-sm-5 px-md-0">
    <div class="row row-cols-1 row-cols-md-5 g-2 g-xl-4 gx-sm-5 gx-md-2 mx-md-3">
        <?php foreach ($links_bilder as $link => $bild) : $count++ ?>        
            <div class="col">
                <a href="<?= $link ?>" target="_blank">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img src="<?= $kirby->url('assets') ?>/bilder/<?= $bild ?>" alt="<?= $alt[$count] ?>" class="img-fluid">
                        </div>
                    </div>
                </a>
            </div>            
        <?php endforeach ?>
    </div>
</div>
