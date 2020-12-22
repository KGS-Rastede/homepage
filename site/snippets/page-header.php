<main role="main">
  <?php
  if ($image = $page->hintergrundbild()->toFile()) : ?>

    <div class="p-5 text-center bg-image" style="
            background-image: url('<?= $image->url() ?>');
            background-repeat: no-repeat;
            background-size: cover;
            height:30vh">

    <?php else : ?>
      <div class="p-5 text-center bg-image" style="
    background-image: url('<?= $kirby->url('assets') ?>/img/IMG_1343.jpeg');
    background-repeat: no-repeat;
    background-size: cover;
    height:30vh">
      <?php endif ?>
      </div>




      <!-- Titelfeld -->

      <div class="p-3 mb-2 bg-light text-primary">
        <h1>
          <?= $page->title() ?>
        </h1>
      </div>
      <small class="text-muted"><?= $page->subtitle() ?></small>

      <h1 class="display-6 mb-3 ms-3">
        <?= $page->heading() ?>
      </h1>
    </div>