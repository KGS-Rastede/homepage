<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>


<div class="container">
<?php
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'SV', ',')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>
</div>


<?php snippet('footer') ?>