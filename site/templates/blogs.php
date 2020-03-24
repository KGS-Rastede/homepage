<?php snippet('header') ?>

<?php snippet('page-header') ?>


<section class="jumbotron text-center">
  <div class="container">
    <h1>Die Schule stellt sich vor</h1>

    <p class="lead">Hier stellen sich die Fächer und Fachbereiche vor, aber auch andere Bereiche der Schule berichten.</p>
  </div>
</section>




<?php
// `toStructure()` erzeugt einen Iterator fuer die URLs
$items = $page->children()->flip();

$list = $items->paginate(5);

// Nun kann man jede URL durchgehen und jeweils einen Links erzeugen
foreach ($list as $item) : ?>

  <div class="col-md-12 mt-4">
    <div class="card-body">
      <h4 class="card-title">
        <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
      </h4>
      <p class="card-category">
        <div class="author">
          von
          <a href="#">
            <b><?= $item->author() ?></b>
          </a> Datum: <?= $item->date()->toDate("d.m.Y") ?>
        </div>
      </p>
      <div class="card-description">
        <?= $item->Text()->blocks()->excerpt(250) ?>
        <a href="<?= $item->url() ?>">...weiterlesen</a>
      </div>
    </div>
  </div>
  <hr>
<?php endforeach ?>


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