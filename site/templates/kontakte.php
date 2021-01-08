<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="container-fluid">
    <div class="col-md-8 ms-auto me-auto text-center">
        <h2 class="title"><?= $page->title() ?></h2>
        <h5 class="description">
            <?= $page->text() ?>
        </h5>
    </div>

    <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-8">
        <?php foreach ($page->children() as $kontakt) : ?>
            <div class="col mb-4">

                <div class="card h-100">
                    <img class="card-img-top" src="<?= $kontakt->images()->first()->url() ?>" />
                    <div class="card-body">
                        <h5 class="card-title"><?= $kontakt->title() ?></h4>
                            <p class="card-text"><?= $kontakt->position() ?></h6>
                    </div>

                    <?php if ($kontakt->phone()->isNotEmpty() or $kontakt->email()->isNotEmpty()) : ?>
                        <div class="card-footer">
                            <?php if ($kontakt->phone()->isNotEmpty()) : ?>
                                <p>
                                    <i class="bi bi-phone"></i>

                                    <?= $kontakt->phone() ?>
                                </p>
                            <?php endif ?>

                            <?php if ($kontakt->email()->isNotEmpty()) : ?>
                                <p>
                                    <i class="bi bi-envelope"></i>                                 

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
</div>




<?php snippet('footer') ?>