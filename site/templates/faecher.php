<?php snippet('default-page-layout', slots: true);
slot();
?>

<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
  <?php foreach ($page->children() as $fb): ?>

    <!-- Work List -->
    <div class="space-y-3 rounded-lg bg-gray-200/75 p-3.5 dark:bg-gray-700/75">
      <div class="flex items-center justify-between">
        <h3 class="font-semibold text-xl"><?= $fb->title() ?></h3>

      </div>
      <p class="text-base font-medium text-gray-600 dark:text-gray-400">
        <?= $fb->bezeichnung() ?>
      </p>
      <p class="text-lg font-medium text-gray-600 dark:text-gray-400">
        <?= $fb->namefbl() ?>
      </p>
      <div class="space-y-2">
        <?php
        $relatedPages = $fb->pages()->toPages();
        foreach ($relatedPages as $relatedPage): ?>
          <a href="<?= $relatedPage->url() ?>"
            class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm hover:opacity-75 active:opacity-100 dark:bg-gray-800 dark:text-gray-200">
            <div class="space-y-2 p-3 text-sm sm:p-4">
              <div class="h-2 w-10"></div>
              <p><?= $relatedPage->title() ?></p>
            </div>
          </a>
        <?php endforeach;
        ?>

      </div>
    </div>
    <!-- END Work List -->

  <?php endforeach; ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
