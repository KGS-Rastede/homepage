<!-- 
  site/blueprints/blocks/grabstein.php
 -->

<?php if ($image = $block->grabsteinbild()->toFile()) : ?>
    <div class="card shadow-sm">
        <img width="200rm" src="<?= $image->url() ?>" alt="Grabstein von xxx" />

        <div class="card-body">
            <p class="card-text">Name: <?= $block->beschriftung() ?> geboren am <b><?= $block->gebdatum() ?></b></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">

                </div>
                <small class="text-muted">Max Mustermann</small>
            </div>
        </div>
    </div>

<?php endif ?>
