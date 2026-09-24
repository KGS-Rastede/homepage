<?php
/* Diese Datei erstellt eine Spalte mit Menüpunkten, welche innerhalb einer Menü Kategorie 
verwendet werden kann. */
?>
<div class="space-y-6 p-8">
    <?php if (!empty($title)): ?>
    <h4
        class="font-semibold tracking-wider text-kgs-blue uppercase dark:text-kgs-lblue">
        <?= $title ?>
    </h4>
    <?php endif ?>
    <nav class="flex flex-col gap-3">
        <?php foreach ($menuItems as $item) {
          snippet('menu/menu-item', $item);
        } ?>
    </nav>
</div>