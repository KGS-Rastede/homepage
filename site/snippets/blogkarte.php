<div class="col">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4 p-2 text-danger">
                <div class="fs-4 fw-light">
                    <?= $subpage->title() ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">
                        <?= $subpage->Text()->blocks()->excerpt(250) ?>
                        <?php if ($subpage->author()->isNotEmpty()) : ?>
                            (<?= $subpage->author() ?>)
                        <?php endif ?>
                    </p>
                    <p class="text-right">
                        <a class="text-decoration-none stretched-link" href="<?= $subpage->url() ?>">weiterlesen...</a>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>