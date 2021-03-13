<!-- 
  site/blueprints/blocks/audio.php
 -->
<div class="container">
  <audio controls>
    <source src="<?= $block->soundfile()->toFile() ?>" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
  <div class="blockquote-footer p-3 ">
     <?= $block->name() ?>
  </div>
</div>