<!--
  Zeitraum-Abschnitt: kleiner Knoten (Jahreszahl) gefolgt von den Ereignissen
  site/blueprints/blocks/geschichtszeitraum.php
 -->
<?php
$ereignis = static function ($field): ?string {
  $html =
    preg_replace('/<p>\s*<\/p>/i', '', $field->value()) ?? $field->value();

  if (trim(strip_tags($html)) === '') {
    return null;
  }

  return $html;
};

$events = [
  ['feld' => 'ereignis1', 'seite' => 'links'],
  ['feld' => 'ereignis2', 'seite' => 'rechts'],
  ['feld' => 'ereignis3', 'seite' => 'links'],
  ['feld' => 'ereignis4', 'seite' => 'rechts'],
  ['feld' => 'ereignis5', 'seite' => 'links'],
  ['feld' => 'ereignis6', 'seite' => 'rechts'],
  ['feld' => 'ereignis7', 'seite' => 'links'],
  ['feld' => 'ereignis8', 'seite' => 'rechts'],
  ['feld' => 'ereignis9', 'seite' => 'links'],
  ['feld' => 'ereignis10', 'seite' => 'rechts'],
];
?>
<div class="relative">
  <?php if ($block->zeitraum()->isNotEmpty()): ?>
    <div class="py-5 pl-8 lg:flex lg:justify-center lg:py-8 lg:pl-0 lg:text-center">
      <span
        class="inline-block rounded-full border border-indigo-200 bg-white px-5 py-1.5 text-sm font-bold uppercase tracking-wider text-slate-900 shadow-sm dark:border-indigo-800 dark:bg-slate-900 dark:text-slate-100"
      >
        <?= $block->zeitraum() ?>
      </span>
    </div>
  <?php endif; ?>

  <ul class="relative space-y-6 lg:space-y-8">
    <?php foreach ($events as $event): ?>
      <?php $text = $ereignis($block->{$event['feld']}()); ?>
      <?php if ($text !== null): ?>
        <?= snippet('geschichtsereignis-' . $event['seite'], [
          'ereignistext' => $text,
        ]) ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>