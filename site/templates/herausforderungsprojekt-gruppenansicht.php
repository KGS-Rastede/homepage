<?php snippet('default-page-layout', ['sidebarEnabled' => true], slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<h2 class="sr-only">Bilder des Herausfordungsprojekts</h2>

<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

  <?php
  $images = $page->gallery()->toFiles();
  foreach ($images as $image): ?>
    <div class="group aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7">

      <img alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">

      <h1><?= $image->ort() ?></h1>
      <h2><?= $image->beschreibung() ?></h2>
    </div>
  <?php endforeach;
  ?>

</div>


<?php endslot(); ?>
<?php endsnippet(); ?>
