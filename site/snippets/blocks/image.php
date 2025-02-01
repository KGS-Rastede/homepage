<?php

/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;

if ($block->location() == 'web') {
  $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
  $alt = $alt ?? $image->alt();
  $src = $image->url();
}

/**
 * Erweiterung, um Bilder links/rechts/mittig darzustellen
 * https://getbootstrap.com/docs/5.3/content/images/#responsive-images
 */
$orientation = $block->orientation() == 'links' ? 'float-start' : ($block->orientation() == 'rechts' ? 'float-end' : ($block->orientation() == 'mitte' ? 'mx-auto d-block' : ''));
?>


<?php if ($src) : ?>

  <div class="relative w-full">
    <figure>
      <img src="<?= $src ?>" alt="<?= $alt->esc() ?>" class="aspect-video w-full rounded-2xl bg-gray-100 object-cover sm:aspect-2/1 lg:aspect-3/2">
      <div class="absolute inset-0 rounded-2xl ring-1 ring-gray-900/10 ring-inset"></div>
      <?php if ($caption->isNotEmpty()) : ?>
        <figcaption>
          <?= $caption ?>
        </figcaption>
      <?php endif ?>
    </figure>
  </div>

<?php endif ?>