<?php snippet('header') ?>
<?php snippet('page-header') ?>


<div class="container">
  <div class="content">
    <div class="row">
      <div class="col-md-9">
        <!-- 
        An besonderen Tagen (Schneefrei, Heizungsburch, ...) soll ganz schnell
        ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
        -->

        <?php if (page('allgemeines/notfall')->category() == "sturm") :
          $titel = "Schulausfall wegen Sturm";
        endif ?>
        <?php if (page('allgemeines/notfall')->category() == "eis") :
          $titel = "Schulausfall wegen Glatteis";
        endif ?>
        <?php if (page('allgemeines/notfall')->category() == "regen") :
          $titel = "Schulausfall wegen Starkregen";
        endif ?>
        <?php if (page('allgemeines/notfall')->category() == "heizung") :
          $titel = "Schulausfall wegen Heizungsausfall";
        endif ?>
        <?php if (page('allgemeines/notfall')->category() == "eigenerTitel") :
          $titel = page('allgemeines/notfall')->textTitel();
        endif ?>

        <?php if (page('allgemeines/notfall')->toggle()->bool() === true) : ?>
          <div class="alert alert-danger" role="alert">
            <h2><?php echo $titel ?></h2>
            <p class="lead"><?= page('allgemeines/notfall')->text() ?></p>
          </div>
        <?php endif ?>




        <!-- Rotierknopf bspw für Elternsprechtag -->

        <div class="row">
          <?php foreach (page('allgemeines/aktuelles')->banner()->toStructure() as $subpage) :  ?>
            <?php if ($subpage->dateBis()->toDate('Y-m-d') >= date('Y-m-d')) :
              snippet('rotier-knopf', ['subpage' => $subpage]);
            endif ?>
          <?php endforeach ?>
        </div>




        <div class="blogs-1" id="blogs-1">
          <div class="container">
            <div class="row">
              <div class="col-md-12 ml-auto mr-auto">
                <h2 class="title">Aktuelle Nachrichten</h2>
                <br>

                <!--  
                    Jetzt werden die Elemente angefügt. 
                    -->

                <div class="card card-plain card-blog">
                  <div class="row">

                    <!-- der ersten beiden Zeilen sind immer gleich -->



                    <?php $index = 0;
                    foreach (page('blogs')->children()->filterBy('featured', true) as $subpage) : $index++ ?>

                      <!--  
                      % 2 testet letztlich, ob der Wert in $index gerade ist oder nicht
                      Das heißt: "glatt durch 2 teilbar".

                      Ich möchte effektiv bei jedem zweiten Artikel das Bild links und 
                      den Text rechts haben, um das Design etwas aufzulockern
                    -->
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



                    <?php endforeach ?>

                    <!-- der letzten beiden Zeilen sind immer gleich -->
                  </div>
                </div>

                <!--  -->

              </div>
            </div>
          </div>
          <a href="<?= page("blogs") ?>">
            <button class="btn btn-primary">Weitere Nachrichten aus der Schule</button>
          </a>
        </div>




      </div>
      <div class="col-lg-3 col-md-6">
        <?php snippet('box-presse') ?>
        <?php snippet('box-foerderverein') ?>
        <?php snippet('box-links') ?>

      </div>


      
    </div>
  </div>
</div>







<?php snippet('footer') ?>