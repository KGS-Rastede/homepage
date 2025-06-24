<div class="bg-white shadow-lg p-6 mb-6 px-8">
  <img src="<?= $block->bild()->toFile()->url() ?>">

  <h3 class="text-lg font-bold text-yellow-600 mb-2">
    <?= $block->name() ?>
  </h3>
  <h4 class="text-xl mb-4">
    <?= $block->kurzbeschreibung() ?>
  </h4>

  <div class="space-y-2">

    <?php
    $relatedPages = $block->unterseite()->toPages();

    foreach ($relatedPages as $relatedPage): ?>
      <a href="<?= $relatedPage->url() ?>" class="block py-2 px-4 border border-gray-200 rounded-md hover:bg-gray-50">
        <i class="bi bi-<?= $block->icon() ?>"></i>
        <?= $relatedPage->title() ?>
      </a>
    <?php endforeach;
    ?>

  </div>
</div>