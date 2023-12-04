<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?= $page->Lehrplantext()->kirbytext() ?>


<div class="container">
  <div class="row align-items-start">
    <div class="col-xl-4">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Unterricht</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($page->Unterricht()->toFiles() as $datei) : ?>
              <tr>
                <td>
                  <span class="badge bg-light me-1 text-uppercase"><?= $datei->extension() ?></span>
                  <a href="<?= $datei->url() ?>" class="text-decoration-none">
                    <?= $datei->Anzeigename()->or($datei->name()) ?>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
            <td>
              <span class="badge bg-light me-1"><i class="bi bi-arrow-right"></i></span>
              <a class="text-decoration-none" href="<?= page("/allgemeines/schulbuchlisten")->url() ?>">Schulbuchlisten</a>
            </td>
            
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Schule</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($page->Schule()->toFiles() as $datei) : ?>
              <tr>                
                <td>
                  <span class="badge bg-light me-1 text-uppercase"><?= $datei->extension() ?></span>
                  <a href="<?= $datei->url() ?>" class="text-decoration-none">
                    <?= $datei->Anzeigename()->or($datei->name()) ?>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>

      </div>
    </div>

    <div class="col-xl-4">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Datenschutz</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($page->Datenschutz()->toFiles() as $datei) : ?>
              <tr>                
                <td>
                  <span class="badge bg-light me-1 text-uppercase"><?= $datei->extension() ?></span>
                  <a href="<?= $datei->url() ?>" class="text-decoration-none">
                    <?= $datei->Anzeigename()->or($datei->name()) ?>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
            <td>
              <span class="badge bg-light me-1"><i class="bi bi-arrow-right"></i></span>
              <a class="text-decoration-none" href="<?= page("/nutzungsordnung")->url() ?>">Zugang zum Netzwerk</a>
            </td>

          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>

<?php snippet('footer') ?>