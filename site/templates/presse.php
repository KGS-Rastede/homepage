<?php snippet('header') ?>

<?php snippet('page-header') ?>




<!--  -->
<div class="p-4 p-md-5 mb-4 rounded">
  <div class="row">


    <?php
    // `toStructure()` erzeugt einen Iterator fuer die URLs
    $items = $page->pressenachrichten()->toStructure()->sortBy("datum")->flip();

    $list = $items->paginate(10);

    $quelle = "";

    // Nun kann man jede URL durchgehen und jeweils einen Links erzeugen
    foreach ($list as $item) : ?>

      <?php
      if ($item->medium() == "nwz") {
        $quelle = "Nordwest Zeitung";
      } elseif ($item->medium() == "youtube") {
        $quelle = "YouTube";
      } elseif ($item->medium() == "rastederrundschau") {
        $quelle = "Rasteder Rundschau";
      } elseif ($item->medium() == "gemeinde") {
        $quelle = "Gemeinde Rastede";
      } else {
        $quelle = "";
      }
      ?>

      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <div class="d-flex justify-content-between">
              <div>
                <h3>
                  <?= $item->name()->html() ?>
                </h3>
              </div>
              <div>
                <span class="badge badge-pill bg-secondary"><?= $quelle ?></span>  
              </div>
            </div>

            <div class="mb-1 text-muted">
              Datum: <?= $item->datum()->html() ?>
            </div>

            <p class="card-text mt-3 mb-auto">
              <?= $item->anfang() ?>
            </p>

            <a class="stretched-link" href="<?= $item->link() ?>">
              weiterlesen... 
            </a>

          </div>
        </div>
      </div>

    <?php endforeach ?>
  </div>

</div>

<?php $pagination = $list->pagination() ?>
<?php snippet('pagination', ['pagination' => $pagination]) ?>

<?php snippet('footer') ?>