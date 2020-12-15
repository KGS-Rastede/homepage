<?php $kategorien = page('navbar')->navbar()->toStructure() ?>

<?php if ($kategorien->isNotEmpty()) : //Erst die Grundstruktur für die nav ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid"> 
        <!--
              Hier kann das Logo stehen oder der Name der Schule.
              Müssen wir am Ende vom Design her entscheiden.
            -->
      <div class="d-none d-sm-none d-lg-block d-xl-block">
        <a class="logo" href="<?= $site->url() ?>">
          <?= asset('assets/bilder/logo.svg')->read() ?>
        </a>
      </div>

      <a class="navbar-brand text-white d-block d-sm-block d-lg-none" href="<?= $site->url() ?>">KGS Rastede</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 me-3 mb-lg-0">

          <?php //Jetzt kommen alle Kategorien
            snippet('navkategorien', ['items' => $kategorien]) ?>

        </ul>
      </div>
    </div>
  </nav>

<?php endif ?>
