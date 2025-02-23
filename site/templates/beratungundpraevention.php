<?php snippet('default-page-layout', ['sidebarEnabled' => true], slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
  <?= $page->beratungstyp()->toBlocks() ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
