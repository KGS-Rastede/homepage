<div class="card mb-3 mt-3">
    <div class="card-body ">
        <h4 class="card-category">Das Neueste aus der Schule</h4>

        <ul class="list-group">

            <?php
                $articles = page('blogs')->children()->listed()->flip()->limit(10);

                foreach ($articles as $item) : ?>
                    <a href="<?= $item->url() ?>" class="list-group-item list-group-item-action"><?= $item->title() ?></a>
                <?php endforeach ?>

        </ul>
    </div>
</div>