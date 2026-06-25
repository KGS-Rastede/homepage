<?php
$calendarAsset = function (string $path) use ($kirby): string {
    $root = $kirby->root('index') . '/' . $path;
    $url = '/' . $path;

    return file_exists($root) ? $url . '?v=' . filemtime($root) : $url;
};
?>

<!-- FullCalendar 7 CSS -->
<link rel="stylesheet" href="<?= $calendarAsset('assets/vendor/css/fullcalendar-skeleton.css') ?>">
<link rel="stylesheet" href="<?= $calendarAsset('assets/vendor/css/fullcalendar-classic-palette.css') ?>">
<link rel="stylesheet" href="<?= $calendarAsset('assets/vendor/css/fullcalendar-classic-theme.css') ?>">
<link rel="stylesheet" href="<?= $calendarAsset('assets/css/kalender.css') ?>">

<!-- FullCalendar 7 JavaScript -->
<script src="<?= $calendarAsset('assets/vendor/js/temporal-polyfill.min.js') ?>"></script>
<script src="<?= $calendarAsset('assets/vendor/js/fullcalendar-all.global.js') ?>"></script>
<script src="<?= $calendarAsset('assets/vendor/js/fullcalendar-classic-theme.global.js') ?>"></script>
<script src="<?= $calendarAsset('assets/vendor/js/fullcalendar-de.global.js') ?>"></script>

<!-- iCal support -->
<script src="<?= $calendarAsset('assets/vendor/js/ical.min.js') ?>"></script>
<script src="<?= $calendarAsset('assets/vendor/js/fullcalendar-icalendar.global.js') ?>"></script>
<script src="<?= $calendarAsset('assets/js/kalender.js') ?>"></script>

<?php
require_once $kirby->root('index') . '/assets/kalender/kalender-update.php';

$cache_file = $kirby->root('index') . '/assets/kalender/cache.txt';
$ics_file = $kirby->root('index') . '/assets/kalender/public.ics';
$update = new kalender_update($cache_file, $ics_file);
$result = $update->checkForUpdate();
?>

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
      <a class="kgs-calendar-modal-link" data-calendar-modal-link hidden>Termin öffnen</a>
    </div>
  </section>
</div>
