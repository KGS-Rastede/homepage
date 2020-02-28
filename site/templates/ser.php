<?php snippet('header') ?>

<?php snippet('page-header') ?>

<h2><?= $page->heading() ?></h2>

<p>
  <?= $page->text()->blocks() ?>
</p>

<div class="row">

  <h2>Aktuelles aus dem Schulelternrat</h2>
  
<?php $index = 0;
 foreach(page('ser/nachrichten')
->children()
->listed()

<?php if ($index  != 0) : ?>

                <?php snippet('teaser-bild', [
                  'subpage' => $subpage
                ]) ?>

                <?php snippet('teaser-bild-text', [
                  'subpage' => $subpage
                ]) ?>

                



              <?php else : ?>
              <?php endif ?>
            <?php endforeach?>


</div>


<div class="container">
  <div class="row">
    
      

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