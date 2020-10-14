<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>





<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 mx-4">
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
              <?= $sf->Beschreibung()->blocks()->excerpt(300) ?>
          </p>
          <p class="text-right">
              <a href="<?= $sf->url() ?>">weiterlesen...</a>
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