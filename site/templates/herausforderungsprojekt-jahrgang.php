<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<div class="container">

  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

      <?php foreach ($page->children() as $unterprojekt): ?>
        <a href="<?= $unterprojekt->url() ?>">
          <div class="group aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7">

            <img src="<?= $unterprojekt->teamlogo()->toFile()->url() ?>"
              class="aspect-[3/2] w-full rounded-2xl object-cover" alt="Teamlogo">
            <div class="mt-1">
              <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <?= $unterprojekt->title() ?>
              </h3>
              <p class="mt-5 leading-2 text-gray-600">
                <?= $unterprojekt->heading() ?>
              </p>
            </div>
          </div>

        </a>

      <?php endforeach; ?>

    </div>
  </div>
</div>

<?php snippet('sidebar'); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
