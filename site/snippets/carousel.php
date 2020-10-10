<div class="container carousel-dark">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

      <?php $count = -1;
      foreach ($page->gallery()->toFiles() as $image) : $count++ ?>
        <li data-target="#carouselExampleIndicators" <?php if ($count == 0) : ?> class="active" <?php endif ?> data-slide-to="<?= $count ?>"></li>
      <?php endforeach ?>

    </ol>
    <div class="carousel-inner text-center">


      <?php $count = -1;
      foreach ($page->gallery()->toFiles() as $image) : $count++ ?>
        <?php if ($count == 0) : ?>
          <div class="carousel-item active">
          <?php else : ?>
            <div class="carousel-item text-center">
            <?php endif ?>

            <a class="d-flex justify-content-center" href="<?= $image->url() ?>">
              <?= $image->resize(null, 600) ?>
            </a>

            <div class="carousel-caption">
              <h3><?= $image->beschreibung() ?></h3>
            </div>
            </div>
          <?php endforeach ?>
          </div>
          <a class="d-none d-sm-flex carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only text-dark">Zurück</span>
          </a>
          <a class="d-none d-sm-flex carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only text-dark">Weiter</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
    </div>
  </div>
</div>

