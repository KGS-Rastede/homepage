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

    <article
      class="col-span-1 flex flex-col px-2 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-2 md:px-4 h-full bg-slate-50 hover:bg-slate-100">
      <div class="flex items-center gap-x-4 text-xs">
        <time datetime="<?= $item->datum()->html() ?>" class="text-gray-500">
          <?= $item->datum()->html() ?>
        </time>
        <a href="#"
          class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
          <?= $quelle ?>
        </a>
      </div>
      <div class="group relative">
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          <a href="<?= $item->link() ?>">
            <span class="absolute inset-0"></span>
            <?= $item->name()->html() ?>
          </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
          <?= $item->anfang() ?>
        </p>
      </div>
    </article>

  <?php endforeach;
  ?>
</div>


<?php $pagination = $list->pagination(); ?>
<?php snippet('pagination', ['pagination' => $pagination]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
