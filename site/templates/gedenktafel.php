<?php snippet('default-page-layout', slots: true);
slot();
?>


<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

  <?php foreach ($page->text()->toBlocks() as $block): ?>
    <div class="group aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7">

      <div class="mt-1">
        <?php echo $block->grabsteinbild()->toFile(); ?>

        <h2 class="mt-3 text-2xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          <?php echo $block->beschriftung(); ?>
        </h2>
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          geb.:
          <?php echo $block->gebdatum(); ?>
        </h3>
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          gestorben:
          <?php echo $block->todesdatum(); ?>
          </p>
      </div>

    </div>

  <?php endforeach; ?>

</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
