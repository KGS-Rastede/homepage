<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">

  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">

    <?php foreach ($page->children() as $unterprojekt) : ?>
      <a href="<?= $unterprojekt->url() ?>">
        <div class="card <?= $unterprojekt->teamfarbe() ?> mb-3">

          <div class="card-body">
            <h3 class="card-title mb-3 text-warning"><?= $unterprojekt->title() ?></h3>
            <h3 class="card-title"><?= $unterprojekt->heading() ?></h3>
          </div>
        </div>

      </a>

    <?php endforeach; ?>


  </div>
</div>

<?php snippet('footer') ?>