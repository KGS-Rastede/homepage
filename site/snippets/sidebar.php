<?php //hier werden Variablen festgelegt, die mehrfach im snippet benutzt werden
$sideE = $page->sidebar()->isNotEmpty();
$relaE = $page->related()->isNotEmpty();
$downE = $page->downloads()->isNotEmpty();
if ($sideE or $relaE or $downE) : //wenn es in einer der Teile Inhalt gibt ?>
    <div class="container"><?= $page->text()->toBlocks() ?></div>

    <div class="container">
        <hr class="mt-4 mb-4">

        <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center text-center mb-3">
            
            <?php if ($sideE) : 
                if ($relaE or $downE) : //wenn in einem von beidem etwas drin ist ?>
                    <div class="col-12 flex-fill">
                <?php else : //wenn beide leer sind ?>
                    <div class="col-12 col-lg-5">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
                                <?= $page->sidetitel()->or("Weitere Informationen") ?>
                            </h5>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($page->sidebar()->toStructure() as $sidebar) : ?>
                                        <li class="list-group-item">
                                            <a href="<?= $sidebar->link() ?>"><?= $sidebar->name()->or($sidebar->link()) ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php endif ?>


            <?php if ($relaE) :
                if ($sideE) : //wenn nicht erstes Objekt ?>
                    <div class="col-12 ms-lg-3 flex-fill">
                <?php elseif ($downE) : //wenn trotzdem nicht alleine ?>
                    <div class="col-12 flex-fill">
                <?php else : //wenn beide leer sinds ?>
                    <div class="col-12 col-lg-5">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
                                <?= $page->relatedtitel()->or("Weitere Informationen") ?>
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
                if ($sideE or $relaE) : //wenn in einem von beidem etwas drin ist ?>
                    <div class="col-12 ms-lg-3 flex-fill">
                <?php else : //wenn beide leer sind ?>
                    <div class="col-12 col-lg-5">
                <?php endif ?>
                        <div class="card mb-3">
                            <h5 class="card-title">
                                <?= $page->downloadtitel()->or("Zugehörige Downloads") ?>
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

<?php else : //wenn alle Teile leer sind ?>
    <div class="container"><?= $page->text()->toBlocks() ?></div>
<?php endif ?>
