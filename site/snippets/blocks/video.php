<?php if ($block->url()->isNotEmpty()): ?>

<div class="col col-md-10 col-lg-8 col-xl-7 col-xxl-6 py-2">
    <div class="embed-container">
        <?= video($block->url()) ?>
    </div>

    <?php if ($block->caption()->isNotEmpty()): ?>
        <div class="text-muted"><?= $block->caption() ?></div>            
    <?php endif ?>

</div>
<?php endif ?>


<!-- Das editor plugin verwendet diese Datei: https://github.com/getkirby/editor/wiki/Templates 
    video() : https://getkirby.com/docs/reference/templates/helpers/video
-->
