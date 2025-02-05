<link rel="stylesheet" href="../../node_modules/fullcalendar/main.min.css" />
<script src='../../node_modules/fullcalendar/main.min.js'></script>

<script src='../../node_modules/ical.js/build/ical.min.js'></script>
<script src='../../node_modules/@fullcalendar/icalendar/main.global.min.js'></script>

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
