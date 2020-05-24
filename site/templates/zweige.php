<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?= $page->text()->blocks() ?>

<div class="section-a">
  <div class="container">
    <div class="row">
      <?php foreach ($page->children() as $zweig) : ?>
        <div class="col-md-4">
          <h3><?= $zweig->title() ?></h3>
          <p>Leitung: <?= $zweig->leitung() ?></p>
          <a href="<?= $zweig->url() ?>" class="btn btn-danger">
            Weitere Informationen
          </a>
        </div>
      <?php endforeach ?>

    </div>
  </div>
</div>



  <?php snippet('footer') ?>