<div class="container">
    <div class="content">
        <?php if($page->toggle()->bool() === true) : ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="container"><?= $page->text()->blocks() ?></div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h5 class="card-title">
                            <?php if($page->sidetitel()->isNotEmpty()): ?>
                                <?= $page->sidetitel()->kirbytext() ?>
                            <?php else: ?>
                                <?= "Weitere Informationen" ?>
                            <?php endif ?>
                        </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <?php foreach ($page->sidebar()->toStructure() as $sidebar): ?>
                                    <a href="<?= $sidebar->link() ?>" class="list-group-item list-group-item-action"><?= $sidebar->name() ?></a></li>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container"><?= $page->text()->blocks() ?></div>
        <?php endif ?>
    </div>
</div>