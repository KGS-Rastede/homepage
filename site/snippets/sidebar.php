<div class="container-fluid">
    <?php if ($page->sidebar()->isNotEmpty() or $page->related()->isNotEmpty()) : ?>
        <div class="row">
            <div class="col-lg-9">
                <div class="container"><?= $page->text()->blocks() ?></div>
            </div>

            <div class="col">
                <?php if ($page->sidebar()->isNotEmpty()) : ?>

                    <div class="card mb-3">
                        <h5 class="card-title text-center">
                            <?php if ($page->sidetitel()->isNotEmpty()) : ?>
                                <?= $page->sidetitel()->kirbytext() ?>
                            <?php else : ?>
                                <?= "Weitere Informationen" ?>
                            <?php endif ?>
                        </h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($page->sidebar()->toStructure() as $sidebar) : ?>
                                    <li class="list-group-item">
                                        <a href="<?= $sidebar->link() ?>"><?= $sidebar->name() ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>

                <?php endif ?>


                <?php if ($page->related()->isNotEmpty()) : ?>


                    <div class="card mb-3">
                        <h5 class="card-title text-center">
                            Weitere Informationen
                        </h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php $relatedPages =  $page->related()->toPages();
                                foreach ($relatedPages as $relatedPage) : ?>
                                    <li class="list-group-item">
                                        <a href="<?= $relatedPage->url() ?>"><?= $relatedPage->title() ?></a>
                                    </li>
                                <?php endforeach ?>

                            </ul>
                        </div>
                    </div>

                <?php endif ?>

                <?php if ($page->downloads()->isNotEmpty()) : ?>

                    <div class="card mb-3">
                        <h5 class="card-title text-center">
                            Zugehörige Downloads
                        </h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php
                                $dateien =  $page->downloads()->toFiles();
                                foreach ($dateien as $datei) : ?>
                                    <li class="list-group-item">
                                        <a href="<?= $datei->url() ?>"><?= $datei->name() ?></a>
                                    </li>
                                <?php endforeach ?>

                            </ul>
                        </div>
                    </div>
                <?php endif ?>


            </div>
        </div>
    <?php else : ?>
        <div class="container"><?= $page->text()->blocks() ?></div>
    <?php endif ?>
</div>