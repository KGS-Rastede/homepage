<?php snippet('header-devblog') ?>

<div class="container w-full md:max-w-3xl mx-auto pt-20">

  <div class="w-full px-4 md:px-6 text-xl text-gray-700 leading-normal">

    <!--Title-->
    <div class="font-sans">
      <span class="text-base md:text-sm text-teal-500 font-bold">&lt;<span> <a href="<?= page('devblog')->url() ?>" class="text-base md:text-sm text-teal-500 font-bold no-underline hover:underline">Zurück zur Übersicht</a></p>
          <h1 class="font-bold font-sans break-normal text-gray-800 pt-6 pb-2 text-3xl md:text-4xl"><?= $page->title() ?></h1>
          <h1 class="font-bold font-sans break-normal text-gray-600 pt-6 pb-2 text-2xl md:text-2xl"><?= $page->heading() ?></h1>
          <p class="text-sm md:text-base text-gray-600">Veröffentlich am <?= $page->date()->toDate("d.m.Y") ?></p>
    </div>


    <!--Post Content-->


    <!--Lead Para-->

    <p class="py-6">
      <?= $page->intro()->kirbytext() ?>
    </p>

    <p class="py-6">

      <?= $page->text()->blocks() ?>

    </p>

    <!--/ Post Content-->

  </div>

  <!--Tags -->


  <div class="text-base md:text-sm text-gray-500 px-4 py-6">
    <svg class="bi" width="24" height="24">
      <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
    </svg>
    <?php foreach ($page->tags()->split() as $tag) : ?>
      <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
          <?= $tag ?>
        </button>
      </a>
    <?php endforeach ?>
  </div>

  <!--Divider-->
  <hr class="border-b-2 border-gray-400 mb-8 mx-4">



</div>
<!--/container-->


<footer class='w-full text-center border-t border-grey p-4'>
  <div class="flex">
    <div class="w-2/5">
      <a href="<?= $site->url() ?>">
        <?php snippet('logo-als-svg') ?>
      </a>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Kontakt</h5>
      <ul>
        <li><a class="text-muted" href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a></li>
        <li><a class="text-muted" href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a></li>
        <!-- Funktioniert noch nicht
          <li><a class="text-muted" href="<?= page('allgemeines/krankmeldung')->url() ?>">Krankmeldung</a></li> 
        -->
      </ul>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Über die KGS</h5>
      <ul>
        <li><a class="text-muted" href="<?= page('allgemeines/geschichte')->url() ?>">Unsere Geschichte</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/mensa')->url() ?>">Mensa</a></li>
      </ul>
    </div>
    <div class="w-1/5">
      <h5 class="font-bold">Wichtige Downloads</h5>
      <ul class="list-unstyled">
        <li><a class="text-muted" href="<?= page('allgemeines/downloads')->url() ?>#schulbuchlisten-1">Schulbuchlisten</a></li>
        <li><a class="text-muted" href="#">Schulordnung</a></li>
        <li><a class="text-muted" href="<?= page('allgemeines/wichtigelinks')->url() ?>">Wichtige Links</a></li>
      </ul>
    </div>
  </div>

</footer>
</body>

</html>