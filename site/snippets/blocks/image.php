<?php if ($image = $block->image()->toFile()): ?>
    <figure <?= attr(['data-ratio' => $block->ratio(), 'data-crop' => $block->crop()->isTrue()], ' ') ?>>
        <?php if ($block->link()->isNotEmpty()): ?>
            <a href="<?= $block->link()->toUrl() ?>">
                <img src="<?= $image->url() ?>" alt="<?= $block->alt()->or($image->alt()) ?>" class="mw-100">
            </a>
            <?php else: ?>
            <img src="<?= $image->url() ?>" alt="<?= $block->alt()->or($image->alt()) ?>" class="mw-100">
        <?php endif ?>

        <?php if ($block->caption()->isNotEmpty()): ?>
            <figcaption class="fw-light fst-italic">
                <?= $block->caption() ?>
            </figcaption>
        <?php endif ?>
    </figure>
<?php endif ?>