<?php snippet('header') ?>


<h1><?= $page->title()->kirbytext() ?></h1>
<h2><?= $page->heading()->kirbytext() ?></h2>


<?= $page->text()->kirbytext() ?>

<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

      <?php $count = -1;
      foreach ($page->images() as $image) : $count++ ?>
        <li data-target="#carouselExampleIndicators" <?php if ($count == 0) : ?> class="active" <?php endif ?> data-slide-to="<?= $count ?>"></li>
      <?php endforeach ?>

    </ol>
    <div class="carousel-inner">

      <?php $count = -1;
      foreach ($page->images() as $image) : $count++ ?>
        <?php if ($count == 0) : ?>
          <div class="carousel-item active">
          <?php else : ?>
            <div class="carousel-item">
            <?php endif ?>
            <img src=<?= $image->url() ?> class="d-block w-100" alt="<?= $image->caption() ?>"" />
            </div>
          <?php endforeach ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
    </div>
  </div>

  <h3>Tags</h3>

  <ul>
    <?php foreach ($page->tags()->split() as $category) : ?>
      <li><?= $category ?></li>
    <?php endforeach ?>
  </ul>

  <?php snippet('footer') ?>