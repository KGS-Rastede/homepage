<?php if ($block->url()->isNotEmpty()): ?>

<div class="col col-md-6">    
    <!-- <div class="ratio ratio-16x9"> -->

        <?= video($block->url()) ?>
        <?php if ($block->caption()->isNotEmpty()): ?>
            <div><?= $block->caption() ?></div>
            <!-- <div class="ratio ratio-16x9"><?= $block->caption() ?></div> -->
        <?php endif ?>

    <!-- </div> -->
</div>

<?php endif ?>
<!-- Das editor plugin verwendet diese Datei: https://github.com/getkirby/editor/wiki/Templates 
    Ratio class: https://getbootstrap.com/docs/5.0/helpers/ratio/
    video() : https://getkirby.com/docs/reference/templates/helpers/video
-->
