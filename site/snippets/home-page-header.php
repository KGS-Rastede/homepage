<main role="main">


  <div class="hero-image">

    <div class="hero-text display-1">
      <h1>Herzlich Willkommen an der</h1>
      <p>Kooperative Gesamtschule Rastede</p>
    </div>

    <div class="d-none d-md-block">
      <div class="ConBoxR hovereffekt">
        <a href="<?= page('allgemeines/kalender')->url() ?>">
          <img class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
          <div class="middle h6 d-flex">Termine 
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
            </div>
        </a>
      </div>
      <div class="ConBoxL hovereffekt">
        <a href="<?= page('blogs')->url() ?>">
          <img class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Ereignisse">
          <div class="middle h6 d-flex">Ereignisse          
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
          </div>
        </a>
      </div>
    </div>
  </div>
      
  


  <div class="bg-dark d-flex justify-content-center d-block d-md-none">
    <div class="hovereffekt" style="width: 50%;">
      <a href="<?= page('allgemeines/kalender')->url() ?>">
      <img style="height: 10rem;" class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
      <div class="h6 setText">Termine          
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
          </div>
      </a>
    </div>
    <div class="hovereffekt" style="width: 50%">
      <a href="<?= page('blogs')->url() ?>">
        <img style="height: 10rem" class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Ereignisse">
        <div class="h6 setText">Ereignisse          
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
        </div>
      </a>
    </div>
  </div>


      <!-- Titelfeld -->
      <div class="p-3 mb-2 bg-light text-primary">
        <h1>
          <?= $page->title() ?>
        </h1>
      </div>
      <small class="text-muted"><?= $page->subtitle() ?></small>

      <h1 class="display-6 mb-3">
        <?= $page->heading() ?>
      </h1>
    </div>