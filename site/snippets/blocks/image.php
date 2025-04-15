<?php

/** @var \Kirby\Cms\Block $block */
$alt = $block->alt();
$caption = $block->caption();
$crop = $block->crop()->isTrue();
$link = $block->link();
$ratio = $block->ratio()->or('auto');
$src = null;

if ($block->location() == 'web') {
  $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
  $alt = $alt ?? $image->alt();
  $src = $image->url();
}
?>


<?php if ($src): ?>

  <div class="relative w-1/2">

    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pt-80 pb-8 sm:pt-48 lg:pt-80">
      <img src="<?= $src ?>" alt="" class="absolute inset-0 -z-10 size-full object-cover">

      <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-gray-900/10 ring-inset"></div>

      <div class="flex bg-slate-400/50 justify-center rounded-2xl">
        <h3 class="mt-3 text-lg/6 font-semibold text-white pb-4 px-4">
          <?= $caption ?>
        </h3>
      </div>
    </article>
  </div>

<?php endif; ?>