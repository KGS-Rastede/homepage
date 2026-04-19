<?php
$buttons = page('wichtige-informationen')->buttons()->toStructure();
?>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mx-2 sm:mx-6 lg:mx-12 my-6">
    <?php foreach ($buttons as $btn): ?>
        <?php
        if ($btn->active()->toBool() === false) continue;

        // 1) Bevorzugt: interne Seite
        $subpage = $btn->page()->toPage(); // null, wenn nicht gesetzt

        // Button-Text
        $text = $btn->text()->or('Weiter')->value();
        ?>

        <?= snippet('knopf-gross', [
            'subpage'   => $subpage,    // Page|null
            'knopftext' => $text       // string
        ]) ?>

    <?php endforeach; ?>
</div>