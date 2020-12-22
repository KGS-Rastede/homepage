<?php if ($block->url()->isNotEmpty()): ?>

<div class="col col-md-6">    
    <figure class="ratio ratio-16x9 fw-light">
        <?= video($block->url()) ?>
        <?php if ($block->caption()->isNotEmpty()): ?>
            <figcaption class="ratio ratio-16x9"><?= $block->caption() ?></figcaption>
        <?php endif ?>
    </figure>
</div>

<?php endif ?>
<!-- Das editor plugin verwendet diese Datei: https://github.com/getkirby/editor/wiki/Templates 
    Ratio class: https://v5.getbootstrap.com/docs/5.0/helpers/ratio/
    video() : https://getkirby.com/docs/reference/templates/helpers/video
-->