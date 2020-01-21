<?php snippet('header') ?>

<h1><?= $page->title() ?></h1>


<div class="row row-cols-sm-2 row-cols-md-5">
    <?php foreach ($page->children() as $kontakt) : ?>
        <div class="card">
            <img src="<?= $kontakt->images()->first()->url() ?>" class="rounded card-img-top" alt="<?= $kontakt->images()->first()->alt() ?>">
            <div class="card-body">
                <h3 class="card-title"><?= $kontakt->position() ?></h3>
                <p class="card-text p-3 mb-2"><?= $kontakt->title() ?></p>
            </div>
            <ul class="list-group list-group-flush  p-3 mb-2">
                <li class="list-group-item"><?= $kontakt->email() ?></li>
                <li class="list-group-item"><?= $kontakt->phone() ?></li>
            </ul>
        </div>
    <?php endforeach ?>
</div>


<?php snippet('footer') ?>