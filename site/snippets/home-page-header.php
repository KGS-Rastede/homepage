<main role="main">

  <!-- The CSS grid that makes up the entirety of the hero image/banner image area -->
  <section class="top-banner-section">
    <!-- The CSS grid area that displays the image (layer 1) -->
    <div class="banner-image-div">
      <img class="banner-image" src="<?= $kirby->url('assets') ?>/img/IMG_1343.jpeg" alt="Banner Image" />
    </div>
    <!-- The CSS grid area that displays the semi-transparent gradient overlay (layer 2) -->
    <div class="banner-overlay-div"></div>
    <!-- The CSS grid area that displays the content (layer 3) -->
    <div class="banner-text-div">
      <span class="banner-text">
        <p class="banner-body-text">Herzlich willkommen an der</p>
        <p class="banner-h1-text">Kooperativen Gesamtschule Rastede</p>
        <p class="banner-btn">
          <a class="banner-btn-item" href="<?= page('allgemeines/kalender')->url() ?>">Termine
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" />
            </svg>
          </a>
        </p>
        <p class="banner-btn">
          <a class="banner-btn-item" href="<?= page('blogs')->url() ?>">Aktuelles
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" />
            </svg>
          </a>
        </p>
      </span>
    </div>
  </section>


  <!-- Titelfeld -->
  <div class="p-3 mb-2 bg-light text-primary">
    <h1>
      <!-- <?= $page->title() ?> -->
    </h1>
  </div>
  <small class="text-muted"><?= $page->subtitle() ?></small>

  <h1 class="display-6 mb-3">
    <?= $page->heading() ?>
  </h1>