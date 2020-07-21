<main role="main">







    <?php
    if ($image = $page->hintergrundbild()->toFile()) : ?>


      <div class="p-5 text-center bg-image" style="
            background-image: url('<?= $image->url() ?>');
            height: 400px;">

      
    <?php else : ?>
      
      <div class="p-5 mt-5 text-center bg-image" style="
      background-image: url('<?= $kirby->url('assets') ?>/img/banner_eng.jpg');
      ">
      
    <?php endif ?>


  </div>




<!-- Titelfeld -->
  <div class="titelfeld">
    <div class="container">
      <h1>
        <?= $page->title() ?>
      </h1>

      <p class="lead">
        <?= $page->heading() ?>
      </p>
    </div>
  </div>


  <!-- Ab hier der richtige Inhalt, der auf jeder Seite individuell sein kann -->
  <div class="container">