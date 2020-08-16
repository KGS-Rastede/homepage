<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="container">
  <div class="row">
    <div class="col-md-8">


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
          <div class="card bg-info">
            <h1><?php echo $titel ?></h1>
            <p class="lead"><?= page('wichtige_informationen/notfall')->text() ?></p>
          </div>
        <?php endif ?>

      </div>

      <?php $index = 0;
      foreach (page('blogs')
        ->children()
        ->flip() as $subpage) : $index++ ?>

        <?php
        if (in_array("Topartikel", $subpage->tags()->split())) {

              snippet('topartikel', ['subpage' => $subpage]);

        }

        ?>


      <?php endforeach ?>



<!-- 
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



      <div class="container">
        <h2 class="title">Aktuelle Nachrichten</h2>
        <br>

        <!--  
                    Jetzt werden die Elemente angefügt. 
                    -->
        <?php $index = 0;
        foreach (page('blogs')
          ->children()
          ->flip() as $subpage) : $index++ ?>


          <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>


            <!--  
                      % 2 testet letztlich, ob der Wert in $index gerade ist oder nicht
                      Das heißt: "glatt durch 2 teilbar".

                      Ich möchte effektiv bei jedem zweiten Artikel das Bild links und 
                      den Text rechts haben, um das Design etwas aufzulockern
                    -->
            <div class="card my-3">
              <div class="row my-4">

                <!-- der ersten beiden Zeilen sind immer gleich -->


                <?php if ($index % 2 == 0) : ?>

                  <?php snippet('teaser-bild', [
                    'subpage' => $subpage
                  ]) ?>

                  <?php snippet('teaser-bild-text', [
                    'subpage' => $subpage
                  ]) ?>

                <?php else : ?>

                  <?php snippet('teaser-bild-text', [
                    'subpage' => $subpage
                  ]) ?>

                  <?php snippet('teaser-bild', [
                    'subpage' => $subpage
                  ]) ?>

                <?php endif ?>

              </div>
            </div>

          <?php endif ?>

        <?php endforeach ?>

      </div>
      <a href="<?= page("blogs") ?>">
        <button class="btn btn-secondary">Weitere Nachrichten aus der Schule &#8594;</button>
      </a>

    </div>
    <div class="col-md-4">
      <?php snippet('box-kalender') ?>
      <?php snippet('box-presse') ?>
      <?php snippet('box-foerderverein') ?>
      <?php snippet('box-links') ?>
      <?php //snippet('box-wetter') 
      ?>
    </div>



  </div>
</div>







<?php snippet('footer') ?>