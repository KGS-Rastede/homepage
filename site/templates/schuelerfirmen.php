<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>





<div class="row row-cols-1 row-cols-md-2">
  <?php foreach ($page->children() as $sf) : ?>
    <div class="col mb-4">
      <div class="card">
        <?php if ($image = $sf->bild()->toFile()) : ?>
            <img src="<?= $image->url() ?>" class="card-img-top" alt="...">
        <?php endif ?>
        
          
        <div class="card-body">
          <h3 class="card-title"><?= $sf->Title() ?></h3>
          <p class="card-text"><?= $sf->Heading() ?></p>
          <p class="card-text">
              <?= $sf->Beschreibung() ?>
          </p>
        </div>      
      </div>
    </div>
  
  <?php endforeach ?>
</div>

<div class="container ml-auto mr-auto">

  <h2>Aktuelles aus den Schülerfirmen</h2>

  <?php snippet('blogs', [
    'blogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Schülerfirmen', ',')
  ]) ?>

</div>

<?php snippet('footer') ?>