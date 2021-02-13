<?php snippet('header') ?>
<?php snippet('page-header') ?>

<link rel="stylesheet" href="<?= url('assets/css/pages/schule/geschichte/geschichte_shrinked.min.css')?>">

<div class="container">
    <p><em>Die Historie der KGS Rastede wird stichpunktartig skizziert und fokussiert in chronologischer Reihenfolge einzelne ausgewählte Aspekte (die Entstehung der KGS, die schulischen Veränderungen, die baulichen Maßnahmen an der Schule sowie Personalveränderungen in der Schulleitung und ausgewählte Ereignisse). Letztlich bildet diese Chronologie einen Spiegel der Presse.</em></p>

    <div class="row example-centered">
        <ul class="timeline timeline-centered">
            <?= $page->text()->toBlocks() ?>
        </ul>
    </div>
</div>

<?php snippet('footer') ?>