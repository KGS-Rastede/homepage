<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php
  snippet('blog-schlicht', [
    'items' => $articles
  ])
?>


<?php
  $pagination = $articles->pagination();

  snippet('pagination', [
    'pagination' => $pagination
  ])
?>

<?php snippet('footer') ?>