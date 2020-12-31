<?php $kategorien = page('navbar')->navbar()->toStructure() ?>
<?php $count = 1 //Wird für die id der Kategorien verwendet, damit diese einmalig bleiben ?> 

<?php if ($kategorien->isNotEmpty()) : //Erst die Grundstruktur für die nav ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
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
      <div class="d-block d-lg-none d-xl-none">
        <a class="logo" href="<?= $site->url() ?>">
          <?= asset('assets/bilder/logo_square.svg')->read() ?>
        </a>
      </div>

      <a class="navbar-brand d-block d-sm-block d-lg-none" href="<?= $site->url() ?>">KGS Rastede</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 me-3 mb-lg-0">

          <?php //Jetzt kommen alle Kategorien
            snippet('navkategorien', ['items' => $kategorien, 'count' => $count ]) ?>

        </ul>
        <form class="d-flex"> 
          <input class="form-control me-2" style="width: 75%;" type="search" placeholder="Suchen" name="q" value="<?php echo (!empty($query)) ? esc($query) : '' ?>"> 
          <button class="btn btn-outline-success" type="submit" formaction="<?= page('search')->url() ?>#top">
            <svg class="bi" width="24" height="24"><use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#search" /></svg>
          </button>
        </form>
      </div>
    </div>
  </nav>

<?php endif ?>
