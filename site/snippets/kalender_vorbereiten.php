<!-- FullCalendar 6.1.19 JavaScript (CSS is included in JS files in v6) -->
<script src='../../node_modules/@fullcalendar/core/index.global.min.js'></script>
<script src='../../node_modules/@fullcalendar/daygrid/index.global.min.js'></script>
<script src='../../node_modules/@fullcalendar/timegrid/index.global.min.js'></script>
<script src='../../node_modules/@fullcalendar/list/index.global.min.js'></script>

<!-- iCal support -->
<script src='../../node_modules/ical.js/build/ical.min.js'></script>
<script src='../../node_modules/@fullcalendar/icalendar/index.global.min.js'></script>

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
