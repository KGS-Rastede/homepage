<?php snippet('header') ?>


<h1><?= $page->title()->kirbytext() ?></h1>
<h2><?= $page->heading()->kirbytext() ?></h2>


<?= $page->text()->kirbytext() ?>

<h3>Tags</h3>

<ul>
  <?php foreach ($page->tags()->split() as $category): ?>
  <li><?= $category ?></li>
  <?php endforeach ?>
</ul>
    
<?php snippet('footer') ?>