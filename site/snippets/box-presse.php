<!-- Karte mit Liste nach Tailkit a-c-list-groups-05 (Links with Images) -->
<div class="flex flex-col overflow-hidden my-4 rounded-lg bg-white shadow-xs dark:bg-slate-800 dark:text-slate-100">
  <!-- Card Header -->
  <div class="bg-slate-50 px-5 py-4 dark:bg-slate-800/50">
    <h3 class="mb-1 font-semibold text-2xl">Aus der Presse</h3>
  </div>
  <!-- END Card Header -->

  <nav class="divide-y divide-slate-200 dark:divide-slate-700">
    <?php
    $items = page('schule/presse')
      ->pressenachrichten()
      ->toStructure()
      ->sortBy('datum')
      ->flip()
      ->limit(6);

    foreach ($items as $item):

      // Je nach Link wird ein anderes Bild/Icon hinzugefügt
      $bildURL = $kirby->url('assets') . '/bilder/';
      switch ($item->medium()) {
        case 'nwz':
          $bildURL .= 'nwzonline-favicon.png';
          break;
        case 'youtube':
          $bildURL .= 'youtube-logo.svg';
          break;
        case 'rastederrundschau':
          $bildURL .= 'rasteder-rundschau-favicon.png';
          break;
        case 'gemeinde':
          $bildURL .= 'rastede-favicon.png';
          break;
        default:
          $bildURL = '';
      }
      ?>
      <a href="<?= $item->link() ?>" target="_blank" rel="noopener"
        class="flex items-center justify-between gap-4 p-4 text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700/50">
        <div class="flex items-center gap-4">
          <?php if (empty($bildURL)): ?>
            <i class="bi bi-box-arrow-up-right text-xl" aria-hidden="true"></i>
          <?php else: ?>
            <img src="<?= $bildURL ?>" width="20" alt="Logo der Presse-Seite" class="inline-block">
          <?php endif; ?>
          <div>
            <p class="text-base font-medium"><?= $item->name() ?></p>
            <p class="text-sm text-slate-500 dark:text-slate-400"><?= $item
              ->datum()
              ->toDate('d.m.Y') ?></p>
          </div>
        </div>
        <svg class="inline-block size-5 flex-none opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
          fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd"
            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
            clip-rule="evenodd" />
        </svg>
      </a>
    <?php
    endforeach;
    ?>
  </nav>
</div>
