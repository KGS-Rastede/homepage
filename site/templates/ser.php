<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>




<?php
// `toStructure()` erzeugt einen Iterator fuer die URLs
$items = page('ser/nachrichten')->children()->listed();

$list = $items->paginate(5);

// Nun kann man jede URL durchgehen und jeweils einen Links erzeugen
foreach ($list as $item) : ?>

  <div class="col-md-12 mt-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
        </h4>
        <p class="card-category">
          <div class="author text-right">
            von
            <b><?= $item->author() ?></b>
            Datum: <?= $item->date()->toDate("d.m.Y") ?>
          </div>
        </p>
        <p class="card-text">
          <?= $item->Text()->blocks()->excerpt(250) ?>
        </p>
        <a href="<?= $item->url() ?>" class="btn btn-secondary">weiterlesen &#8594;
        </a>
      </div>
    </div>

  </div>
  <hr>
<?php endforeach ?>






<?php snippet('footer') ?>