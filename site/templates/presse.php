<?php snippet('header') ?>

<?php snippet('page-header') ?>




<!--  -->

<?php 
// `toStructure()` erzeugt einen Iterator fuer die URLs
$items = $page->pressenachrichten()->toStructure()->sortBy("datum")->flip();

$list = $items->paginate(5);

// Nun kann man jede URL durchgehen und jeweils einen Links erzeugen
foreach ($list as $item): ?>
 
  <h2 class="title">
    <a href="<?= $item->link() ?>">
      <?= $item->name()->html() ?>
      
    </a>
  </h2>
  <div class="text-right">
  Datum: <?= $item->datum()->html() ?> <span class="badge badge-pill alert-dark"><?= $item->zeitung()->html() ?></span>
  </div>

  <p><?= $item->anfang() ?></p>
<?php endforeach ?>



<!--  -->


<?php $pagination = $list->pagination() ?>
<nav>
  <ul class="pagination">

    <?php if ($pagination->hasPrevPage()): ?>
    <li class="page-item">
      <a class="page-link" href="<?= $pagination->prevPageURL() ?>">‹</a>
    </li>
    <?php else: ?>
    <li>
      <span>‹</span>
    </li>
    <?php endif ?>

    <!-- Hier nun die mittleren Elemente -->

    <?php foreach ($pagination->range(10) as $r): ?>
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

    <?php if ($pagination->hasNextPage()): ?>
    <li class="page-item">
      <a class="page-link" href="<?= $pagination->nextPageURL() ?>">›</a>
    </li>
    <?php else: ?>
    <li class="page-item">
      <span>›</span>
    </li>
    <?php endif ?>

  </ul>
</nav>


<?php snippet('footer') ?>