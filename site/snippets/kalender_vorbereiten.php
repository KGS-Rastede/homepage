<!-- FullCalendar 6 JavaScript (CSS is included in JS files in v6) -->
<script src='/assets/vendor/js/fullcalendar-core.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-daygrid.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-timegrid.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-list.min.js'></script>

<!-- iCal support -->
<script src='/assets/vendor/js/ical.min.js'></script>
<script src='/assets/vendor/js/fullcalendar-icalendar.min.js'></script>

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
