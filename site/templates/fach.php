<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">
  <?php if ($page->lehrplaene()->isNotEmpty()): ?>

    <h2 class="text-2xl">Lehrpläne</h2>

    <div class="py-2">
      <?= $page->Lehrplantext()->kirbytext() ?>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">

            <thead>
              <tr>
                <th scope="col" class="px-3 py-3.5 text-left text-xl font-semibold text-gray-900">Lehrplan</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($page->lehrplaene()->toFiles() as $lehrplan): ?>
                <tr>
                  <td class="whitespace-nowrap px-3 py-4">
                    <a href="<?= $lehrplan->url() ?>">
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


  <?php if (collection('blogs-haupttag')->isNotEmpty()): ?>

    <h2 class="mt-2 text-2xl">Aktuelles aus dem Fach</h2>

    <?php
    foreach (collection('blogs-haupttag')->flip() as $subpage):

      snippet('blogkarte', ['subpage' => $subpage]);
      ?>

    <?php endforeach ?>

  <?php endif ?>


</div>

<?php snippet('footertw') ?>