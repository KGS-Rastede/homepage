<?php snippet('header') ?>

<h1>Die Schulleitung</h1>


<div class="row row-cols-1 row-cols-md-4">
<?php foreach($page->children() as $kontakt): ?>
    <div class="col mb-4">
        <div class="card h-100" style="width: 16rem;">
            <img src="<?= $kontakt->images()->first()->url() ?>" class="card-img-top" alt="<?= $kontakt->images()->first()->alt() ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $kontakt->position() ?></h5>
                <p class="card-text"><?= $kontakt->title() ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= $kontakt->email() ?></li>
                <li class="list-group-item"><?= $kontakt->phone() ?></li>
            </ul>
        </div>
    </div>
<?php endforeach ?>
</div>


<?php snippet('footer') ?>