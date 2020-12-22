<div class="card bg-primary d-inline-flex mb-2 ms-5">
    <div class="card-header p-2">
        <blockquote class="blockquote mb-0">
            <p>
                <?= $block->text() ?>
            </p>
            <?php if ($block->citation()->isNotEmpty()): ?>
                <div class="blockquote-footer p-0">
                    <cite>
                        <?= $block->citation() ?>
                    </cite>
                </div>
            <?php endif ?>
        </blockquote>
    </div>
</div>
<br>