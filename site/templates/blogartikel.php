<?php snippet('default-page-layout', slots: true);
slot();
?>

<!-- Heading -->
<div class="mb-4">

  <?php snippet('tagliste', [
    'item' => $page,
  ]); ?>

  <?php if ($page->date()->isNotEmpty() || $page->author()->isNotEmpty()): ?>
  <h3 class="text-xl leading-relaxed font-medium text-slate-700 dark:text-slate-300">
    <?php if ($page->author()->isNotEmpty()): ?>
      <span class="mr-4 text-slate-600 dark:text-slate-300">
        <?= $page->author() ?>
      </span>
    <?php endif; ?>

    <?php if ($page->date()->isNotEmpty()): ?>
      <time datetime="<?= $page->date()->toDate('Y-m-d') ?>" class="font-semibold">
        <?= $page->date()->toDate('d.m.Y') ?>
      </time>
    <?php endif; ?>
  </h3>
<?php endif; ?>

</div>
<!-- END Heading -->

<!-- Blog Post -->
<article
  class="prose prose-lg dark:prose-invert prose-a:text-indigo-600 prose-a:no-underline prose-a:hover:text-indigo-400 prose-a:hover:opacity-75 dark:prose-a:text-indigo-400 dark:prose-a:hover:text-indigo-300 prose-img:rounded-lg"
    >

  <?php if ($page->text()->isEmpty()): ?>
    <p class="text-slate-500">Kein Inhalt vorhanden.</p>
  <?php else: ?>
    <?php foreach ($page->text()->toLayouts() as $layout): ?>
    <section class="grid" id="<?= $layout->id() ?>">
      <div class="grid grid-cols-1 md:grid-cols-<?= $layout
        ->columns()
        ->count() ?> gap-4 items-start">
        <?php foreach ($layout->columns() as $column): ?>
          <div>
            <div class="blocks">
              <?= $column->blocks() ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endforeach; ?>
  <?php endif; ?>

</article>
<!-- END Blog Post -->

<?php endslot(); ?>
<?php endsnippet(); ?>
