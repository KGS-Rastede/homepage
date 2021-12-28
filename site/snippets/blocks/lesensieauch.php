<!-- 
Es folgen einige CSS-Klassen um sicherzustellen, dass diese nicht aus dem CSS gepurged werden
bs-callout-primary bs-callout-secondary bs-callout-info bs-callout-warning bs-callout-danger bs-callout-light bs-callout-dark
-->



<?php if ($block->lesensieauch()->isNotEmpty()) : ?>
  <div class="bs-callout bs-callout-<?= $block->farbe() ?> bg-white">
    <h4>
      <?= $block->lesensieauchtitel()->or("Lesen Sie auch...") ?>
    </h4>
    <?php $linkziele =  $block->lesensieauch()->toPages();
    foreach ($linkziele as $linkziel) : ?>
      <li class="list-group-item list-group-item-action">
        <a href="<?= $linkziel->url() ?>" class="text-decoration-none"><?= $linkziel->title() ?></a>
      </li>
    <?php endforeach ?>
  </div>
<?php endif ?>