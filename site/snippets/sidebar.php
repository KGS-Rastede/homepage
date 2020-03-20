<div class="container">
    <div class="content">
        <?php if($page->toggle()->bool() === true) : ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="container"><?= $page->text()->blocks() ?></div>
                </div>
                <div class="col-md-3">
                    <div class="card card-pricing">
                        <div class="card-category text-primary">
                            <h5 class="card-title">
                            <?php if($page->sidetitel()->isNotEmpty()): ?>
                                <?= $page->sidetitel()->kirbytext() ?>
                            <?php else: ?>
                                <?= "Weitere Informationen" ?>
                            <?php endif ?>
                        </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($page->sidebar()->toStructure() as $sidebar): ?>
                                    <li class="list-group-item">
                                    <a href="<?= $sidebar->link() ?>" class="list-group-item list-group-item-action"><?= $sidebar->name() ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container"><?= $page->text()->blocks() ?></div>
        <?php endif ?>
    </div>
</div>