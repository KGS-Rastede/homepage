<?php snippet('default-page-layout', slots: true);
slot();
?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    <?= $page->beratungstyp()->toBlocks() ?>
</div>

<?php snippet('sidebar'); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
