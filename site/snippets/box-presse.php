  <!-- Card Headings: Title with Subtitle -->
  <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800 dark:text-gray-100">
    <!-- Card Header -->
    <div class="bg-gray-50 px-5 py-4 dark:bg-gray-700/50">
      <h3 class="mb-1 font-semibold">Aus der Presse</h3>
    </div>
    <!-- END Card Header -->

    <ul class="divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
      <?php
      $items = page('schule/presse')->pressenachrichten()->toStructure()->sortBy("datum")->flip()->limit(6);

      foreach ($items as $item) : ?>
        <li class="flex items-center even:bg-gray-50 odd:bg-white hover:bg-gray-300 justify-between p-4">
          <span class="mr-1 text-base"><a class="text-black text-decoration-none" href="<?= $item->link() ?>" target="_blank" rel="noopener"><?= $item->name() ?></a>
            (<?= $item->datum()->toDate('d.m.y') ?>)</span>
        </li>
      <?php endforeach ?>

    </ul>
  </div>
  <!-- END Card Headings: Title with Subtitle -->
