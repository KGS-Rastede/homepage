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

<!-- Karte nach Tailkit m-s-blog-lists-02 (In Grid) -->
<div class="flex h-full flex-col overflow-hidden rounded-lg bg-white shadow-xs dark:bg-slate-800 dark:text-slate-100">
  <?php if ($blogCardImage): ?>
    <a href="<?= $subpage->url() ?>" class="group relative block">
      <div
        class="absolute inset-0 flex items-center justify-center bg-kgs-blue/75 opacity-0 transition duration-150 ease-out group-hover:opacity-100">
        <svg class="inline-block size-10 -rotate-45 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
          fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd"
            d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
            clip-rule="evenodd" />
        </svg>
      </div>
      <img src="<?= $blogCardImage->url() ?>" class="aspect-4/3 w-full object-cover" alt="<?= $blogCardImageAlt ?>">
    </a>
  <?php endif; ?>

  <div class="flex grow flex-col p-6">
    <h3 class="mb-2 text-lg font-bold sm:text-xl">
      <a href="<?= $subpage->url() ?>"
        class="leading-7 text-kgs-blue hover:text-kgs-blue/75 dark:text-kgs-lblue dark:hover:text-kgs-lblue/75">
        <?= $subpage->title() ?>
      </a>
    </h3>

    <?php if ($subpage->date()->isNotEmpty()): ?>
      <p class="mb-3 text-sm font-medium text-slate-600 dark:text-slate-400">
        <?= $subpage->date()->toDate('d.m.Y') ?>
      </p>
    <?php endif; ?>

    <p class="grow leading-relaxed text-slate-600 dark:text-slate-400">
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