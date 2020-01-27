<div class="card card-plain card-blog">
  <div class="row">

    <?php foreach ($blogs as $blog) : ?>
      <?php snippet('teaser-bild', [
        'subpage' => $blog
      ]) ?>

      <?php snippet('teaser-bild-text', [
        'subpage' => $blog
      ]) ?>
    <?php endforeach ?>

  </div>
</div>