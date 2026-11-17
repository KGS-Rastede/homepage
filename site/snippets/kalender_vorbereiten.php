<?php
// FullCalendar 7 einbinden. Die Termine liefert die Route kalender.json
// (site/plugins/kalender), deshalb braucht es kein iCal-Plugin.
//
// Vendor-Dateien mit Änderungsdatum als Version: Ändert sich eine Datei
// (z. B. durch scripts/copy-vendor.js), ändert sich ihre URL, und Browser
// laden sie neu statt eine alte Fassung aus dem Cache zu nehmen.
$vendor = fn (string $pfad) => '/assets/vendor/' . $pfad . '?v=' . @filemtime(kirby()->root('assets') . '/vendor/' . $pfad);
?>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-skeleton.css') ?>'>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-classic-palette.css') ?>'>
<link rel='stylesheet' href='<?= $vendor('css/fullcalendar-classic-theme.css') ?>'>

<script src='<?= $vendor('js/temporal-polyfill.min.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-all.global.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-classic-theme.global.js') ?>'></script>
<script src='<?= $vendor('js/fullcalendar-de.global.js') ?>'></script>
