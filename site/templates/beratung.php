<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="card-columns">
  <div class="card p-3 text-center text-white bg-primary">
    <div class="card-body">
      <h5 class="card-title">Beratungsteam</h5>
    </div>
  </div>

  <div class="card mb-3 text-center text-white bg-primary">
    <div class="card-body">
      <h5 class="card-title">Coaching 9+10</h5>
    </div>
  </div>

  <div class="card p-2 text-center text-white bg-primary">
    <div class="card-body">
      <h5 class="card-title">Mediation</h5>
    </div>
  </div>

  <div class="card p-3 text-center text-white bg-primary">
    <div class="card-body">
      <h5 class="card-title">Schülervertretung</h5>
    </div>
  </div>

  <div class="card p-3 text-center text-white bg-primary">
    <div class="card-body">
      <h5 class="card-title">Laufbahnberatung</h5>
    </div>
  </div>

  <div class="card p-3 text-center text-white bg-danger">
    <div class="card-body">
      <h5 class="card-title">Berufsberatung</h5>
    </div>
  </div>

  <div class="card p-3 text-center text-white bg-success">
    <div class="card-body">
      <h5 class="card-title">Externe Unterstützung</h5>
    </div>
  </div>

  <div class="card p-3 text-center text-white bg-secondary">
    <div class="card-body">
      <h5 class="card-title">Schülervertretung</h5>
    </div>
  </div>

</div>


<div class="container"><?= $page->text()->blocks() ?></div>

<?php snippet('footer') ?>