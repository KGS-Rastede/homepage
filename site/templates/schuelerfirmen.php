<?php snippet('header') ?>

<?php snippet('page-header') ?>



<?php foreach ($page->children() as $sf) : ?>

  <div class="card card-background" style="background-image: url('https://images.unsplash.com/photo-1471666875520-c75081f42081?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2038&q=80')">
    <div class="card-body">
      <h6 class="card-category text-info"><?= $sf->Heading() ?></h6>
      <a href="#pablo">
        <h3 class="card-title"><?= $sf->Title() ?></h3>
      </a>
      <p class="font-weight-bold card-description">
        <?= $sf->Beschreibung() ?>
      </p>
      <a href="mailto:eik@kgs-rastede.de" class="btn btn-white btn-link">
        <i class="material-icons">email</i><?= $sf->mail() ?>
      </a>
    </div>
  </div>

<?php endforeach ?>




<?php snippet('blogs', [
  'blogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Schülerfirmen', ',')
]) ?>

<?php snippet('footer') ?>