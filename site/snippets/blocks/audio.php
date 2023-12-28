<!-- 
  site/blueprints/blocks/audio.php
 -->
<div class="container">
  <audio controls>
    <source src="<?= $block->soundfile()->toFile() ?>" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
  <blockquote class="border-l-4 border-gray-300 pl-4 py-2">
    <footer class="text-sm text-gray-500">
      <?= $block->name() ?>
    </footer>
  </blockquote>
</div>