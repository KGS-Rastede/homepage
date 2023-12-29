<?php if ($block->lesensieauch()->isNotEmpty()): ?>
  <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm my-4 dark:bg-gray-800 dark:text-gray-100">
    <div
      class="w-full grow space-y-4 border-l-8 border-red-500 p-5 sm:flex sm:items-center sm:justify-between sm:space-x-2 sm:space-y-0">

      <div class="flex">
        <div class="ml-3">
          <p class="text-xl">
            <?= $block->lesensieauchtitel()->or("Lesen Sie auch...") ?>
          </p>

          <?php $linkziele = $block->lesensieauch()->toPages();
          foreach ($linkziele as $linkziel): ?>
            <p class="mt-2">
              <a href="<?= $linkziel->url() ?>" class="text-2xl underline hover:text-yellow-600">
                <?= $linkziel->title() ?>
              </a>
            </p>
          <?php endforeach ?>

        </div>
      </div>
    </div>
  </div>
<?php endif ?>