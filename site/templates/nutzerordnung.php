<?php snippet('header') ?>
<?php snippet('page-header') ?>



<div class="container">
    <p>
        <?= $page->Beschreibung()->kirbytext() ?>
    </p>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
        $dateien =  $page->dateien()->toFiles();
        foreach ($dateien as $datei) : ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $datei->anzeigename()->or($datei->name()) ?></h5>
                        <p class="card-text"><?= $datei->beschreibung() ?></p>

                        <?php snippet('knopf-klein', ['subpage' => $datei, 'knopftext' => "Datei herunterladen"]); ?>

                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>

</div>

<?php snippet('sidebar') ?>

<?php snippet('footer') ?>