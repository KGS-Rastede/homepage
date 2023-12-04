<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
  <div class="rows">
    <div class="row row-cols-sm-1 row-cols-lg-2">
      <div class="col">
        <?= markdown($page->content->description()) ?>
      </div>
      <?php if($image = $page->image()): ?>
      <div class="col">
        <?= $image->thumb(['width' => 600])->html(['class' => 'img-fluid']) ?>
      </div>
      <?php endif; ?>
    </div>
    <div class="row">
      <dl>
        <dt>AG-Leitung:</dt>
        <dd>
          <?= Escape::html(implode(', ', $page->content->teachers()->toArray()['teachers'])) ?>
        </dd>
        <dt>Jahrgänge:</dt>
        <dd>
          <?= Escape::html(implode(', ', $page->content->grades()->toArray()['grades'])) ?>
        </dd>
        <dt>Termin:</dt>
        <dd><?= $page->content->date() ?></dd>
        <dt>Raum:</dt>
        <dd><?= Escape::html($page->content->room()) ?></dd>
      </dl>
    </div>
    <div class="row">
      <a href="<?= $page->parent()->url() ?>">Zurück zur Übersicht aller Arbeitsgemeinschaften</a>
    </div>
  </div>
</div>

<?php snippet('footer') ?>
