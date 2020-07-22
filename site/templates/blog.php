<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="blockqoute">
  <div class="mb-0">
    <!-- ... -->
  </div>

  <div class="mt-3 blockquote-footer h5">
    Datum: <?= $page->date()->toDate("d.m.Y") ?>
    Autor: <?= $page->author() ?>

  </div>
</div>

<?= $page->text()->blocks() ?>

<?php if ($page->fotoansicht() == 'carousel') : ?>
  <?php snippet('carousel') ?>
<?php elseif($page->fotoansicht() == 'gallery') : ?> 
  <?php snippet('gallery') ?>
<?php else: ?> 
<!-- Bilder werden vom Autor manuel gesetzt -->
<?php endif ?>


<?php snippet('footer') ?>