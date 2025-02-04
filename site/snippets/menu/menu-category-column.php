<?php
/* Diese Datei erstellt eine Spalte mit Menüpunten, welche innerhalb einer Menü Kategorie 
verwendet werden kann. */
?>
<div class="space-y-6 p-8">
    <h4
        class="text-xs font-semibold tracking-wider text-indigo-600 uppercase dark:text-indigo-400">
        <?= $title ?>
    </h4>
    <nav class="flex flex-col gap-3">
        <?php foreach ($menuItems as $item) {
            snippet('menu/menu-item', $item);
        } ?>
    </nav>
</div>