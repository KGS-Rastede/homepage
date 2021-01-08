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
        <div class="d-flex d-sm-block">
        <p class="banner-btn me-3">
          <a class="banner-btn-item" href="<?= page('allgemeines/kalender')->url() ?>">Termine
            <i class="bi bi-arrow-right-circle"></i>
          </a>
        </p>
        <p class="banner-btn">
          <a class="banner-btn-item" href="<?= page('blogs')->url() ?>">Aktuelles
            <i class="bi bi-arrow-right-circle"></i>
          </a>
        </p>
        </div>
      </span>
    </div>
  </section>

  <?php if (!page('wichtige_informationen/notfall')->toggle()->bool() === true) : 
    //Ein blauer Balken wird gezeigt wenn es keine Banner gibt. Siehe snippets/box-notfall.php ?>
    <div class="p-4 mb-0 bg-light text-primary"></div>
  <?php endif ?>