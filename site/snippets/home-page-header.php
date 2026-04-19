<main>

  <!-- The CSS grid area that displays the image (layer 1) -->

  <?php
  // Code nach https://www.php.net/manual/en/function.date-sun-info.php

  // Bilder werden in den Site-Einstellungen im Panel konfiguriert
  $page = site();

  // Fallback-Bild, falls ein Tageszeit-Bild nicht gesetzt ist
  $fallback = $page->bildregen()->toFile()?->url();

  // Zeitzone und Koordinaten für die Sonnenstandsberechnung
  date_default_timezone_set('Europe/Berlin');
  $lat = 53.25; // Rastede
  $long = 8.215;

  // Sonnenaufgang, Zenit und Sonnenuntergang für heute berechnen
  // Dokumentation: https://www.php.net/manual/en/function.date-sun-info.php
  $sun_info = date_sun_info(time(), $lat, $long);
  $now = time();

  // Bild je nach Tageszeit wählen; ?? $fallback greift, wenn das Feld leer ist
  if ($now >= $sun_info['sunrise'] && $now < $sun_info['transit']) {
    // Sonnenaufgang bis Zenit
    $bannerpfad = $page->bildmorgens()->toFile()?->url() ?? $fallback;
  } elseif ($now >= $sun_info['transit'] && $now < $sun_info['sunset']) {
    // Zenit bis Sonnenuntergang
    $bannerpfad = $page->bildtag()->toFile()?->url() ?? $fallback;
  } else {
    // Sonnenuntergang bis Sonnenaufgang des Folgetages
    $bannerpfad = $page->bildnacht()->toFile()?->url() ?? $fallback;
  }
  ?>

  <div
    class="relative bg-cover bg-center min-h-65 sm:min-h-90"
    style="background-image: url(<?= $bannerpfad ?>);">
    <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/30 to-transparent"></div>
    <div class="relative container mx-auto px-4 py-16 sm:py-24 lg:px-8 xl:max-w-7xl">
      <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl drop-shadow-lg">Herzlich willkommen</h1>
      <h2 class="mt-2 text-2xl text-slate-200 drop-shadow">an der Kooperativen Gesamtschule Rastede</h2>
    </div>
  </div>