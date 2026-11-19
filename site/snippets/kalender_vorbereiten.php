<?php
// FullCalendar 7 einbinden. Die Termine liefert die Route kalender.json
// (site/plugins/kalender), deshalb braucht es kein iCal-Plugin.
//
// Vendor-Dateien mit Änderungsdatum als Version: Ändert sich eine Datei
// (z. B. durch scripts/copy-vendor.js), ändert sich ihre URL, und Browser
// laden sie neu statt eine alte Fassung aus dem Cache zu nehmen.
$vendor = fn (string $pfad) => '/assets/vendor/' . $pfad . '?v=' . @filemtime(kirby()->root('assets') . '/vendor/' . $pfad);
$eigen  = fn (string $pfad) => '/assets/' . $pfad . '?v=' . @filemtime(kirby()->root('assets') . '/' . $pfad);
?>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-skeleton.css') ?>'>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-classic-palette.css') ?>'>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-classic-theme.css') ?>'>

<script src='<?= $vendor('js/temporal-polyfill.min.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-all.global.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-classic-theme.global.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-de.global.js') ?>'></script>

<!-- Detailfenster nach Klick auf einen Termin -->
<link rel='stylesheet' href='<?= $eigen('css/kalender.css') ?>'>
<script src='<?= $eigen('js/kalender.js') ?>'></script>

<div id="kgs-calendar-modal" class="kgs-calendar-modal" hidden aria-hidden="true">
  <div class="kgs-calendar-modal-backdrop" data-calendar-modal-backdrop></div>
  <section class="kgs-calendar-modal-panel" role="dialog" aria-modal="true" aria-labelledby="kgs-calendar-modal-title">
    <header class="kgs-calendar-modal-header">
      <div>
        <p class="kgs-calendar-modal-kicker" data-calendar-modal-time></p>
        <h2 id="kgs-calendar-modal-title" class="kgs-calendar-modal-title" data-calendar-modal-title></h2>
      </div>
      <button type="button" class="kgs-calendar-modal-close" data-calendar-modal-close aria-label="Termindetails schließen">
        <i class="bi bi-x-lg" aria-hidden="true"></i>
      </button>
    </header>
    <div class="kgs-calendar-modal-body">
      <div class="kgs-calendar-detail-row">
        <span class="kgs-calendar-detail-label">Datum</span>
        <span class="kgs-calendar-detail-value" data-calendar-modal-date></span>
      </div>
      <div class="kgs-calendar-detail-row" data-calendar-modal-location-row hidden>
        <span class="kgs-calendar-detail-label">Ort</span>
        <span class="kgs-calendar-detail-value" data-calendar-modal-location></span>
      </div>
      <div class="kgs-calendar-detail-row" data-calendar-modal-description-row hidden>
        <span class="kgs-calendar-detail-label">Details</span>
        <span class="kgs-calendar-detail-value" data-calendar-modal-description></span>
      </div>
      <a class="kgs-calendar-modal-link" data-calendar-modal-link target="_blank" rel="noopener" hidden>Termin öffnen</a>
    </div>
  </section>
</div>
