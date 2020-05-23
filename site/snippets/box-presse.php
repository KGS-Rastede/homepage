<div class="card mb-1">
    <div class="card-body ">
        <h4 class="card-category text-primary">Aus der Presse</h4>
        <ul>
            <?php
            $items = page('allgemeines/schulstruktur/presse')->pressenachrichten()->toStructure()->sortBy("datum")->flip()->limit(6);

            foreach ($items as $item) : ?>
                <li>
                    <a class="card-link" href="<?= $item->link() ?>"><?= $item->name() ?></a>
                    (<?= $item->datum()->toDate('d.m.y') ?>)
                </li>


            <?php endforeach ?>
        </ul>
    </div>
</div>