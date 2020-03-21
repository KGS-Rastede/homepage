<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h2><?= $page->heading() ?></h2>

<?php snippet('sidebar') ?>


<h1>Lehrpläne</h1>

<div class="col-lg-8 col-md-10 ml-auto mr-auto">
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
                  <i class="material-icons">cloud_download</i>
                </button>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
        
      </tbody>
    </table>
  </div>
</div>


<div class="row">

  <h2>Aktuelles aus dem Fach</h2>

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


<div class="container">
  <div class="row">



    <?php snippet('blogs', [
      'blogs' => page('blogs')
        ->children()
        ->listed()
        ->filterBy('tags', $page->haupttag(), ',')
    ]) ?>


    <?php if ($page->fotoansicht() == 'carousel') : ?>
      <?php snippet('carousel') ?>
    <?php elseif ($page->fotoansicht() == 'gallery') : ?>
      <?php snippet('gallery') ?>
    <?php else : ?>
      <!-- Bilder werden vom Autor manuel gesetzt -->
    <?php endif ?>
  </div>
</div>




















<?php snippet('footer') ?>