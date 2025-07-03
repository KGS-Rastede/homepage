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
  <!-- Item -->
  <div
    class="group relative overflow-hidden rounded-lg bg-slate-100 focus-within:ring-4 focus-within:ring-slate-500/50 focus-within:ring-offset-2 focus:ring-4 focus:ring-slate-500/50 focus:ring-offset-2 focus:outline-hidden dark:ring-offset-gray-900"
    tabindex="0"
  >
    <img
      src="<?= $src ?>"
      alt="<?= $alt ?>"
    />
    <!-- es folgt die Caption -->

    <?php if ($caption->isNotEmpty()): ?>
      <div
        class="absolute inset-0 flex translate-x-full flex-col items-center justify-center rounded-sm bg-indigo-900/80 opacity-0 transition duration-300 ease-out group-focus-within:translate-x-0 group-focus-within:opacity-100 group-hover:translate-x-0 group-hover:opacity-100 group-focus:translate-x-0 group-focus:opacity-100"
      >
        <div class="text-center">
          <h4 class="text-lg font-semibold text-white"><?= $caption ?></h4>      
        </div>
      </div>
    <?php endif; ?>
    <!-- ENDE Caption -->

  </div>
  <!-- END Item -->
<?php endif; ?>
