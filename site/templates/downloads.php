<?php snippet('header') ?>
<?php snippet('page-header') ?>


<p><?= $page->Subtitletext1() ?></p>
<div class="row row-cols-3">
    <div class="col-lg-4 ml-auto mr-auto">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Hauptschule</h4>
            </div>
            <div class="card-body">
                <div class="card card-nav-tabs">
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
                                        <td><?= $liste->name() ?>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <svg class="bi" width="24" height="24">
                                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                                                    </svg>
                                                </button>
                                            </a>
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

    <div class="col-lg-4 ml-auto mr-auto">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Realschule</h4>
            </div>
            <div class="card-body">
                <div class="card card-nav-tabs">
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
                                        <td><?= $liste->name() ?>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <svg class="bi" width="24" height="24">
                                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                                                    </svg>
                                                </button>
                                            </a>
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

    <div class="col-lg-4 ml-auto mr-auto">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Gymnasium</h4>
            </div>
            <div class="card-body">
                <div class="card card-nav-tabs">
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
                                        <td><?= $liste->name() ?>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <svg class="bi" width="24" height="24">
                                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#cloud-download" />
                                                    </svg>
                                                </button>
                                            </a>
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



<?php snippet('sidebar') ?>
<?php snippet('footer') ?>