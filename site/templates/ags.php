<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container mb-4 mt-4">
  <h3 class="mb-3">Arbeitsgemeinschaften im Schuljahr <?= Escape::html($page->termYear()) ?></h3>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    <?php foreach ($page->children() as $arbeitsgemeinschaft): ?>
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><?= Escape::html($arbeitsgemeinschaft->title()) ?></h4>
        </div>
        <?php if ($image = $arbeitsgemeinschaft->image()): ?>
        <a href="<?= $arbeitsgemeinschaft->url() ?>" class="stretched-link"><?= $image->crop(650, 488, 'center')->html(['class' => 'card-img-top']) ?></a>
        <?php else: ?>
        <div class="card-body"><a href="<?= $arbeitsgemeinschaft->url() ?>" class="card-link stretched-link">mehr…</a></div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="container mb-4 mt-5"><?= $page->more_text()->toBlocks() ?></div>

<div class="container mb-4 mt-4">

  <h3 class="mb-3">Berichte aus den Arbeitsgemeinschaften</h3>

  <?php
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'AGs', ',')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>

</div>

<?php snippet('footer') ?>