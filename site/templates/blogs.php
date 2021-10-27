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

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

<?= js('assets/js/masonry_neu_rendern.js') ?>

<?php snippet('footer') ?>