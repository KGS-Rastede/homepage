<?php snippet('header') ?>

<?php snippet('page-header') ?>

<h2><?= $page->heading() ?></h2>

<p>
  <?= $page->text()->blocks() ?>
</p>

<div class="row">

  <h2>Aktuelles aus der SV</h2>

  <div class="container">
    <div class="row">



      <?php snippet('blogs', [
        'blogs' => page('sv/blogs')
          ->children()
          ->listed()
      ]) ?>

    </div>
  </div>
</div>

<?php snippet('footer') ?>