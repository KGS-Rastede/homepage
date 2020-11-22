<div class="row">
  <?php foreach ($page->gallery()->toFiles() as $image) : ?>

    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
      <figure class="figure">
        <a href="<?= $image->url() ?>">
          <img class="w-100 img img-raised rounded" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">
        </a>
        <figcaption class="figure-caption"><?= $image->beschreibung() ?></figcaption>          
      </figure>
    </div>
        
  <?php endforeach ?>
</div>