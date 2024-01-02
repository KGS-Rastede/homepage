<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>




<div class="container">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="grid grid-cols-1 p-4 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

      <?php foreach ($page->children() as $sf): ?>
        <div class="group bg-slate-100 p-4">
          <div>
            <?php if ($image = $sf->bild()->toFile()): ?>
              <img src="<?= $image->url() ?>" class="card-img-top" alt="...">
            <?php endif ?>

            <div>
              <h3 class="mt-3 text-lg font-semibold text-gray-900 group-hover:text-gray-600">
                <?= $sf->Title() ?>
              </h3>
              <p class="mt-1 text-gray-600">
                <?= $sf->Heading() ?>
              </p>
              <p class="mt-3 leading-2 text-gray-600">
                <?= $sf->Beschreibung()->toBlocks()->excerpt(300) ?>
              </p>

            </div>
          </div>

          <div class="mt-4">
            <?php snippet('knopf-klein', ['subpage' => $sf, 'knopftext' => "weiterlesen..."]); ?>
          </div>

        </div>
      <?php endforeach ?>
    </div>


    <div class="container mt-4">

      <h2 class="text-2xl border-t">
        Aktuelles aus den Schülerfirmen
      </h2>

      <?php
      foreach (page('blogs')->children()->listed()->filterBy('tags', 'Schülerfirmen', ',')->flip() as $subpage):

        snippet('blogkarte', ['subpage' => $subpage]);
        ?>

      <?php endforeach ?>

    </div>

  </div>
</div>


<?php snippet('footertw') ?>