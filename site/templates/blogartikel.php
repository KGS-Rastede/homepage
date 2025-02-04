<?php snippet('header') ?>

<?php snippet('page-header') ?>


<!-- Blog Post Section: Left Aligned With Extras -->
<div class="bg-white dark:bg-gray-800 dark:text-gray-100">
  <div
    class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl">
    <!-- Heading -->
    <div>
      <div
        class="mb-1 text-sm font-bold tracking-wider text-gray-600 uppercase dark:text-gray-500">
        <?php snippet('tagliste', [
          'item' => $page
        ]) ?>
      </div>

      <h3
        class="text-xl leading-relaxed font-medium text-gray-700 dark:text-gray-300">

        <?php if ($page->date()->isNotEmpty() || $page->author()->isNotEmpty()): ?>

          <a
            href="javascript:void(0)"
            class="text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-300"><?= $page->author() ?></a>
        <?php endif ?>
        <span class="font-semibold"><?= $page->date()->toDate("d.m.Y") ?></span>
      </h3>
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
            <?php endforeach ?>
          </div>
        </section>
      <?php endforeach ?>

    </article>
    <!-- END Blog Post -->
  </div>
</div>
<!-- END Blog Post Section: Left Aligned With Extras -->



<?php snippet('footertw') ?>