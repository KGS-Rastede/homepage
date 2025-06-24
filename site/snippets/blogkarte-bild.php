<?php

/**
 * Diese Snippet erstellt eine Karte zur Vorschau eines Blogsartikels. Dabei wird ein Bild des Artikels (wenn vorhanden)
 * angezeigt. Zusätzlich ist die Überschrift, sowie ein kleiner Auszug aus dem Artikel enthalten. Unten in der Karte
 * befindet sich ein Knopf zum weiterlesen.
 *
 *
 * Folgende Logik guckt an verschiedenen Stellen eines Artikels/Blogs, ob dort Bilder vorhanden sind, die dann in der
 * Blogkarte angezeigt werden könnnen
 */
$blogCardImage = null; // das Bild was in der Blogkarte angezeigt werden soll
$blogCardImageAlt = ''; // der Alternativtext vom Bild
if (
  $block = $subpage
    ->text()
    ->toBlocks()
    ->filterBy('type', '==', 'image')
    ->first()
) {
  // Erstes Bild als Block
  $blogCardImage = $block->image()->toFile();
  $blogCardImageAlt = $block->alt();
} elseif (
  $block = $subpage
    ->text()
    ->toBlocks()
    ->filterBy('type', '==', 'gallery')
    ->first()
) {
  // Erste Gallery als Block
  $blogCardImage = $block->images()->toFiles()->first();
} elseif (
  $block = $subpage
    ->text()
    ->toBlocks()
    ->filterBy('type', '==', 'karousel')
    ->first()
) {
  // Erstes Karousel als Block
  $blogCardImage = $block->karousel()->first()->toFile();
} elseif ($image = $subpage->gallery()->toFile()) {
  // Bei alten Artikeln gibt es eine gallery, die nicht im Block ist
  $blogCardImage = $image;
} elseif (
  $image = $subpage->downloads()->filterBy('type', '==', 'image')->first()
) {
  // Bilder, die bei "Zugehörige Dateien" ausgewählt wurden
  $blogCardImage = $image->toFile();
}
?>

<div class="basis-1/4">
  <div
    class="col-span-1 flex flex-col px-2 pt-3 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg  md:px-4 h-full bg-slate-50 hover:bg-slate-100">
    <?php if ($blogCardImage): ?>
      <img src="<?= $blogCardImage->url() ?>" class="mb-2 w-full rounded-2xl" alt="<?= $blogCardImageAlt ?>">
    <?php endif; ?>


    <h3 class="text-xl font-semibold mt-2 mb-2 text-red-700">
      <?= $subpage->title() ?>
    </h3>

    <p>
      <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
      <?php if ($subpage->author()->isNotEmpty()): ?>
        (<?= $subpage->author() ?>)
      <?php endif; ?>
    </p>

    <div class="text-right">
      <?php snippet('knopf-klein', [
        'subpage' => $subpage,
        'knopftext' => 'weiterlesen',
      ]); ?>
    </div>
  </div>
</div>