<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php if ($file = $page->files()->filterBy('extension', 'svg')->first()) :?>
<?= svg($file)?>
<?php endif ?>

<div class="container">

  <h2>Berichte aus dem Herausforderungsprojekt</h2>

  <?php
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Herausforderungsprojekt', ',')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>

</div>

<?php snippet('footer') ?>