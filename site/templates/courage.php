<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">

  <?php if ($page->fotoansicht() == 'carousel') : ?>
    <?php snippet('carousel') ?>
  <?php elseif ($page->fotoansicht() == 'gallery') : ?>
    <?php snippet('gallery') ?>
  <?php else : ?>
    <!-- Bilder werden vom Autor manuel gesetzt -->
  <?php endif ?>
  
</div>

<div class="container">

  <h2>Aktuelles von der Schule ohne Rassismus - Schule mit Courage<h2>

  <?php
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Courage', ',')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>

</div>

<?php snippet('footer') ?>