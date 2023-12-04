<?php snippet('header') ?>
<?php snippet('home-page-header') ?>

<?php snippet('box-notfall') ?>

<div class="container-fluid">
  <div class="row">  
    <div class="col-xl-8">
      <?php 
        // auskommentieren, um Farben und Schriften auf die Schnelle zu testen
        // snippet('designdemo') 
      ?>
      <?php snippet('box-fokus') ?>
      <?php snippet('box-blogs') ?>
    </div>

    <div class="col-xl-4">
      <?php snippet('box-kalender') ?>
      <?php snippet('box-presse') ?>
    </div>

  </div>

  <?php snippet('box-links') ?>

</div>


<?php snippet('footer') ?>