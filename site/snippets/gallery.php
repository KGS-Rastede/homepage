<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <?php foreach ($page->gallery()->toFiles() as $image) : ?>

    <div class="flex justify-center items-center">
      <figure class="figure">
        <a href="<?= $image->url() ?>">
          <img class="w-full rounded" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">
        </a>
        <figcaption class="figure-caption"><?= $image->beschreibung() ?></figcaption>
      </figure>
    </div>

  <?php endforeach ?>
</div>