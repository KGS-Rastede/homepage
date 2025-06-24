<div class="bg-white shadow-md rounded-md p-4 mb-3">
  <img src="<?= $block
    ->bild()
    ->toFile()
    ->url() ?>" class="w-full mb-3" alt="Fremdsprachen">

  <h3 class="text-warning text-lg font-bold mb-3">
    <?= $block->name() ?>
  </h3>
  <h4 class="text-base mb-3">
    <?= $block->kurzbeschreibung() ?>
  </h4>

  <div class="space-y-2">

    <?php
    $relatedPages = $block->unterseite()->toPages();

    foreach ($relatedPages as $relatedPage): ?>
      <a href="<?= $relatedPage->url() ?>" class="block p-2 border border-gray-200 rounded-md hover:bg-gray-50">
        <i class="bi bi-<?= $block->icon() ?>"></i>
        <?= $relatedPage->title() ?>
      </a>
    <?php endforeach;
    ?>

  </div>
</div>