<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
    <div class="content">
    <?php if($page->toggle()->bool() === true) :
            {?>
            <div class="row">
                <div class="col-md-9">
                    <div class="container"><?= $page->text()->kirbytext() ?></div>
                </div>
                <div class="col-md-3">
                    <div class="card"><a href="#"><?= $page->name() ?></a></div>
                </div>
            </div>
            <?php }
            else:
            { ?>
                sdfjkdsfh
            <?php }
            endif ?>

    </div>
</div>


<?php snippet('footer') ?>