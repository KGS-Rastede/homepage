<?php

use Kirby\Toolkit\Escape;

snippet('default-page-layout', slots: true);
slot();
?>

<div class="grid grid-cols-1 md:grid-cols-2">
  <div>
    <?= markdown($page->content()->description()) ?>
  </div>
  <?php if ($image = $page->image()): ?>
    <div>
      <?= $image->thumb(['width' => 600])->html([
        'class' => '"aspect-[3/2] w-full rounded-2xl object-cover"',
      ]) ?>
    </div>
  <?php endif; ?>
</div>
<div>
  <dl>
    <dt>AG-Leitung:</dt>
    <dd>
      <?= Escape::html(
        implode(', ', $page->content()->teachers()->toArray()['teachers']),
      ) ?>
    </dd>
    <dt>Jahrgänge:</dt>
    <dd>
      <?= Escape::html(
        implode(', ', $page->content()->grades()->toArray()['grades']),
      ) ?>
    </dd>
    <dt>Termin:</dt>
    <dd>
      <?= $page->content()->date() ?>
    </dd>
    <dt>Raum:</dt>
    <dd>
      <?= Escape::html($page->content()->room()) ?>
    </dd>
  </dl>
</div>
<div class="text-right mt-2 mb-2">
  <?php snippet('knopf-klein', [
    'subpage' => $page->parent(),
    'knopftext' => 'Zurück zur Übersicht aller Arbeitsgemeinschaften',
  ]); ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
