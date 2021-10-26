<?php

/** @var \Kirby\Cms\Block $block */ ?>


<div class="row" data-masonry='{"percentPosition": true }'>

    <?php foreach ($block->images()->toFiles() as $image) : ?>
        <div class="col-sm-6 col-lg-4 mb-4">
            <img src="<?= $image->url() ?>" class="rounded img-fluid" alt="<?= $image->beschreibung() ?>">
        </div>
    <?php endforeach ?>
</div>

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>