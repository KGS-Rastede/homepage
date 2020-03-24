<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?= $page->text()->blocks() ?>

<div class="row">
  <?php foreach ($page->children() as $zweig) : ?>
    <div class="col-lg-3 col-md-6">
      <div class="card card-pricing card-background">
        <div class="card-body">
          <h3 class="card-category text-info"><?= $zweig->title() ?></h3>
          <h4 class="card-title">Leitung: <?= $zweig->leitung() ?></h4>

          <a href="<?= $zweig->url() ?>" class="btn btn-danger">
            Weitere Informationen
          </a>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>


<?php snippet('footer') ?>