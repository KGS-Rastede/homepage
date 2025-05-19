<?php snippet('default-page-layout', slots: true);
slot();
?>

<div class="container mx-auto px-4">
    <div class="outer-box border-3 border-gray-300 p-5 my-5 bg-gray-200 rounded-xl max-w-7xl mx-auto">
        <div class="col-md-8 mx-auto text-center">
            <h2 class="title text-xl mb-4"><?= $page->main_text() ?></h2>
        </div>

        <!-- Erste Reihe: Adressen (kleiner in Schriftgröße und Padding) -->
        <div class="row flex flex-wrap gap-10 justify-between">
            <div class="inner-box flex-1 min-w-[280px] border-2 border-gray-300 p-3 bg-gray-100 rounded-lg text-sm text-center">
                <h6><?= $page->adresse_s2()->toBlocks() ?></h6>
            </div>
            <div class="inner-box flex-1 min-w-[280px] border-2 border-gray-300 p-3 bg-gray-100 rounded-lg text-sm text-center">
                <h6><?= $page->adresse_s1()->toBlocks() ?></h6>
            </div>
        </div>

        <!-- Zweite Reihe: Anfahrtstexte (größere Schrift und mehr Padding) -->
        <div class="row flex flex-wrap gap-10 justify-between">
            <div class="inner-box flex-1 min-w-[280px] border-2 border-gray-300 p-3 bg-gray-100 rounded-lg text-base">
                <p class="description"><?= $page->anfahrt_text_s2()->toBlocks() ?></p>
            </div>
            <div class="inner-box flex-1 min-w-[280px] border-2 border-gray-300 p-3 bg-gray-100 rounded-lg text-base">
                <p class="description"><?= $page->anfahrt_text_s1()->toBlocks() ?></p>
            </div>
        </div>
    </div>

    <div class="box">
        <?= $page->karte()->toBlocks(); ?>
    </div>
</div>


<?php endslot(); ?>
<?php endsnippet(); ?>