<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?= $page->Lehrplantext()->kirbytext() ?>


<div class="container">
  <div class="row align-items-start">
    <div class="col-xl-5">


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
                <?php if ($datei->Anzeigename() == "") : ?>
                  <td>
                    <a href="<?= $datei->url() ?>" class="text-decoration-none">
                      <?= $datei->name() ?>
                    </a>

                    <?php if ($datei->Startseite() == 'true') : ?>
                      <i class="bi bi-lightning-fill"></i>
                    <?php endif ?>

                  </td>
                <?php else : ?>
                  <td>
                    <a href="<?= $datei->url() ?>" class="text-decoration-none">
                      <?= $datei->Anzeigename() ?>
                    </a>
                    <?php if ($datei->Startseite() == 'true') : ?>
                      <i class="bi bi-lightning-fill"></i>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>
            <?php endforeach ?>
            <td>
              <a class="text-decoration-none" href="<?= page("/allgemeines/schulbuchlisten")->url() ?>">Schulbuchlisten</a>
            </td>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-xl-5">
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
                <?php if ($datei->Anzeigename() == "") : ?>
                  <td>
                    <a href="<?= $datei->url() ?>" class="text-decoration-none">
                      <?= $datei->name() ?>
                    </a>

                    <?php if ($datei->Startseite() == 'true') : ?>
                      <i class="bi bi-lightning-fill"></i>
                    <?php endif ?>
                  </td>
                <?php else : ?>
                  <td>
                    <a href="<?= $datei->url() ?>" class="text-decoration-none">
                      <?= $datei->Anzeigename() ?>
                    </a>

                    <?php if ($datei->Startseite() == 'true') : ?>
                      <i class="bi bi-lightning-fill"></i>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>

  <hr>

  <p>Hinweis: Artikel, die mit einem <i class="bi bi-lightning-fill"></i>
 markiert sind, sind direkt auf der Startseite unter "Zur Zeit aktuelle Downloads" verlinkt.
  </p>

</div>

<?php snippet('footer') ?>