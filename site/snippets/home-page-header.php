<main role="main">


  <div class="hero-image">

    <div class="hero-text display-1">
      <h1>Herzlich Willkommen an der</h1>
      <p>Kooperative Gesamtschule Rastede</p>
    </div>

  <div class="d-none d-md-block">
    <div class="ConBoxR">
      <a href="#r">
        <img class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
        <div class="middle h6">Termine
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
          </div>
      </a>
    </div>
    <div class="ConBoxL">
      <a href="#l">
        <img class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
        <div class="middle h6">Ereignisse          
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#arrow-right-circle" /></svg>
        </div>
      </a>
    </div>
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