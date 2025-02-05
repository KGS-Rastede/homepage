<?php snippet('header'); ?>
<?php snippet('page-header'); ?>

<?php snippet('sidebar'); ?>

<div class="container">

  <h2>Berichte aus Wettbewerben</h2>

  <?php foreach (
    page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Wettbewerb', ',')
      ->flip()
    as $subpage
  ):
    snippet('blogkarte', ['subpage' => $subpage]); ?>

  <?php
  endforeach; ?>

</div>

<?php snippet('footertw'); ?>
