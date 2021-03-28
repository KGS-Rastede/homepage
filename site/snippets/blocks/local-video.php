<?php if ($block->video()->isNotEmpty()) : ?>
  <div class="col col-md-6">

    <video id="video" class="w-100" controls="" src="<?= $block->video()->toFile() ?>"></video>
    
    <?php if ($block->name()->isNotEmpty() || $block->autor()->isNotEmpty()) : ?>
      <div class="blockquote-footer pt-3">

        <?php if ($block->name()->isNotEmpty()) : ?>          
            <cite class="me-3" title="Source Title"><?= $block->name() ?></cite>          
        <?php endif ?>

        <?php if ($block->autor()->isNotEmpty()) : ?>          
            <cite title="Source Author">von: <?= $block->autor() ?></cite>          
        <?php endif ?>
        
      </div>
    <?php endif ?>

  </div>
<?php endif ?>