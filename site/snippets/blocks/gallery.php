<?php

/** @var \Kirby\Cms\Block $block */ ?>


<div class="row" data-masonry='{"percentPosition": true }'>
    <?php foreach ($block->images()->toFiles() as $image) : ?>
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="ohnezoom" style="overflow:hidden;">
                <img class="rounded hover img-fluid" src="<?= $image->url() ?>"   >
                <div class="mitzoom">
                    <h2 style="text-align:center;margin-top:-6px"><?= $image->beschreibung() ?></h2>
                </div>
            </div>
        </div>

    <?php endforeach ?>
</div>

<?= js('assets/js/load_masonry.js') ?>