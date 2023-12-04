<?php if ($block->karousel()->isNotEmpty()) : ?>
  <div class="col col-md-6">
    <div class="container carousel-dark">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner text-center">

          <?php $count = -1;
          foreach ($block->karousel()->toFiles() as $image) : $count++ ?>
            <?php if ($count == 0) : ?>
              <div class="carousel-item active">
            <?php else : ?>
              <div class="carousel-item">
            <?php endif ?>

                <a class="d-flex justify-content-center" href="<?= $image->url() ?>">
                  <img class="d-block mw-100 img img-raised rounded" alt="<?= $image->alt() ?>" src="<?= $image->resize(null, 600)->url() ?>">
                </a>

                <div class="d-flex justify-content-center">
                  <div class="carousel-caption col-sm-8">
                    <?= $image->beschreibung() ?>
                  </div>
                </div>

              </div>
          <?php endforeach ?>

        </div>

        <?php if ($block->karousel()->toFiles()->count() >= 2) : ?>
          <a class="d-none d-sm-flex carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only text-dark">Zurück</span>
          </a>
          <a class="d-none d-sm-flex carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="sr-only text-dark">Weiter</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>

          <ol class="carousel-indicators">
            <?php $count = -1;
            foreach ($block->karousel()->toFiles() as $image) : $count++ ?>
              <li data-bs-target="#carouselExampleIndicators" <?php if ($count == 0) : ?> class="active" <?php endif ?> data-bs-slide-to="<?= $count ?>"></li>
            <?php endforeach ?>
          </ol>
        <?php endif ?>


      </div>
    </div>
  </div>
<?php endif ?>