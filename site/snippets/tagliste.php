<?php if ($item->tags()->isNotEmpty()) : ?>
    <span>

        <svg class="bi" width="24" height="24">
                    <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
        </svg> Tags:

        <?php foreach ($item->tags()->split() as $tag) : ?>
            <a  class="badge rounded-pill bg-info text-decoration-none"
                href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                <?= $tag ?>
            </a>
        <?php endforeach ?>

    </span>
<?php endif ?>