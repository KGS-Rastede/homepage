  <!-- Card Headings: Title with Subtitle -->
  <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm dark:bg-slate-800 dark:text-slate-100">
    <!-- Card Header -->
    <div class="bg-slate-50 px-5 py-4 dark:bg-slate-700/50">
      <h3 class="mb-1 font-semibold text-2xl">Aus der Presse</h3>
    </div>
    <!-- END Card Header -->

    <ul class="divide-y divide-slate-200 rounded-lg border border-slate-300 bg-white dark:divide-slate-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
      <?php
      $items = page('schule/presse')->pressenachrichten()->toStructure()->sortBy("datum")->flip()->limit(6);

      foreach ($items as $item) : ?>
        <li class="flex items-center even:bg-slate-50 odd:bg-white odd:hover:bg-slate-200 even:hover:bg-slate-300 justify-between p-4">
          <span class="mr-1 text-base"><a class="text-black text-decoration-none" href="<?= $item->link() ?>" target="_blank" rel="noopener"><?= $item->name() ?></a>
            (<?= $item->datum()->toDate('d.m.y') ?>)</span>
        </li>
      <?php endforeach ?>

    </ul>
  </div>
  <!-- END Card Headings: Title with Subtitle -->