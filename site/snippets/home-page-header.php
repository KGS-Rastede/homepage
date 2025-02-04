<main role="main">

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


  <div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
    <img src="<?= $bannerpfad ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
    <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl">
      <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu">
      <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Herzlich willkommen</h2>
        <p class="mt-6 text-2xl leading-8 text-gray-300">an der Kooperativen Gesamtschule Rastede</p>
      </div>

      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-6 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-8">
        <a href="https://wiki.kgs-rastede.de/de/eltern">
          <div class="flex gap-x-4 rounded-xl bg-white/70 p-6 ring-1 ring-inset ring-white/10">
            <svg class="h-7 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
              <path d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
            </svg>
            <div class="text-lg leading-7">
              <h3 class="font-semibold text-blue-700">Eltern</h3>
              <p class="mt-2 text-blue-900">Übersichtsseite für Eltern</p>
            </div>
          </div>
        </a>
        <a href="<?= page('allgemeines/kalender')->url() ?>">
          <div class="flex gap-x-4 rounded-xl bg-white/70 p-6 ring-1 ring-inset ring-white/10">

            <svg class="h-7 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
              <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
            </svg>
            <div class="text-lg leading-7">
              <h3 class="font-semibold text-blue-700">Termine</h3>
              <p class="mt-2 text-blue-900">Die Termine der kommenden Wochen</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>




  </div><!-- dieser DIV beended den ersten DIV vom Megamenü -->

  <?php if (!page('wichtige-informationen')->toggle()->bool() === true) :

    //Ein blauer Balken wird gezeigt wenn es keine Banner gibt. Siehe snippets/box-notfall.php 
  ?>
    <div class="p-4 mb-0 bg-light text-primary"></div>
  <?php endif ?>