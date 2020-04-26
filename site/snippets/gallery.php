<ul class="list-group">
  <?php foreach ($page->images() as $image) : ?>
    <li class="list-group-item">
      <figure class="figure">
        <img class="d-block w-100" alt="<?= $image->alt() ?>" src="<?= $image->url() ?>">
        <figcaption class="figure-caption"><?= $image->bildunterschrift() ?></figcaption>
      </figure>
    </li>
  <?php endforeach ?>
</ul>