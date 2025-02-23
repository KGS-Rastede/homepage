<?php snippet('default-page-layout', slots: true);
slot();
?>

<!-- Heading -->
<div class="mb-4">

  <?php snippet('tagliste', [
    'item' => $page,
  ]); ?>

  <?php if ($page->date()->isNotEmpty() || $page->author()->isNotEmpty()): ?>
    <h3 class="text-xl leading-relaxed font-medium text-gray-700 dark:text-gray-300">
      <span class="me-4 text-gray-600 dark:text-gray-400">
        <?= $page->author() ?>
      </span>
      
      <span class="font-semibold">
        <?= $page->date()->toDate('d.m.Y') ?>
      </span>
    </h3>
  <?php endif; ?>
</div>
<!-- END Heading -->

<!-- Blog Post -->
<article
  class="prose prose-lg prose-gray dark:prose-invert prose-a:no-underline prose-a:hover:opacity-75 prose-img:rounded-lg">

  <?php foreach ($page->text()->toLayouts() as $layout): ?>
    <section class="grid" id="<?= $layout->id() ?>">
      <div class="row align-items-start">
        <?php foreach ($layout->columns() as $column): ?>
          <div class="col">
            <div class="blocks">
              <?= $column->blocks() ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endforeach; ?>

</article>
<!-- END Blog Post -->

<?php endslot(); ?>
<?php endsnippet(); ?>
