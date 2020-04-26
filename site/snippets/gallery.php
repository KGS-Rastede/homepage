  <div class="row">
    <?php foreach ($page->images() as $image) : ?>

      <div class="col-9 col-md-6 col-sm-3">
        <figure class="figure">
            <img class="d-block w-100" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">
            <figcaption class="figure-caption"><?= $image->bildunterschrift() ?></figcaption>
        </figure>
      </div>
         
    <?php endforeach ?>
  </div>
