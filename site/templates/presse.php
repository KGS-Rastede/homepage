<?php snippet('default-page-layout', slots: true);
slot();
?>

<div class="grid grid-cols-1 mb-8 gap-x-8 gap-y-16 pt-10 border-gray-200 lg:grid-cols-4">

  <?php
  // `toStructure()` erzeugt einen Iterator fuer die URLs
  $items = $page->pressenachrichten()->toStructure()->sortBy('datum')->flip();

  $list = $items->paginate(12);

  $quelle = '';

  // Nun kann man jede URL durchgehen und jeweils einen Links erzeugen
  foreach ($list as $item): ?>

    <?php if ($item->medium() == 'nwz') {
      $quelle = 'Nordwest Zeitung';
    } elseif ($item->medium() == 'youtube') {
      $quelle = 'YouTube';
    } elseif ($item->medium() == 'rastederrundschau') {
      $quelle = 'Rasteder Rundschau';
    } elseif ($item->medium() == 'gemeinde') {
      $quelle = 'Gemeinde Rastede';
    } else {
      $quelle = '';
    } ?>

    <a href="<?= $item->link() ?>">
      <article
        class="col-span-1 flex flex-col h-full px-2 py-6 text-gray-500 bg-slate-50 shadow-xl ring-1 ring-gray-900/5 group sm:mx-auto sm:max-w-lg sm:rounded-lg md:px-4 hover:bg-slate-100">

        <div class="flex items-center gap-x-4 text-xs">
          <time datetime="<?= $item->datum()->html() ?>">
            <?= $item->datum()->html() ?>
          </time>
          <span
            class="relative z-10 rounded-full bg-white px-3 py-1.5 font-medium">
            <?= $quelle ?>
          </span>
        </div>
        <div class="relative">
          <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-500">
            <span class="absolute inset-0"></span>
            <?= $item->name()->html() ?>
          </h3>
          <p class="mt-5 line-clamp-3 text-sm leading-6">
            <?= $item->anfang() ?>
          </p>
        </div>

      </article>
    </a>

  <?php endforeach;
  ?>
</div>


<?php $pagination = $list->pagination(); ?>
<?php snippet('pagination', ['pagination' => $pagination]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
