<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php
    $dateien =  $page->dateien()->toFiles();
    foreach ($dateien as $datei) : ?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $datei->anzeigename()->or($datei->name()) ?></h5>
                    <p class="card-text"><?= $datei->beschreibung() ?></p>
                    <a href="<?= $datei->url() ?>" class="btn btn-secondary mb-5" role="button">Datei herunterladen</a>

                </div>
            </div>
        </div>

    <?php endforeach ?>
</div>

<?php snippet('sidebar') ?>

<?php snippet('footer') ?>