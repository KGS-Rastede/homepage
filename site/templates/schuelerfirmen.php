<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h1>Unsere Schülerfirmen</h1>


<div class="card-columns">
  <div class="card">
    <div class="card-header card-header-danger">
      <h4 class="card-title">Colorful Office</h4>
    </div>
    <div class="card-body">

    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">Fruchtinsel</h4>
    </div>
    <div class="card-body">

    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-success">
      <h4 class="card-title">Das Sofa-Team</h4>
    </div>
    <div class="card-body">

    </div>
  </div>
 
  <div class="card">
    <div class="card-header card-header-info">
      <h4 class="card-title">Die kleinen Imker</h4>
    </div>
    <div class="card-body">

    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-warning">
      <h4 class="card-title">Holz und Mehr</h4>
    </div>
    <div class="card-body">

    </div>
  </div>
</div>


<?php snippet('blogs', [
  'blogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Schülerfirmen', ',')
]) ?>

<?php snippet('footer') ?>