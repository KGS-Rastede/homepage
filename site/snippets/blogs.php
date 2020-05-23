<div class="card card-plain card-blog">

  <?php foreach ($blogs as $blog) : ?>

    <div class="row mb-3">


      <?php snippet('teaser-bild', [
        'subpage' => $blog
      ]) ?>

      <?php snippet('teaser-bild-text', [
        'subpage' => $blog
      ]) ?>

    </div>


  <?php endforeach ?>

</div>