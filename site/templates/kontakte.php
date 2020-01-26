<?php snippet('header') ?>

<?php snippet('page-header') ?>



<div class="team-1" id="team-1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title"><?= $page->title() ?></h2>
                <h5 class="description">
                    <?= $page->text() ?>
                </h5>
            </div>
        </div>
        <div class="row">
            <?php foreach ($page->children() as $kontakt) : ?>


                <div class="col-md-3">
                    <div class="card card-profile card-plain">
                        <div class="card-header card-avatar">
                            <a href="#pablo">
                                <img class="img" src="<?= $kontakt->images()->first()->url() ?>" />
                            </a>
                        </div>
                        <div class="card-body ">
                            <h4 class="card-title"><?= $kontakt->title() ?></h4>
                            <h6 class="card-category text-muted"><?= $kontakt->position() ?></h6>
                        </div>

                        <?php if ($kontakt->phone() != '') : ?>
                            <div class="card-footer justify-content-center">
                                <button class="btn btn-success btn-round">
                                    <i class="material-icons">local_phone</i><?= $kontakt->phone() ?>
                                </button>
                            </div>
                        <?php endif ?> 

                        <?php if ($kontakt->email() != '') : ?>
                            <div class="card-footer justify-content-center">
                                <a href="mailto:<?= $kontakt->email() ?>">
                                    <button class="btn btn-success btn-round">
                                        <i class="material-icons">email</i><?= $kontakt->email() ?>
                                    </button>
                                </a>
                            </div>
                        <?php endif ?> 

                    </div>
                </div>

            <?php endforeach ?>

        </div>
    </div>
</div>


<?php snippet('footer') ?>