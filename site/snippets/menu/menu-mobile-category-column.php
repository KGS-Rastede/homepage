<?php
/* Diese Datei erstellt eine Spalte mit Menüpunten für die mobile Ansicht, welche innerhalb
einer Menü Kategorie verwendet werden kann. */
?>
<div class="space-y-2">
    <h4
        class="text-sm font-semibold tracking-wider text-kgs-blue uppercase dark:text-kgs-lblue">
        <?= $title ?>
    </h4>
    <nav class="flex flex-col gap-3">
        <?php foreach ($menuItems as $item) {
          snippet('menu/menu-item', $item);
        } ?>
    </nav>
</div>