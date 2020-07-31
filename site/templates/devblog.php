<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php foreach ($articles as $a) : ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Titel
            </h4>
            <p class="card-category">
                <div class="author text-right">
                    von
                    <b><?= $a->author() ?></b>
                    Datum: <?= $a->date()->toDate("d.m.Y") ?>
                </div>


            </p>
            <p class="card-text">
                moin
            </p>
            <a href="<?= $a->url() ?>" class="btn btn-secondary">weiterlesen &#8594;
            </a>


        </div>


    </div>
<?php endforeach ?>

<?php snippet('footer') ?>