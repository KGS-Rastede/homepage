<!-- 
Es folgen einige CSS-Klassen um sicherzustellen, dass diese nicht aus dem CSS gepurged werden
bs-callout-primary bs-callout-secondary bs-callout-info bs-callout-warning bs-callout-danger bs-callout-light bs-callout-dark
-->

<div class="bs-callout bs-callout-<?= $block->farbe() ?> bg-white">
  <h4><?= $block->ueberschrift() ?></h4>
  <?= $block->feldinhalt()->kt() ?>
</div>