<div class="author text-right">
    
    <?php foreach ($item->tags()->split() as $tag) : ?>
        <a href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
            <span class="badge rounded-pill bg-info"><?= $tag ?></span>
        </a>
    <?php endforeach ?>

</div>