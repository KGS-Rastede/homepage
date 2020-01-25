<?php snippet('header') ?>






<?php snippet('page-header') ?>



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


    
                <?php $index = 0; foreach (page('blogs')->children()->filterBy('featured', true) as $subpage) : $index++ ?>           

                <?php if ($index % 2 == 0) : ?>

                  <div class="col-md-5">
                    <div class="card-header card-header-image">
                      <?php if ($subpage->hasImages() > 0) : ?>
                        <img src="<?= $subpage->images()->first()->url() ?>" class="img img-raised" alt="<?= $subpage->images()->first()->alt() ?>">
                      <?php else : ?>
                        <img src="<?= $kirby->url('assets') ?>/logo-kgs.jpg" class="img img-raised" alt="Logo der KGS">
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h6 class="card-category text-info">Artikel #<?= $index ?></h6>
                    <h3 class="card-title">
                      <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>
                    </h3>
                    <p class="card-description">
                    <?= $subpage->Text()->blocks()->excerpt(250) ?>  
                    <a href="<?= $subpage->url() ?>">...weiterlesen</a>
                    </p>
                    <p class="author">
                      by
                      <a href="#pablo">
                        <b><?= $subpage->author() ?></b>
                      </a> Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                    </p>
                  </div>

                <?php else : ?>
                  <div class="col-md-7">
                    <h3 class="card-title">
                      <a href="#pablo"><?= $subpage->title() ?></a>
                    </h3>
                    <p class="card-description">
                      <?= $subpage->Text()->blocks()->excerpt(250) ?>  
                      <a href="<?= $subpage->url() ?>">...weiterlesen</a>
                    </p>
                    <p class="author">
                      by
                      <a href="#pablo">
                        <b><?= $subpage->author() ?></b>
                      </a> Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                    </p>
                  </div>
                  <div class="col-md-5">
                    <div class="card-header card-header-image">

                    <?php if ($subpage->hasImages() > 0) : ?>
                        <img src="<?= $subpage->images()->first()->url() ?>" class="img img-raised" alt="<?= $subpage->images()->first()->alt() ?>">
                      <?php else : ?>
                        <img src="<?= $kirby->url('assets') ?>/logo-kgs.jpg" class="img img-raised" alt="Logo der KGS">
                      <?php endif ?>

                    
                    </div>
                  </div>
                <?php endif ?>

                  

                  <?php endforeach ?>

                  <!-- der letzten beiden Zeilen sind immer gleich -->
                </div>
              </div>


              <!--  -->



              
 
              <!--  -->

            </div>
          </div>
        </div>
      </div>

      <!--  -->




   


<?php snippet('footer') ?>