<?php snippet('header') ?>

<?= $page->text()->kirbytext() ?>

<h3>Tags</h3>

<ul>
  <?php foreach ($page->tags()->split() as $category): ?>
  <li><?= $category ?></li>
  <?php endforeach ?>
</ul>
    
<?php snippet('footer') ?>