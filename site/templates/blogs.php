<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php
  snippet('blog-schlicht', [
    'items' => $articles
  ])
?>

<div class="d-flex justify-content-center">
  <?php
    $pagination = $articles->pagination();

    snippet('pagination', [
      'pagination' => $pagination
    ])
  ?>
</div>

<?php snippet('footer') ?>