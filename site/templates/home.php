<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-9">


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

      <!-- Jetzt folgen die als 'Topartikel' getaggte Blogs
          Die tauchen hier immer auch, egal welches Datumsbereich
          jeweils eingestellt ist
         -->
      <h1>Aktuell im Fokus</h1>
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-xs-1 row-cols-md-2">
          <?php $index = 0;
          foreach (page('blogs')
            ->children()
            ->flip() as $subpage) : $index++ ?>
            <div class="col">
              <?php
              if (in_array("Topartikel", $subpage->tags()->split())) {
                snippet('topartikel', ['subpage' => $subpage]);
              }
              ?>
            </div>
          <?php endforeach ?>
        </div>
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



      <h1 class="title">Aktuelle Nachrichten</h1>
      <div class="row row-cols-1 row-cols-xs-1 row-cols-md-2 g-4">

        <!-- <div class="row row-cols-1 row-cols-xs-1 row-cols-md-2"> -->



        <!--  
                    Jetzt werden die Elemente angefügt. 
                    -->
        <?php $index = 0;
        foreach (page('blogs')
          ->children()
          ->flip() as $subpage) : $index++ ?>


          <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>
            <?php
            snippet('blogkarte', ['subpage' => $subpage]);
            ?>
          <?php endif ?>


        <?php endforeach ?>

      </div>




      <a href="<?= page("blogs") ?>">
        <button class="btn btn-secondary">Weitere Nachrichten aus der Schule &#8594;</button>
      </a>

    </div>

    <div class="col-md-3">
      <div class="container mt-5">
        <?php snippet('box-schnellzugriff') ?>
        <?php snippet('box-kalender') ?>
        <?php snippet('box-presse') ?>
        <?php snippet('box-foerderverein') ?>
        <?php snippet('box-links') ?>
        <?php //snippet('box-wetter') 
        ?>
      </div>
    </div>



  </div>
</div>







<?php snippet('footer') ?>