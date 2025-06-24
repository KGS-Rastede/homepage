<div class="bg-white shadow-md rounded-md mb-3">
  <div class="p-4">
    <img src="<?= $block->bild()->toFile()->url() ?>">

    <h3 class="text-warning text-lg font-bold mb-3">
      <?= $block->name() ?>
    </h3>
    <h4 class="text-base mb-3">
      <?= $block->kurzbeschreibung() ?>
    </h4>

    <div class="group relative">

      <?php
      $relatedPages = $block->unterseite()->toPages();

      foreach ($relatedPages as $relatedPage): ?>
        <dl class="space-y-6 border-t border-slate-300 pt-6 shadow-sm hover:bg-slate-200 text-gray-500  bg-slate-50">

          <a href="<?= $relatedPage->url() ?>">
            <button type="button" class="ml-5 p-1.5 text-black ">

              <?= $relatedPage->title() ?>

              <i class="bi bi-<?= $block->icon() ?>"></i>

            </button>
          </a>
        </dl>
      <?php endforeach;
      ?>

    </div>
  </div>
</div>