<div class="col-sm-6 col-lg-4 mb-4">

    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-danger fs-4">
                <?= $subpage->title() ?>
            </strong>

            <div class="mb-1 text-muted">
                <?php if ($subpage->author()->isNotEmpty()) : ?>
                    <?= $subpage->author() ?>
                <?php endif ?>
            </div>

            <p class="card-text mb-auto">
                <?= $subpage->Text()->toBlocks()->excerpt(250) ?>
            </p>

            <?php snippet('knopf-klein', ['subpage' => $subpage, 'knopftext' => "weiterlesen"]); ?>
        </div>
    </div>


</div>