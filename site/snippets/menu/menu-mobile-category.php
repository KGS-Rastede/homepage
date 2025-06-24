<?php
/* Diese Datei erstellt das Layout einer Kategorie im Menü in der mobilen Ansicht. Dabei wird nicht der 
Inhalt, welcher in der Kategorie angezeigt wird, festgelegt. Dieser wird mit Kirby Slots übergeben.
Siehe: https://getkirby.com/docs/guide/templates/snippets#passing-slots-to-snippets */
?>
<h3 class="col-span-3 text-lg font-semibold"><?= $title ?></h3>
<?= $slots->menuContent() ?>
