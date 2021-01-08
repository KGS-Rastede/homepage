<?php if ($item->tags()->isNotEmpty()) : ?>
    <span>
        <i class="bi bi-tags"></i> Tags:

        <?php foreach ($item->tags()->split() as $tag) : ?>
            <a  class="badge rounded-pill bg-info text-decoration-none"
                href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                <?= $tag ?>
            </a>
        <?php endforeach ?>

    </span>
<?php endif ?>