<?php snippet('default-page-layout', slots: true);
slot();
?>

<p class="text-slate-700 italic mb-4 max-w-3xl mx-auto">
  Die Historie der KGS Rastede wird stichpunktartig skizziert und fokussiert in chronologischer Reihenfolge
  einzelne ausgewählte Aspekte (die Entstehung der KGS, die schulischen Veränderungen, die baulichen Maßnahmen
  an der Schule sowie Personalveränderungen in der Schulleitung und ausgewählte Ereignisse). Letztlich bildet
  diese Chronologie einen Spiegel der Presse.
</p>

<div class="relative mt-8 mb-4">
  <!-- Durchgehende Timeline-Linie -->
  <div
    class="absolute top-0 bottom-0 left-6 w-px -translate-x-1/2 bg-indigo-200 dark:bg-indigo-900 lg:left-1/2"
    aria-hidden="true"
  ></div>

  <?= $page->text()->toBlocks() ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
