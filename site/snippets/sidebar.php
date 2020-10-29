<?php 
$sideE = $page->sidebar()->isNotEmpty();
$relaE = $page->related()->isNotEmpty();
$downE = $page->downloads()->isNotEmpty();
if ($sideE or $relaE or $downE) : ?>
    <div class="container"><?= $page->text()->blocks() ?></div>

    <div class="container">
        <hr class="mt-4 mb-4">

        <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center text-center">
            
            <?php if ($sideE) : 
                if ($relaE or $downE) : ?>
                    <div class="col-12 col-lg-4 flex-fill">
                <?php else : ?>
                    <div class="col-12 col-lg-4">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
                                <?php if ($page->sidetitel()->isNotEmpty()) : ?>
                                    <?= $page->sidetitel() ?>
                                <?php else : ?>
                                    Weitere Informationen
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
                    </div>
            <?php endif ?>


            <?php if ($relaE) :
                if ($sideE or $downE) : ?>
                    <div class="col-12 col-lg-4 ml-lg-3 flex-fill">
                <?php else : ?>
                    <div class="col-12 col-lg-4 ml-lg-3">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
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
                    </div>
            <?php endif ?>

            <?php if ($downE) :
                if ($sideE or $relaE) : ?>
                    <div class="col-12 col-lg-4 ml-lg-3 flex-fill">
                <?php else : ?>
                    <div class="col-12 col-lg-4 ml-lg-3">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
                                Zugehörige Downloads
                            </h5>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php
                                    $dateien =  $page->downloads()->toFiles();
                                    foreach ($dateien as $datei) : ?>
                                        <li class="list-group-item">
                                            <a href="<?= $datei->url() ?>"><?= $datei->anzeigename()->or($datei->name()) ?></a>
                                        </li>
                                    <?php endforeach ?>

                                </ul>
                            </div>
                        </div>
                    </div>
            <?php endif ?>

        </div>

    </div>

<?php else : ?>
    <div class="container"><?= $page->text()->blocks() ?></div>
<?php endif ?>
