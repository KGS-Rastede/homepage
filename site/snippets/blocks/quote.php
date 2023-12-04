<figure class="text-center">
    <div class="kgs-transitions zoom">
        <p class="font-monospace lh-lg">&bdquo;<?= $block->text() ?>&ldquo;</p>
    </div>
    <?php if ($block->citation()->isNotEmpty()) : ?>
        <figcaption class="blockquote-footer">
            <?= $block->citation() ?>
        </figcaption>
    <?php endif ?>
</figure>