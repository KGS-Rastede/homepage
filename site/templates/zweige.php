<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="card card-pricing card-background">
      <div class="card-body">
        <h3 class="card-category text-info">Hauptschulzweig</h3>
        <h4 class="card-title">Leitung: Marieke Pannenborg</h4>

        <a href="#pablo" class="btn btn-danger">
          Weitere Informationen
        </a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="card card-pricing card-background">
      <div class="card-body">
        <h3 class="card-category text-info">Realschulzweig</h3>
        <h4 class="card-title">Leitung: Andreas Kleeberg</h4>

        <a href="#pablo" class="btn btn-danger">
          Weitere Informationen
        </a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="card card-pricing card-background">
      <div class="card-body">
        <h3 class="card-category text-info">Gymnasialzweig</h3>
        <h4 class="card-title">Leitung: Malte Bormann</h4>

        <a href="#pablo" class="btn btn-danger">
          Weitere Informationen
        </a>
      </div>
    </div>
  </div>

</div>

<div class="container"><?= $page->text()->blocks() ?></div>

<?php snippet('footer') ?>