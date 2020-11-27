<?php snippet('header') ?>
<?php snippet('home-page-header') ?>


<div class="container-fluid">

  <?php if (page('wichtige_informationen/notfall')->toggle()->bool() === true) : ?>
    <div class="row">
      <div class="col-xl-8 mt-4">



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

          <div class="card bg-info text-white">
            <h1><?php echo $titel ?></h1>
            <p class="lead"><?= page('wichtige_informationen/notfall')->text() ?></p>
          </div>
        </div>

      </div>
    </div>
  <?php endif ?>

  <div class="row">
    <div class="col-xl-8">
      <?php 
        // auskommentieren, um Farben und Schriften auf die Schnelle zu testen
        //snippet('designdemo') 
      ?>
      <?php snippet('box-fokus') ?>
      <?php snippet('box-blogs') ?>
    </div>


    <div class="col-xl-4 mt-3 mt-xl-5">
      <?php snippet('box-schnellzugriff') ?>
      <?php snippet('box-kalender') ?>
      <?php snippet('box-presse') ?>
      <?php //snippet('box-wetter') 
      ?>
    </div>

  </div>

  <?php snippet('box-links') ?>

</div>


<?php snippet('footer') ?>