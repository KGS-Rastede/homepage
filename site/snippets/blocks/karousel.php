<?php if ($block->karousel()->isNotEmpty()) : ?>
  <div class="col col-md-6">

    <?php
    $images =  $block->karousel()->toFiles();
    foreach ($images as $image) : ?>
      <img src="<?= $image->url() ?>" alt="">
    <?php endforeach ?>

  </div>
<?php endif ?>