<?php snippet('default-page-layout', slots: true);
slot();
?>

<p>
  <?= $page->Beschreibung()->kirbytext() ?>
</p>

<div class="grid grid-cols-1 py-4 px-6 gap-x-8 gap-y-16 text-center lg:grid-cols-3 lg:px-8">

  <?php
  $dateien = $page->dateien()->toFiles();
  foreach ($dateien as $datei): ?>
    <div class="group  bg-slate-100 p-4">

      <div class="mb-4">
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
          <?= $datei->anzeigename()->or($datei->name()) ?>
        </h3>
        <p class="mt-5 leading-6 text-gray-600">
          <?= $datei->beschreibung() ?>
        </p>

      </div>
      <?php snippet('knopf-klein', [
        'subpage' => $datei,
        'knopftext' => 'Datei herunterladen',
      ]); ?>

    </div>

  <?php endforeach;
  ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
