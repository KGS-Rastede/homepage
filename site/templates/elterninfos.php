<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">
  <?= $page->textfeld()->kt() ?>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 justify-content-center">

    <?php foreach ($page->text()->toBlocks() as $block): ?>

      <div class="card mx-1 mb-3">
        <div class="card-header">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
              d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
          </svg>
          <?= $block->name() ?>
        </div>
        <div class="card-body">
          <h5 class="card-title">
            <?= $block->kurzbeschreibung()->kt() ?>
          </h5>
          <p class="card-text">
          <p class="mb-auto">

            <?= $block->kurzbeschreibung()->kt() ?>

          </p>

          <a href="<?= $block->link()->toUrl() ?>">Öffnen...</a>

        </div>
      </div>


    <?php endforeach ?>

  </div>

</div>

<?php snippet('footer') ?>