<?php snippet('header') ?>

<?php snippet('page-header') ?>

<section class="content article">
  <article>
    <?= $page->intro()->kirbytext() ?>
    <?= $page->text()->blocks() ?>

    <a href="<?= url('devblog') ?>">Zurück zur Übersicht...</a>

  </article>
</section>

<?php snippet('footer') ?>