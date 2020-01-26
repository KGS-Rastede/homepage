<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="container">
  <div class="row">
  <h3><?= $page->heading() ?></h3>
    
  <?= $page->text()->kirbytext() ?>

      <h2>Aktuelles aus dem Fach</h2>

        <?php snippet('blogs', [
          'blogs' => page('blogs')
            ->children()
            ->listed()
            ->filterBy('tags', $page->haupttag(), ',')
        ]) ?>


        <?php if ($page->fotoansicht() == 'carousel') : ?>
          <?php snippet('carousel') ?>
        <?php elseif ($page->fotoansicht() == 'gallery') : ?>
          <?php snippet('gallery') ?>
        <?php else : ?>
          <!-- Bilder werden vom Autor manuel gesetzt -->
        <?php endif ?>  
  </div>
</div>




















<?php snippet('footer') ?>