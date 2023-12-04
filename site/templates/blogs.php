<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="container-fluid">
  <div class="row" id="masonry-element">
    <?php foreach($articles as $article)
      snippet('blogkartemasonry-noimage', [
        'subpage' => $article
      ])
    ?>
  </div>

  <div class="d-flex justify-content-center">
    <?php
      $pagination = $articles->pagination();

      snippet('pagination', [
        'pagination' => $pagination
      ])
    ?>
  </div>
</div>

<?= js('assets/js/load_masonry.js') ?>

<?php snippet('footer') ?>