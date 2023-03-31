<main role="main">

  <!-- The CSS grid that makes up the entirety of the hero image/banner image area -->
  <section class="top-banner-section">
    <!-- The CSS grid area that displays the image (layer 1) -->

    <?php
    // Code nach https://www.php.net/manual/en/function.date-sun-info.php

    // Die Bilder sind in /content/design/ gespeichert
    $page = page("design");

    // Dieser Pfad speichert die URL des Hintergrundbildes
    $bannerpfad = $page->bildregen()->toFile()->url();


    // Setze die Zeitzone auf Berlin
    date_default_timezone_set('Europe/Berlin');

    // Setze deine Breiten- und Längengrade hier
    $lat = 53.25; // Rastede
    $long = 8.215;

    // Hole die Sonneninformationen für heute
    $sun_info = date_sun_info(time(), $lat, $long);
    
    // Hole die aktuelle Zeit als Timestamp
    $now = time();
    
    // Bestimme das Bild basierend auf der Zeit
    if ($now >= $sun_info['sunrise'] && $now < $sun_info['transit']) {
      // Von Sonnenaufgang bis Zenit
      $bannerpfad = $page->bildmorgens()->toFile()->url();
    } elseif ($now >= $sun_info['transit'] && $now < $sun_info['sunset']) {
      // Von Zenit bis Sonnenuntergang
      $bannerpfad = $page->bildtag()->toFile()->url();
    } else {
      // Von Sonnenuntergang bis Sonnenaufgang des Folgetages
      $bannerpfad = $page->bildnacht()->toFile()->url();
    }
    
    ?>

    <div class="banner-image-div">
      <img class="banner-image" src="<?= $bannerpfad ?>" alt="Banner Image" />
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

  <?php if (!page('wichtige_informationen/')->toggle()->bool() === true) : 

    //Ein blauer Balken wird gezeigt wenn es keine Banner gibt. Siehe snippets/box-notfall.php ?>
    <div class="p-4 mb-0 bg-light text-primary"></div>
  <?php endif ?>