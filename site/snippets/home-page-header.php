<main role="main">

  <!-- The CSS grid area that displays the image (layer 1) -->

  <?php
  // Code nach https://www.php.net/manual/en/function.date-sun-info.php

  // Die Bilder sind in /content/design/ gespeichert
  $page = page('design');

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

  <div
    class="bg-cover bg-bottom"
    style="
    background-image: url(<?= $bannerpfad ?>);
  ">
    <!-- TODO 
   HIER MÜSSEN ANDERE FARBEN FÜR DEN GRADIENTEN GEWÄHLT WERDEN
    -->
    <div class="bg-gray-900/80 bg-gradient-to-b from-orange-500/90 to-yellow-300/30">
      <div
        class="container mx-auto space-y-8 px-4 py-16 sm:space-y-16 lg:px-8 lg:py-32 xl:max-w-7xl">



        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Herzlich willkommen</h1>
        <h2 class="text-2xl text-gray-300">an der Kooperativen Gesamtschule Rastede</h2>
      </div>

    </div>
  </div>