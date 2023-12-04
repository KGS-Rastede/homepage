<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="container">
  <div class="blockqoute">
    <div class="d-flex justify-content-between mb-3">

      <?php if ($page->date()->isNotEmpty() || $page->author()->isNotEmpty()) : ?>
        <div class="mt-0 mb-0 h5">

          <?php if ($page->date()->isNotEmpty()) : ?>
            <?= $page->date()->toDate("d.m.Y") ?>,
          <?php endif ?>
          <?php if ($page->author()->isNotEmpty()) : ?>
            geschrieben von: <?= $page->author() ?>
          <?php endif ?>

        </div>

      <?php else : ?>
        <div></div>
      <?php endif ?>




      <?php snippet('tagliste', [
        'item' => $page
      ]) ?>
    </div>
  </div>



  <?php foreach ($page->text()->toLayouts() as $layout) : ?>
    <section class="grid" id="<?= $layout->id() ?>">
      <div class="row align-items-start">
        <?php foreach ($layout->columns() as $column) : ?>
          <div class="col">
            <div class="blocks">
              <?= $column->blocks() ?>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>
  <?php endforeach ?>

</div>

<div class="container">

  <?php if ($page->fotoansicht() == 'carousel') : ?>
    <?php snippet('carousel') ?>
  <?php elseif ($page->fotoansicht() == 'gallery') : ?>
    <?php snippet('gallery') ?>
  <?php else : ?>
    <!-- Bilder werden vom Autor manuel gesetzt -->
  <?php endif ?>

</div>

<?php snippet('footer') ?>