<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">

  <?php
  $images =  $page->gallery()->toFiles();
  foreach($images as $image): ?>
    <img class="w-100 img img-raised rounded" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">


    <h1><?= $image->ort() ?></h1>
    <h2><?= $image->beschreibung() ?></h2>
  <?php endforeach ?>

</div>

<?php snippet('footer') ?>