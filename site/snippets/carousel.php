<div class="container carousel-dark">
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">

      <?php $count = -1;
      foreach ($page->images() as $image) : $count++ ?>
        <li data-target="#carouselExampleIndicators" <?php if ($count == 0) : ?> class="active" <?php endif ?> data-slide-to="<?= $count ?>"></li>
      <?php endforeach ?>

    </ol>
    <div class="carousel-inner text-center">


      <?php $count = -1;
      foreach ($page->images() as $image) : $count++ ?>
        <?php if ($count == 0) : ?>
          <div class="carousel-item active">
          <?php else : ?>
            <div class="carousel-item text-center">
            <?php endif ?>
            <!-- Bei Bildschirm Größe md und aufwärts wird <div> gezeigt. Bei kleiner das andere -->
            <div class= "d-none d-md-block">
              <img height="600" max-width="100" class="" src="<?= $image->url() ?>">
            </div>
            <img class="d-block d-md-none w-100" src="<?= $image->url() ?>">

            <div class="carousel-caption">
              <h3><?= $image->bildunterschrift() ?></h3>
            </div>
            </div>
          <?php endforeach ?>
          </div>
          <a class=" carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only text-dark">Zurück</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only text-dark">Weiter</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
    </div>
  </div>
</div>

