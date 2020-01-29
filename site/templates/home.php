<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="row">
  <?php snippet('rotier-knopf') ?>
  <?php snippet('rotier-knopf') ?>
  <?php snippet('rotier-knopf') ?>
</row>


<!-- -->

<div class="blogs-1" id="blogs-1">
  <div class="container">
    <div class="row">
      <div class="col-md-10 ml-auto mr-auto">
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
</div>


<?php snippet('footer') ?>