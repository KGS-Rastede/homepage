<div class="col-sm-6 col-lg-4 mb-4">

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4 p-1 text-danger">
                <div class="fs-4 fw-light ps-3">
                    <?= $subpage->title() ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">
                        <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
                        <?php if ($subpage->author()->isNotEmpty()) : ?>
                            (<?= $subpage->author() ?>)
                        <?php endif ?>
                    </p>
                    <p class="text-end">
                        <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>