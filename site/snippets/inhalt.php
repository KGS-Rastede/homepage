<?php

/**
 * Gibt das Inhaltsfeld einer Seite aus: Layouts mit Spalten, in den
 * Spalten die Blöcke. Gegenstück zu site/blueprints/fields/inhalt.yml.
 *
 * Aufruf:
 *   snippet('inhalt')                                  // $page->text()
 *   snippet('inhalt', ['field' => $page->anderes()])   // anderes Feld
 *
 * Alte Seiten mit reinen Blöcken liefert toLayouts() als ein Layout mit
 * einer Spalte. Einspaltige Layouts werden ohne zusätzliches Markup
 * ausgegeben, damit sehen diese Seiten genauso aus wie vorher.
 *
 * Auf kleinen Bildschirmen stehen die Spalten untereinander, ab `md`
 * nebeneinander in einem 12er-Raster.
 */

$field ??= $page->text();

// Tailwind findet nur vollständig ausgeschriebene Klassen
$spans = [
  '1/1' => 'md:col-span-12',
  '1/2' => 'md:col-span-6',
  '1/3' => 'md:col-span-4',
  '2/3' => 'md:col-span-8',
  '1/4' => 'md:col-span-3',
  '3/4' => 'md:col-span-9',
];
?>
<?php foreach ($field->toLayouts() as $layout): ?>
  <?php if ($layout->columns()->count() === 1): ?>
    <?= $layout->columns()->first()->blocks() ?>
  <?php else: ?>
    <section id="<?= esc($layout->id(), 'attr') ?>" class="my-4 grid grid-cols-1 items-start gap-6 md:grid-cols-12">
      <?php foreach ($layout->columns() as $column): ?>
        <div class="min-w-0 <?= $spans[$column->width()] ?? 'md:col-span-12' ?>">
          <?= $column->blocks() ?>
        </div>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>
<?php endforeach; ?>
