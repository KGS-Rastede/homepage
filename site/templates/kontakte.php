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
                            <img class="img" src="<?= $kontakt->images()->first()->url() ?>" />                        
                        </div>
                        <div class="card-body ">
                            <h4 class="card-title"><?= $kontakt->title() ?></h4>
                            <h6 class="card-category text-muted"><?= $kontakt->position() ?></h6>
                        </div>

                        <?php if ($kontakt->phone() != '') : ?>
                            <div class="card-footer justify-content-center">
                                <button class="btn btn-success btn-round">
                                    <img src="<?= $kirby->url('assets') ?>/icons/phone.svg"><?= $kontakt->phone() ?>
                                </button>
                            </div>
                        <?php endif ?>

                        <?php if ($kontakt->email() != '') : ?>
                            <div class="card-footer justify-content-center">
                                    <button class="btn btn-success btn-round">
                                        <img src="<?= $kirby->url('assets') ?>/icons/envelope.svg">

                                        <script type="text/javascript">
                                            var mail = "<?= $kontakt->email() ?>";
                                            var en = "de";
                                            var dom = "kgs-rastede";
                                            var at = "@";
                                            document.open();
                                            document.write(unescape("%3Ca class='GrosserLink' href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                                            document.close();
                                        </script>
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