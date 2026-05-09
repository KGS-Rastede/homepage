<!-- FullCalendar 7 CSS (muss manuell eingebunden werden, nicht mehr per JS) -->
<link rel='stylesheet' href='/assets/vendor/css/fullcalendar-skeleton.css'>
<link rel='stylesheet' href='/assets/vendor/css/fullcalendar-classic-palette.css'>
<link rel='stylesheet' href='/assets/vendor/css/fullcalendar-classic-theme.css'>

<!-- FullCalendar 7 JavaScript -->
<script src='/assets/vendor/js/temporal-polyfill.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-all.global.js'></script>
<script src='/assets/vendor/js/fullcalendar-classic-theme.global.js'></script>
<script src='/assets/vendor/js/fullcalendar-de.global.js'></script>

<!-- iCal-Unterstützung -->
<script src='/assets/vendor/js/ical.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-icalendar.global.js'></script>

<?php
include './assets/kalender/kalender-update.php'; // Den Code für das automatische Update laden
$cache_file = './assets/kalender/cache.txt';
$ics_file = './assets/kalender/public.ics';
$update = new kalender_update($cache_file, $ics_file); // neue Klassen mit Cache-Datei- und Kalender-Datei-Ort erzeugen

// Hauptmethode ausführen
// Es wird entweder `true` zurückgegeben, wenn der Kalender breits uptodate wahr oder der Kalender erfolgreich aktualisiert wurde
// ansonsten wird `false` zurückgegebn, es ist also irgendetwas schiefgelaufen
$result = $update->checkForUpdate();


?>
