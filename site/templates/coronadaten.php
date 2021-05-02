<?php snippet('header') ?>
<?php snippet('page-header') ?>


<?php snippet('sidebar') ?>

<div class="container">
  <div class="table-responsive">
    <?= snippet('box-coronadaten', ['coronapage' => $page]) ?>
  </div>

</div>

<?php snippet('footer') ?>