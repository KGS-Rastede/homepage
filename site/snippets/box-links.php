<?php /* $links_bilder: Die URL zur Seite => Der Name des Bildes (im Ordner assets/bilder), $alt: Alternativtext für das Bild
!!Beide arrays müssen gleich lang sein!! */
$links_bilder = array('https://thalia.webuntis.com/WebUntis/?school=kgs-rastede' => 'webuntis.svg',
'https://www.schuelerzeitung.kgs-rastede.de/' => 'irregulaer.png',
'https://kgs-rastede.schulserver.de' => 'IServ_Logo_klein_RGB_clean.svg',
'foerderverein/ueber_uns' => 'foerderverein.png');
$alt = array('Webuntis', 'Schülerzeitung', 'IServ', 'Förderverein');
$count = -1 ?>
<div class="d-flex flex-wrap align-items-center justify-content-center">
    <?php foreach($links_bilder as $link => $bild) : $count++ ?> 
        <div class="col-12 col-md-2 mr-md-2">
            <div class="card">
                <div class="card-body text-center">
                    <a href="<?= $link ?>">
                        <img src="<?= $kirby->url('assets') ?>/bilder/<?= $bild ?>"
                            alt="<?= $alt[$count] ?>"
                            class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <div class="col-12 col-md-2 mr-md-2">
        <div class="card">
            <div class="card-body">                
                <a href="https://www.opc-asp.de/kgs-rastede/menuplan.php?VMP" target="_blank" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">Mensa</a>
            </div>
        </div>
    </div>

</div>