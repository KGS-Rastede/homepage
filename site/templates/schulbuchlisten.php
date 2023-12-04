<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="container"><?= $page->text()->toBlocks() ?></div>


<p class="m-2"><?= $page->Subtitletext1() ?></p>
<div class="row ms-1 me-1">
    <div class="col-lg-4 ms-auto me-auto mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hauptschule</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th colspan="2" class="p-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page->SchulbuchlistenHZ()->toStructure() as $liste) : ?>
                                <tr>
                                    <td class="px-3"><?= $liste->name() ?>
                                    </td>
                                    <td class="td-actions text-end">
                                        <a href="<?= $liste->link()->toFile()->url() ?>">
                                            <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                <i class="bi bi-file-earmark-text-fill"></i>
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

    <div class="col-lg-4 ms-auto me-auto mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Realschule</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th colspan="2" class="p-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page->SchulbuchlistenRZ()->toStructure() as $liste) : ?>
                                <tr>
                                    <td class="px-3"><?= $liste->name() ?>
                                    </td>
                                    <td class="td-actions text-end">
                                        <a href="<?= $liste->link()->toFile()->url() ?>">
                                            <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                <i class="bi bi-file-earmark-text-fill"></i>
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

    <div class="col-lg-4 ms-auto me-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Gymnasium</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th colspan="2" class="p-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page->SchulbuchlistenGZ()->toStructure() as $liste) : ?>
                                <?php if ($liste->link()->toFile()) : ?>
                                    <tr>
                                        <td class="px-3"><?= $liste->name() ?>
                                        </td>
                                        <td class="td-actions text-end">
                                            <a href="<?= $liste->link()->toFile()->url() ?>">
                                                <button type="button" rel="tooltip" class="btn btn-primary btn-just-icon">
                                                    <i class="bi bi-file-earmark-text-fill"></i>
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

<?php snippet('footer') ?>