<?php
$buttons = page('wichtige-informationen')->buttons()->toStructure();
?>

<div class="flex flex-col justify-center gap-1 md:flex-row md:gap-4 mx-2 sm:mx-6 lg:mx-12 my-6">
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