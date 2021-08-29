<div class="card mb-3">
  <div class="card-body">
    <img src="<?= $block->bild()->toFile()->url() ?>" class="card-img" alt="Fremdsprachen">

    <h3 class="card-category card-title mb-3 text-warning"><?= $block->name() ?></h3>
    <h4 class="card-title"><?= $block->kurzbeschreibung() ?></h4>

    <div class="list-group">

      <?php
      $relatedPages =  $block->unterseite()->toPages();

      foreach ($relatedPages as $relatedPage) : ?>
        <a href="<?= $relatedPage->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-<?= $block->icon() ?>"></i> <?= $relatedPage->title() ?>
        </a>
      <?php endforeach ?>

    </div>
  </div>
</div>