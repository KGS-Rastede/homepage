<?php snippet('default-page-layout', slots: true);
slot();
?>

<!-- Blog List Section: In Grid Alternate -->
<div class="space-y-16 py-10">

  <!-- Latest Posts -->
  <div class="grid grid-cols-1 gap-8 md:grid-cols-3 lg:gap-10">
    <?php foreach ($articles as $article) {
      snippet('blogkarte-bild', [
        'subpage' => $article,
      ]);
    } ?>
  </div>
  <!-- END Latest Posts -->
</div>
<!-- END Blog List Section: In Grid Alternate -->



<div class="d-flex justify-content-center">
  <?php
  $pagination = $articles->pagination();

  snippet('pagination', [
    'pagination' => $pagination,
  ]);
  ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>