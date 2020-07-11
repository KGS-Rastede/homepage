<main role="main">


  <?php

  $bildpfad = "";

  if ($image = $page->hintergrundbild()->toFile()) : ?>
    $bildpfad = <?= $image->url() ?>;
  <?php else : ?>
    $bildpfad = <?= $kirby->url('assets') ?> + "/img/banner_eng.jpg";
  <?php endif ?>




  <div class="p-5 text-center bg-image" style="
      background-image: url('https://mdbootstrap.com/img/new/slides/041.jpg');
      height: 400px;
    ">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3"><?= $page->title() ?></h1>
          <h4 class="mb-3"><?= $page->subtitle() ?></h4>
          <a class="btn btn-outline-light btn-lg" href="#!" role="button">Call to action</a>
        </div>
      </div>
    </div>
  </div>





  <div class="titelfeld">
    <div class="container">
      <h1><?= $page->title() ?>
        <small class="text-muted"><?= $page->subtitle() ?></small>
      </h1>
    </div>
  </div>
  </div>


  <!-- Ab hier der richtige Inhalt, der auf jeder Seite individuell sein kann -->
  <div class="container">