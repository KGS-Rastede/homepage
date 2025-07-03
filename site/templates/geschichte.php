<?php snippet('default-page-layout', slots: true);
slot();
?>
<?= css('assets/css/geschichte.css') ?>


<p class="text-gray-700 italic mb-4 max-w-3xl mx-auto">
  Die Historie der KGS Rastede wird stichpunktartig skizziert und fokussiert in chronologischer Reihenfolge
  einzelne ausgewählte Aspekte (die Entstehung der KGS, die schulischen Veränderungen, die baulichen Maßnahmen
  an der Schule sowie Personalveränderungen in der Schulleitung und ausgewählte Ereignisse). Letztlich bildet
  diese Chronologie einen Spiegel der Presse.
</p>

<ul class="timeline timeline-centered">
  <?= $page->text()->toBlocks() ?>
</ul>


<?php endslot(); ?>
<?php endsnippet(); ?>
