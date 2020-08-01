<?php snippet('header') ?>

<?php snippet('page-header') ?>



<div class="col-md-8 ml-auto mr-auto text-center">
    <h2 class="title"><?= $page->title() ?></h2>
    <h5 class="description">
        <?= $page->text() ?>
    </h5>
</div>

<div class="row row-cols-1 row-cols-md-3">
    <?php foreach ($page->children() as $kontakt) : ?>
        <div class="col mb-4">

            <div class="card">
                <img class="card-img-top" src="<?= $kontakt->images()->first()->url() ?>" />
                <div class="card-body">
                    <h5 class="card-title"><?= $kontakt->title() ?></h4>
                        <p class="card-text"><?= $kontakt->position() ?></h6>
                </div>

                <?php if ($kontakt->phone()->isNotEmpty() or $kontakt->email()->isNotEmpty()) : ?>
                    <div class="card-footer">
                        <?php if ($kontakt->phone()->isNotEmpty()) : ?>
                            <p>

                                <svg class="bi" width="24" height="24">
                                    <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#phone" />
                                </svg>
                                <?= $kontakt->phone() ?>
                            </p>
                        <?php endif ?>

                        <?php if ($kontakt->email()->isNotEmpty()) : ?>
                            <p>

                                <svg class="bi" width="24" height="24">
                                    <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#envelope" />
                                </svg>

                                <script type="text/javascript">
                                    var mail = "<?= $kontakt->email() ?>";
                                    var en = "de";
                                    var dom = "kgs-rastede";
                                    var at = "@";
                                    document.open();
                                    document.write(unescape("%3Ca class='GrosserLink' href='mailto:" + mail + at + dom + "." + en + "'%3E" + mail + at + dom + "." + en + "%3C/a%3E"));
                                    document.close();
                                </script>
                            </p>
                        <?php endif ?>
                    </div>
                <?php endif ?>

            </div>

        </div>
    <?php endforeach ?>

</div>





<?php snippet('footer') ?>