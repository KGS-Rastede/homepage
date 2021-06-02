<div class="card mt-5 mb-3">
    <div class="card-body ">
        <h2 class="card-category">Aus der Presse</h2>
        <?php
        $items = page('schule/presse')->pressenachrichten()->toStructure()->sortBy("datum")->flip()->limit(6);

        foreach ($items as $item) : ?>
            <p>
                <a class="text-decoration-none" href="<?= $item->link() ?>" target="_blank" rel="noopener"><?= $item->name() ?></a>
                (<?= $item->datum()->toDate('d.m.y') ?>)
            </p>


        <?php endforeach ?>

    </div>
</div>