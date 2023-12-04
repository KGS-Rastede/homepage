<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://kgs-rastede.de/media/pages/blogs/festakt-zum-20jaehrigen-jubilaeum-schule-ohne-rassismus-schule-mit-courage/f4f5b72cf2-1655105183/festakt6.jpg" class="d-block w-50" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5> Moin moin
        </h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <?php foreach ($page->text()->toBlocks() as $block) : ?>

      <div class="carousel-item ">
      <?php echo $block->grabsteinbild()->toFile() ?>
        <div class="carousel-caption d-none d-md-block">
          <h5> <?php echo $block->beschriftung() ?>
          </h5>
          <p>

          <?php echo $block->grabsteinbild()->toFile() ?>

            GebDatum <?php echo $block->gebdatum() ?> TodesDatum  <?php echo $block->todesdatum() ?>

          </p>
        </div>
      </div>

    <?php endforeach ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php snippet('footer') ?>