<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="row">
  <div class="col-md-12">
    <div class="blogpost">
      <div class="container">
        <?= $page->intro()->kirbytext() ?>

        <div class="text-right">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
          </svg> Tags:

          <?php foreach ($page->tags()->split() as $tag) : ?>
            <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
              <span class="badge rounded-pill bg-info"><?= $tag ?></span>
            </a>
          <?php endforeach ?>
        </div>
        <?= $page->text()->blocks() ?>

        <div class="text-right">
          <a href="<?= url('devblog') ?>" class="btn btn-secondary">
            zurück zur Übersicht &#8594;
          </a>
        </div>

      </div>
    </div>
  </div>
</div>




<?php snippet('footer') ?>