<main role="main">


  <div class="hero-image">

    <div class="hero-text display-1">
      <h1>Herzlich Willkommen an der</h1>
      <p>Kooperative Gesamtschule Rastede</p>
    </div>


  <div class="ConBoxR">
    <div class="rechts">
      <a href="#r">
        <img class="imagez" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
        <div class="middle h6">Termine</div>
      </a>
    </div>
  </div>
  <div class="ConBoxL">
    <div class="links">
      <a href="#l">
        <img class="imagez rounded" src="<?= $page->files()->find('acker.jpg')->url() ?>" alt="Termine">
        <div class="middle h6">Ereignisse</div>
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