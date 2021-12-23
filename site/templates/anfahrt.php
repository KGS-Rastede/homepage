<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
    <div class="col-md-8 ms-auto me-auto text-center">
        <h2 class="title"> <?= $page->main_text() ?> </h2>
        <h5 class="description"> <?= $page->anfahrt_text() ?> </h5>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-auto ms-auto me-auto text-auto">
                <h6> <?= $page->adresse_s1()->toBlocks() ?> </h6>
            </div>

            <div class="col-md-auto ms-auto me-auto text-auto">
                <h6> <?= $page->adresse_s2()->toBlocks() ?> </h6>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-5 ms-auto me-auto text-start">
                <h5 class="description"> <?= $page->anfahrt_text_s1()->toBlocks() ?> </h5>
            </div>
            <div class="col-md-5 ms-auto me-auto text-auto">
                <h5 class="description"> <?= $page->anfahrt_text_s2()->toBlocks() ?> </h5>
            </div>
        </div>
    </div>

    <?= $page->karte()->toBlocks(); ?>

</div>
<?php snippet('footer') ?>