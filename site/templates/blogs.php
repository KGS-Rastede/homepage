<?php snippet('default-page-layout', slots: true);
slot();
?>

<!-- Blog List Section: In Grid Alternate -->
<div class="space-y-16 py-10">

  <!-- Latest Posts -->
  <?php if ($articles->count() === 0 && isset($tag)): ?>
    <p class="text-center text-slate-500 dark:text-slate-400">Keine Artikel mit dem Tag „<?= html($tag) ?>"</p>
  <?php else: ?>
  <div class="grid grid-cols-1 gap-8 md:grid-cols-3 lg:gap-10">
    <?php foreach ($articles as $article) {
      snippet('blogkarte-bild', [
        'subpage' => $article,
      ]);
    } ?>
  </div>
  <?php endif; ?>
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
