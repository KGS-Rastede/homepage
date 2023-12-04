<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">

  <?php foreach ($page->children() as $fb) : ?>
    <div class="card mb-3">




      <div class="card-body">
        <?php
        $images =  $fb->symbolbild()->toFiles();
        foreach ($images as $image) : ?>
          <img src="<?= $image->url() ?>" alt="">
        <?php endforeach ?>



        <h3 class="card-title mb-3 text-warning"><?= $fb->title() ?></h3>
        <h3 class="card-title"><?= $fb->bezeichnung() ?>:</h3>
        <h3> <?= $fb->namefbl() ?></h3>
        <div class="list-group text-white">


          <?php
          $relatedPages =  $fb->pages()->toPages();
          foreach ($relatedPages as $relatedPage) : ?>

            <a href="<?= $relatedPage->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
              <?= $relatedPage->title() ?>
            </a>

          <?php endforeach ?>




        </div>
      </div>



    </div>
  <?php endforeach; ?>
</div>



</div>


<?php snippet('footer') ?>