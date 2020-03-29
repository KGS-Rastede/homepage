<?php snippet('header') ?>
<?php snippet('page-header') ?>


<h2><?= $page->subtitle1() ?></h2>
<h4><?= $page->Subtitletext1() ?></h4>
<div class="d-flex justify-content-around mt-2">
    <div class="card">
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
                            <tr>
                                <th>Aktuelle Listen</th>
                            </tr>
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

    <div class="card">
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
                            <tr>
                                <th>Aktuelle Listen</th>
                            </tr>
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

    <div class="card">
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
                            <tr>
                                <th>Aktuelle Listen</th>
                            </tr>
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



<?php snippet('sidebar') ?>
<?php snippet('footer') ?>