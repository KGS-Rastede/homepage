<?php snippet('header') ?>
<?php snippet('page-header') ?>

<ul class="nav nav-pills nav-pills-icons" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#schulbuchlisten-1" role="tab" data-toggle="tab">
            <i class="material-icons">dashboard</i>
            <?= $page->subtitle1() ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab">
            <i class="material-icons">schedule</i>
            <?= $page->subtitle2() ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#schulbusverkehr-1" role="tab" data-toggle="tab">
            <i class="material-icons">list</i>
            <?= $page->subtitle3() ?>
        </a>
    </li>
</ul>
<div class="tab-content tab-space">
    <div class="tab-pane active" id="schulbuchlisten-1">
        <h2><?= $page->subtitle1() ?></h2>
        <h4><?= $page->Subtitletext1() ?></h4>
        <div class="d-flex justify-content-around mt-2">
            <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Hauptschule</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mt-1 mb-2 text-muted">Braucht man den hier?</h6>
                <p class="card-text"><?= $page->cardtextHZ() ?></p>
                <div class="card card-nav-tabs" style="width: 100%;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr><th>Aktuelle Listen</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page->SchulbuchlistenHZ()->toStructure() as $liste) : ?>
                                <tr>
                                <td><?= $liste->name() ?><br>Leihgebühren: <?= $liste->preis() ?>
                                </td>
                                <td class="td-actions text-right">
                                    <a href="<?= $liste->link()->toFile()->url() ?>">
                                    <button type="button" rel="tooltip" class="btn btn-success btn-just-icon">
                                        <i class="material-icons">cloud_download</i>
                                    </button>
                                    </a>
                                <div class="text-left">
                                </div>
                                </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

            <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Realschule</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mt-1 mb-2 text-muted">Braucht man den hier?</h6>
                <p class="card-text"><?= $page->cardtextRZ() ?></p>
                <div class="card card-nav-tabs" style="width: 100%;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr><th>Aktuelle Listen</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page->SchulbuchlistenRZ()->toStructure() as $liste) : ?>
                                <tr>
                                <td><?= $liste->name() ?><br>Leihgebühren: <?= $liste->preis() ?>
                                </td>
                                <td class="td-actions text-right">
                                    <a href="<?= $liste->link()->toFile()->url() ?>">
                                    <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                        <i class="material-icons">cloud_download</i>
                                    </button>
                                    </a>
                                <div class="text-left">
                                </div>
                                </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Gymnasium</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 mt-1 text-muted">Card subtitle</h6>
                <p class="card-text"><?= $page->cardtextGZ() ?></p>
                <div class="card card-nav-tabs" style="width: 100%;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr><th>Aktuelle Listen</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page->SchulbuchlistenGZ()->toStructure() as $liste) : ?>
                                    <tr>
                                    <td><?= $liste->name() ?><br>Leihgebühren: <?= $liste->preis() ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="<?= $liste->link()->toFile()->url() ?>">
                                        <button type="button" rel="tooltip" class="btn btn-warning btn-just-icon">
                                            <i class="material-icons">cloud_download</i>
                                        </button>
                                        </a>
                                    <div class="text-left">
                                    </div>
                                    </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="schedule-1">
        <h2><?= $page->subtitle2() ?></h2>
      Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
      <br><br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
    </div>
    <div class="tab-pane" id="schulbusverkehr-1">
        <h2><?= $page->subtitle3() ?></h2>
        Dieser Tab soll später direkt über einen Link von einer Externen Seite aufgerufen werden, das funktioniert aber noch nicht.
    </div>
</div>


<?php snippet('sidebar') ?>
<?php snippet('footer') ?>