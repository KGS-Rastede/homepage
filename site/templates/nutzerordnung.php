<?php snippet('header') ?>
<?php snippet('page-header') ?>



<div class="container">
    <p>
        <?= $page->Beschreibung()->kirbytext() ?>
    </p>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid grid-cols-1 p-4 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

            <?php
            $dateien = $page->dateien()->toFiles();
            foreach ($dateien as $datei): ?>
                <div class="group  bg-slate-100 p-4">

                    <div class="mb-4">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <?= $datei->anzeigename()->or($datei->name()) ?>
                        </h3>
                        <p class="mt-5 line-clamp-3 leading-2 text-gray-600">
                            <?= $datei->beschreibung() ?>
                        </p>

                    </div>
                    <?php snippet('knopf-klein', ['subpage' => $datei, 'knopftext' => "Datei herunterladen"]); ?>

                </div>

            <?php endforeach ?>
        </div>
    </div>

</div>

<?php snippet('sidebar') ?>

<?php snippet('footertw') ?>