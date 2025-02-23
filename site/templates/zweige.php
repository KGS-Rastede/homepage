<?php snippet('default-page-layout', ['sidebarEnabled' => true], slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

  <?php foreach ($page->children() as $zweig): ?>
    <div class="bg-white p-4 shadow-md">
      <h1 class="mt-6 text-2xl font-semibold text-gray-900">
        <?= $zweig->title() ?>
      </h1>

      <h3 class="my-8 block text-gray-900">
        Leitung:
        <?= $zweig->leitung() ?>

      </h3>
      <?php snippet('knopf-klein', [
        'subpage' => $zweig,
        'knopftext' => 'Weitere Informationen',
      ]); ?>


    </div>
  <?php endforeach; ?>

</div>

<?php endslot(); ?>
<?php endsnippet(); ?>