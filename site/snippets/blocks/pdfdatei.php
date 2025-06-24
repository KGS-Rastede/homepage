<!-- 
  site/blueprints/blocks/pdfdatei.php
 -->
<div class="container">
  <a href="<?= $block->pdfdatei()->toFile() ?>">
    <button type="button"
      class="px-4 py-1 text-gray-900 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-slate-500 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 text-center"
      <i class="bi bi-file-pdf"></i>
      <?= $block->beschriftung() ?>
    </button>
  </a>
</div>