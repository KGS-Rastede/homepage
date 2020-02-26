<?php snippet('header') ?>
<?php snippet('page-header') ?>


<ul>
  <?php foreach ($page->sidebar()->toStructure() as $sidebar): ?>
  <li>
    <a href="<?= $sidebar->link() ?>">
      <?= $sidebar->name() ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>



<div class="container">
    <div class="content">
    <?php if($page->toggle()->bool() === true) :
            {?>
            <div class="row">
                <div class="col-md-9">
                    <div class="container"><?= $page->text()->kirbytext() ?></div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-group">
                                <a href="<?php echo $page->content()->url() ?>" class="list-group-item list-group-item-action"><?= $page->name() ?></a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            else:
            { ?>
                <div class="container"><?= $page->text()->kirbytext() ?></div>
            <?php }
            endif ?>

    </div>
</div>


<?php snippet('footer') ?>