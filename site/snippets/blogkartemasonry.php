<div class="col-sm-6 col-lg-4 mb-4">

    <?php if ($image = $subpage->gallery()->toFile()) : ?>

        <div class="card mb-3">
            <img src="<?= $image->url() ?>" class="card-img-top" alt="<?= $image->alt() ?>">

            <div class="fs-3 mt-3 fw-bold ps-3 text-danger">
                <?= $subpage->title() ?>
            </div>

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


    <?php elseif ($block = $subpage->text()->toBlocks()->filterBy("type", "==", "image")->first()) : ?>
        <?php $image = $block->image()->toFile() ?>

        <div class="card mb-3">
            <img src="<?= $image->url() ?>" class="card-img-top" alt="<?= $block->alt()->or($image->alt()) ?>">

            <div class="fs-3 mt-3 fw-bold ps-3 text-danger">
                <?= $subpage->title() ?>
            </div>

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


    <?php else : ?>

        <div class="card mb-3">
            <div class="p-1 text-danger">
                <div class="fs-3 mt-3 fw-bold ps-3">
                    <?= $subpage->title() ?>
                </div>
            </div>
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

    <?php endif ?>

</div>