.
<?php snippet('header') ?>
<?php snippet('home-page-header') ?>


<div class="container-fluid">
  <div class="row">
    <div class="col-xl-8">


      <div class="card bg-primary">
        <!-- 
        An besonderen Tagen (Schneefrei, Heizungsburch, ...) soll ganz schnell
        ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
        -->

        <?php if (page('wichtige_informationen/notfall')->category() == "sturm") :
          $titel = "Schulausfall wegen Sturm";
        endif ?>
        <?php if (page('wichtige_informationen/notfall')->category() == "eis") :
          $titel = "Schulausfall wegen Glatteis";
        endif ?>
        <?php if (page('wichtige_informationen/notfall')->category() == "regen") :
          $titel = "Schulausfall wegen Starkregen";
        endif ?>
        <?php if (page('wichtige_informationen/notfall')->category() == "heizung") :
          $titel = "Schulausfall wegen Heizungsausfall";
        endif ?>
        <?php if (page('wichtige_informationen/notfall')->category() == "eigenerTitel") :
          $titel = page('wichtige_informationen/notfall')->textTitel();
        endif ?>

        <?php if (page('wichtige_informationen/notfall')->toggle()->bool() === true) : ?>
          <div class="card bg-info text-white">
            <h1><?php echo $titel ?></h1>
            <p class="lead"><?= page('wichtige_informationen/notfall')->text() ?></p>
          </div>
        <?php endif ?>

      </div>



      <!-- '''
      <div class="card py-4">

        <h1>Zum Testen der Farben hier die Farben des Schemas</h1>

        <hr>

        <h1>primary</h1>
        <button class="btn btn-primary">Weitere Nachrichten aus der Schule</button>

        <h1>secondary</h1>
        <button class="btn btn-secondary">Weitere Nachrichten aus der Schule</button>

        <h1>info</h1>
        <button class="btn btn-info">Weitere Nachrichten aus der Schule</button>

        <h1>warning</h1>
        <button class="btn btn-warning">Weitere Nachrichten aus der Schule</button>

        <h1>danger</h1>
        <button class="btn btn-danger">Weitere Nachrichten aus der Schule</button>

        <h1>light</h1>
        <button class="btn btn-light">Weitere Nachrichten aus der Schule</button>

        <h1>dark</h1>
        <button class="btn btn-dark">Weitere Nachrichten aus der Schule</button>
      </div> -->



      <h1 class="title mt-5">Aktuelle Nachrichten</h1>

      <div class="row row-cols-1 row-cols-xs-1 row-cols-lg-2 g-4">


        <?php foreach (page('blogs')
          ->children()
          ->flip() as $subpage) : ?>


          <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')//noch aktuell? 
            && in_array("Topartikel", $subpage->tags()->split()) == false) : //kein Topartikel?>

            <?php
            snippet('blogkarte', ['subpage' => $subpage]);
            ?>
          <?php endif ?>

        <?php endforeach ?>

      </div>


      <a href="<?= page("blogs") ?>">
        <button class="btn btn-secondary mb-5">Weitere Nachrichten aus der Schule &#8594;</button>
      </a>

      <div class="container-fluid">

        <hr class="mt-5">

        <div class="row">
          <div class="col-lg-4">
            <?php snippet('box-links') ?>
          </div>
          <div class="col-lg-4">
            <?php snippet('box-foerderverein') ?>
          </div>
        </div>
      </div>

      <div class="container-fluid mt-5">
        <div class="row">

          <div class="col-lg-6">
            <?php snippet('box-presse') ?>
          </div>

          <div class="col-lg-6">
            <?php snippet('box-kalender') ?>
          </div>

        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="container mt-5">
        <?php snippet('box-schnellzugriff') ?>
        <?php snippet('box-fokus') ?>
        <?php //snippet('box-wetter') 
        ?>
      </div>
    </div>



  </div>
</div>







<?php snippet('footer') ?>