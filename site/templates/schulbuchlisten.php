<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container mx-auto">

    <div>
        <?= $page->text()->toBlocks() ?>
    </div>

    <div class="mt-4">
        <?= $page->Subtitletext1() ?>
    </div>


    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div
            class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <div class="flex max-w-xl flex-col items-start justify-between">

                <div class="group relative">
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
                                        <?php foreach ($page->SchulbuchlistenHZ()->toStructure() as $liste): ?>
                                            <tr>
                                                <td class="px-3">
                                                    <?= $liste->name() ?>
                                                </td>
                                                <td class="td-actions text-end">
                                                    <a href="<?= $liste->link()->toFile()->url() ?>">
                                                        <button type="button" rel="tooltip"
                                                            class="btn btn-primary btn-just-icon">
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

            </div>

            <div class="flex max-w-xl flex-col items-start justify-between">

                <div class="group relative">
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
                                        <?php foreach ($page->SchulbuchlistenRZ()->toStructure() as $liste): ?>
                                            <tr>
                                                <td class="px-3">
                                                    <?= $liste->name() ?>
                                                </td>
                                                <td class="td-actions text-end">
                                                    <a href="<?= $liste->link()->toFile()->url() ?>">
                                                        <button type="button" rel="tooltip"
                                                            class="btn btn-primary btn-just-icon">
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

            </div>

            <div class="flex max-w-xl flex-col items-start justify-between">

                <div class="group relative">

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
                                        <?php foreach ($page->SchulbuchlistenGZ()->toStructure() as $liste): ?>
                                            <?php if ($liste->link()->toFile()): ?>
                                                <tr>
                                                    <td class="px-3">
                                                        <?= $liste->name() ?>
                                                    </td>
                                                    <td class="td-actions text-end">
                                                        <a href="<?= $liste->link()->toFile()->url() ?>">
                                                            <button type="button" rel="tooltip"
                                                                class="btn btn-primary btn-just-icon">
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

        </div>
    </div>

</div>

<?php snippet('footertw') ?>