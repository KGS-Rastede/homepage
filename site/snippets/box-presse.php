<div class="card card-pricing">
    <div class="card-body ">
        <h4 class="card-category text-primary">Aus der Presse</h4>
        <ul>
            <?php
            $items = page('allgemeines/schulstruktur/presse')->pressenachrichten()->toStructure()->sortBy("datum")->flip()->limit(6);

            foreach ($items as $item) : ?>
                <li>
                    <a class="alert-link" href="<?= $item->link() ?>" class="list-group-item list-group-item-action"><?= $item->name() ?></a>
                    (<?= $item->datum()->toDate('d.m.y') ?>)
                </li>


            <?php endforeach ?>
        </ul>
    </div>
</div>