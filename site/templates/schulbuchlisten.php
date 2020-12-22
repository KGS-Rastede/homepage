<?php snippet('header') ?>
<?php snippet('page-header') ?>


<p class="m-2"><?= $page->Subtitletext1() ?></p>
<div class="row ms-1 me-1">
    <div class="col-lg-4 ms-auto me-auto">
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
                                        <td class="td-actions text-end">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <svg class="bi" width="24" height="24">
                                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#file-earmark-text-fill" />
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

    <div class="col-lg-4 ms-auto me-auto">
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
                                        <td class="td-actions text-end">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <svg class="bi" width="24" height="24">
                                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#file-earmark-text-fill" />
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

    <div class="col-lg-4 ms-auto me-auto">
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
                                    <?php if($liste->link()->toFile()): ?>
                                        <tr>
                                            <td><?= $liste->name() ?>
                                            </td>
                                            <td class="td-actions text-end">
                                                <a href="<?= $liste->link()->toFile()->url() ?>">
                                                    <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                        <svg class="bi" width="24" height="24">
                                                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#file-earmark-text-fill" />
                                                        </svg>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif ?>
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