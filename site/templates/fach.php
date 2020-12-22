<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">
<?php if ($page->lehrplaene()->isNotEmpty()) : ?>

  <h2>Lehrpläne</h2>

  <?= $page->Lehrplantext()->kirbytext() ?>


  <div class="row align-items-start">
    <div class="col-xl-10">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Lehrplan</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($page->lehrplaene()->toFiles() as $lehrplan) : ?>
              <tr>
                <td>
                  <a href="<?= $lehrplan->url() ?>" class="text-decoration-none">
                    <?= $lehrplan->kurzbeschreibung()->or($lehrplan->name()) ?>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>


<?php endif ?>


<?php if (collection('blogs-haupttag')->isNotEmpty()) : ?>

  <h2>Aktuelles aus dem Fach</h2>

  <?php
  foreach (collection('blogs-haupttag')
    ->flip() as $subpage) :

    snippet('blogkarte', ['subpage' => $subpage]);
  ?>

  <?php endforeach ?>

<?php endif ?>



<?php if ($page->hasImages()) : ?>

    <?php if ($page->fotoansicht() == 'carousel') : ?>
      <?php snippet('carousel') ?>
    <?php elseif ($page->fotoansicht() == 'gallery') : ?>
      <?php snippet('gallery') ?>
    <?php else : ?>
      <!-- Bilder werden vom Autor manuel gesetzt -->
    <?php endif ?>

<?php endif ?>
</div>

<?php snippet('footer') ?>