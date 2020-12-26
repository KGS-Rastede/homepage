<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="container-fluid">
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
</div>

<?php snippet('footer') ?>