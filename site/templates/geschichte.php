<?php snippet('default-page-layout', ['sidebarEnabled' => true], slots: true);
slot();
?>
<?= css('assets/css/geschichte.css') ?>


<p>
  <em>
    Die Historie der KGS Rastede wird stichpunktartig skizziert und fokussiert in chronologischer Reihenfolge
    einzelne ausgewählte Aspekte (die Entstehung der KGS, die schulischen Veränderungen, die baulichen Maßnahmen
    an der Schule sowie Personalveränderungen in der Schulleitung und ausgewählte Ereignisse). Letztlich bildet
    diese Chronologie einen Spiegel der Presse.
  </em>
</p>

<ul class="timeline timeline-centered">
  <?= $page->text()->toBlocks() ?>
</ul>

<?php endslot(); ?>
<?php endsnippet(); ?>
