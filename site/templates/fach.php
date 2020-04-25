<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h2><?= $page->heading() ?></h2>

<?php snippet('sidebar') ?>

<?php if ($page->lehrplaene()->isNotEmpty()) : ?>

  <h2>Lehrpläne</h2>

  <?= $page->Lehrplantext()->kirbytext() ?>


  <div class="col-lg-9 col-md-9 ml-auto mr-auto">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Lehrplanname</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($page->lehrplaene()->toStructure() as $lehrplan) : ?>
            <tr>
              <td><?= $lehrplan->name() ?></td>
              <td class="td-actions text-right">
                <a href="<?= $lehrplan->link()->toFile()->url() ?>">
                  Download
                  <button type="button" rel="tooltip" class="btn btn-info btn-just-icon btn-sm">
                    <img src="<?= $kirby->url('assets') ?>/icons/cloud-download.svg">
                  </button>
                </a>
              </td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
  </div>

<?php endif ?>

<!-- Die Inhalte, die immer sichtbar sein sollen, sollen über den Blogs stehen  -->
<div class="container">

  <?php $index = 0;
  foreach (page('blogs')
    ->children()
    ->listed()
    ->filterBy('immer_sichtbar', true)
    ->filterBy('tags', $page->haupttag(), ',') as $subpage) : $index++ ?>

    <?php if ($index  != 0) : ?>

      <?php snippet('teaser-bild', [
        'subpage' => $subpage
      ]) ?>

      <?php snippet('teaser-bild-text', [
        'subpage' => $subpage
      ]) ?>

    <?php else : ?>
    <?php endif ?>
  <?php endforeach ?>
</div>

<?php if ( page('blogs')->children()->listed()->filterBy('tags', $page->haupttag(), ',')->isNotEmpty() ): ?>

  <h2>Aktuelles aus dem Fach</h2>

  <div class="container col-lg-9 col-md-9 ml-auto mr-auto">

    <?php snippet('blogs', [
      'blogs' => page('blogs')
        ->children()
        ->listed()
        ->filterBy('tags', $page->haupttag(), ',')
        ->flip()
    ]) ?>

  </div>

<?php endif ?>



<?php if ( $page->hasImages() ) :?>

<div class="container col-lg-9 col-md-9 ml-auto mr-auto">

  <?php if ($page->fotoansicht() == 'carousel') : ?>
    <?php snippet('carousel') ?>
  <?php elseif ($page->fotoansicht() == 'gallery') : ?>
    <?php snippet('gallery') ?>
  <?php else : ?>
    <!-- Bilder werden vom Autor manuel gesetzt -->
  <?php endif ?>
</div>

<?php endif ?>


<?php snippet('footer') ?>