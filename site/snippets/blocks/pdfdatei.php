<!-- 
  site/blueprints/blocks/pdfdatei.php
 -->
<div class="container">
  <a href="<?= $block->pdfdatei()->toFile() ?>">
    <button type="button" class="btn btn-lg bd-btn-lg btn-bd-danger d-flex align-items-center justify-content-center fw-semibold">
      <i class="bi bi-file-pdf"></i> <?= $block->beschriftung() ?>
    </button>
  </a>
</div>