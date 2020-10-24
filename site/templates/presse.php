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

<!--  -->


<?php $pagination = $list->pagination() ?>
<nav>
  <ul class="pagination">

    <?php if ($pagination->hasPrevPage()) : ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pagination->prevPageURL() ?>">‹</a>
      </li>
    <?php else : ?>
      <li>
        <span>‹</span>
      </li>
    <?php endif ?>

    <!-- Hier nun die mittleren Elemente -->

    <?php foreach ($pagination->range(10) as $r) : ?>
      <li class="page-item <?= $pagination->page() === $r ? 'active' : '' ?>">
        <!-- Hier steckt hinter:
        Wenn page() identisch ist mit $r schreibe aria-current (also aktuelle Seite),
        ansonsten mache '', also füge nichts ein. Das ist eine extreme Abkürzung.

        Damit wird im Endeffekt erreicht, dass mit nur einer Zeile die aktuelle Seite
        markiert
      -->
        <a class="page-link" <?= $pagination->page() === $r ? 'aria-current="page"' : '' ?> href="<?= $pagination->pageURL($r) ?>">
          <?= $r ?>
        </a>
      </li>
    <?php endforeach ?>

    <?php if ($pagination->hasNextPage()) : ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pagination->nextPageURL() ?>">›</a>
      </li>
    <?php else : ?>
      <li class="page-item">
        <span>›</span>
      </li>
    <?php endif ?>

  </ul>
</nav>


<?php snippet('footer') ?>