<div class="col">
    <div class="card mt-3 mb-3 bg-gradient bg-success text-black">
        <div class="card-body">
            <h3 class="card-title"><?= $subpage->title() ?></h3>

            <p>
                <?= $subpage->text()->toBlocks() ?>
            </p>

            <div class="container bg-gradient rounded">
                <?php if ($file = $subpage->downloads()->toFile()) : ?>

                    <h5 class="lead mt-5 text-black">Passende Downloads</h5>


                    <?php $dateien = $subpage->downloads()->toFiles();
                    foreach ($dateien as $datei) : ?>


                        <a href="<?php echo $datei->url() ?>" download="<?php echo $datei->filename() ?>" class="btn btn-primary mt-2">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#info-square" />
                            </svg>
                            <?php echo $datei->name() ?>

                        </a>

                    <?php endforeach ?>

                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<?php
$images =  $page->gallery()->toFiles();
foreach ($images as $image) : ?>
    <img src="<?= $image->url() ?>" alt="">
<?php endforeach ?>