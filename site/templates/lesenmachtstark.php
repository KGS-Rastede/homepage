<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>


<div class="container">

  <h2>Berichte vom Projekt "Lesen macht stark"</h2>

  <?php
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Lesen macht stark', ',')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>

</div>

<?php snippet('footer') ?>