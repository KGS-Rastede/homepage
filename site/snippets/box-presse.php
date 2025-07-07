  <!-- Card Headings: Title with Subtitle -->
  <div class="flex flex-col overflow-hidden my-4 rounded-lg bg-white shadow-sm dark:bg-slate-800 dark:text-slate-100">
    <!-- Card Header -->
    <div class="bg-slate-50 px-5 py-4 dark:bg-slate-800/50">
      <h3 class="mb-1 font-semibold text-2xl">Aus der Presse</h3>
    </div>
    <!-- END Card Header -->

    <ul class="divide-y divide-slate-200 rounded-lg border border-slate-300 bg-white dark:divide-slate-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
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
        <li class="flex items-center even:bg-slate-50 odd:bg-white odd:hover:bg-slate-200 even:hover:bg-slate-300 p-4">

          <?php
        // URL ist leer -> keine bestimmte Seite -> default icon
        ?>
          <?php if (empty($bildURL)) { ?>
            <i class="bi bi-box-arrow-up-right mr-4"></i>
            <?php
            // Sonst Bild einfügen
            ?>
          <?php } else { ?>
            <img src=<?= $bildURL ?> class="mr-4" width="20px" alt="Logo der Presse-Seite">
          <?php } ?>

          <span class="mr-1 text-base"><a class="no-underline text-black" href="<?= $item->link() ?>" target="_blank" rel="noopener"><?= $item->name() ?></a>
            (<?= $item->datum()->toDate('d.m.y') ?>)</span>
        </li>
      <?php
      endforeach;
      ?>

    </ul>
  </div>
  <!-- END Card Headings: Title with Subtitle -->