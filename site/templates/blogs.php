<?php snippet('header') ?>

<?php snippet('page-header') ?>



<div class="bg-slate-50 dark:bg-gray-900 dark:text-gray-100 px-4">
  <!-- Latest Posts -->
  <div class="grid gap-4 grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
    <?php foreach ($articles as $article)
      snippet('blogkarte-einfach', [
        'subpage' => $article
      ])
        ?>
    </div>
  </div>


  <div class="d-flex justify-content-center">
    <?php
    $pagination = $articles->pagination();

    snippet('pagination', [
      'pagination' => $pagination
    ])
      ?>
</div>

<?php snippet('footertw') ?>