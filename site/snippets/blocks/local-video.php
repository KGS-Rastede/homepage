<?php if ($block->video()->isNotEmpty()): ?>
  <video id="video" class="w-1/2" src="<?= $block
    ->video()
    ->toFile() ?>" controls></video>

  <?php if ($block->name()->isNotEmpty() || $block->autor()->isNotEmpty()): ?>
    <div class="w-full">
      <p class="text-2xl font-bold text-center">
        <?= $block->name() ?>
      </p>
      <p class="text-xl font-bold text-center">
        <?= $block->autor() ?>
      </p>
    </div>
  <?php endif; ?>

<?php endif; ?>
