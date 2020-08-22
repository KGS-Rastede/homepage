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
        <div class="row row-cols-1 row-cols-cs-1 row-cols-md-2 g-4">

          <!-- <div class="row row-cols-1 row-cols-xs-1 row-cols-md-2"> -->



          <!--  
                    Jetzt werden die Elemente angefügt. 
                    -->
          <?php $index = 0;
          foreach (page('blogs')
            ->children()
            ->flip() as $subpage) : $index++ ?>


            <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>
              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title">
                      <?= $subpage->title() ?>
                    </h2>

                    <div class="text-right">
                      <svg class="bi" width="24" height="24">
                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                      </svg>
                      <?php foreach ($subpage->tags()->split() as $tag) : ?>
                        <a href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                          <span class="badge rounded-pill bg-warning"><?= $tag ?></span>
                        </a>
                      <?php endforeach ?>

                      - <b><?= $subpage->author() ?></b> - <?= $subpage->date()->toDate("d.m.Y") ?>
                    </div>

                    <p class="card-text mt-2">
                      <?= $subpage->Text()->blocks()->excerpt(250) ?>
                    </p>
                  </div>


                  <div class="card-footer">
                    <div class="text-right">
                      <a href="<?= $subpage->url() ?>">
                        <button type="button" class="btn btn-warning">...weiterlesen</button>
                      </a>
                    </div>


                  </div>
                </div>
              </div>
            <?php endif ?>


          <?php endforeach ?>

        </div>


      <hr>

      <div class="container-fluid">
        <div class="row example-centered">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
            <ul class="timeline timeline-split">

              <li class="timeline-item period">
                <div class="timeline-info"></div>
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h2 class="timeline-title pb-4">Aktuelles aus der Schule</h2>
                  <h3 class="timeline-title">[Probeversion 2 als Zeitleiste... Was sieht besser aus? Gerne Rückmeldungen!]</h3>

                </div>
              </li>

              <?php $index = 0;
              foreach (page('blogs')
                ->children()
                ->flip() as $subpage) : $index++ ?>


                <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>

                  <li class="timeline-item">
                    <div class="timeline-info">
                      <span>
                        Autor <b><?= $subpage->author() ?></b>, Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                      </span>

                    </div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>


                      <p>
                        <?= $subpage->Text()->blocks()->excerpt(250)   ?>
                      </p>

                      <a href="<?= $subpage->url() ?>" class="card-link">...weiterlesen</a>

                    </div>
                  </li>

                <?php endif ?>
              <?php endforeach ?>

              <li class="timeline-item">
                <div class="timeline-info">
                  <span>1970er Jahre</span>
                </div>
                <div class="timeline-marker"></div>
                <div class="timeline-content">

                  <p>Schulbestand <strong>Anfang der 70er</strong>: fünf Grundschulen, eine Sonderschule für Lernbehinderte, drei als Grund- und Hauptschulen geführte Mittelpunktschulen sowie eine Realschule</p>
                  <p><strong>1974 </strong>lange Zeit kaum aktive Betreibung von Bildungspolitik</p>
                  <p>Reformklima in Rastede, Initiativgruppe diskutiert über die Gründung einer Kooperativen Gesamtschule</p>
                  <p>Gemeinderat beschließt KGS und gibt <em>grünes Licht für Neubau</em></p>

                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <hr>


      <div class="container-fluid">
        <div class="row example-centered">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
            <ul class="timeline timeline-center">

              <li class="timeline-item period">
                <div class="timeline-info"></div>
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h2 class="timeline-title pb-4">Aktuelles aus der Schule</h2>
                  <h3 class="timeline-title">[Probeversion als Zeitleiste 3... Was sieht besser aus? Gerne Rückmeldungen!]</h3>

                </div>
              </li>

              <?php $index = 0;
              foreach (page('blogs')
                ->children()
                ->flip() as $subpage) : $index++ ?>


                <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>

                  <li class="timeline-item">
                    <div class="timeline-info">
                      <span>
                        Autor <b><?= $subpage->author() ?></b>, Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                      </span>

                    </div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <a href="<?= $subpage->url() ?>"><?= $subpage->title() ?></a>


                      <p>
                        <?= $subpage->Text()->blocks()->excerpt(250)   ?>
                      </p>

                      <a href="<?= $subpage->url() ?>" class="card-link">...weiterlesen</a>

                    </div>
                  </li>

                <?php endif ?>
              <?php endforeach ?>

            </ul>
          </div>
        </div>
      </div>



      <!-- --------------------------------- -->

      <h2 class="pb-4">Aktuelles aus der Schule</h2>
      <h3>[Probeversion als Zeitleiste 4... Was sieht besser aus? Gerne Rückmeldungen!]</h3>


      <div class="container-fluid">
        <div class="timeline2">
          <div class="timeline-month">
            August 2020
            <span>3 Entries</span>
          </div>

          <?php $index = 0;
          foreach (page('blogs')
            ->children()
            ->flip() as $subpage) : $index++ ?>


            <?php if ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s')) : ?>



              <div class="timeline-section">
                <div class="timeline-date">
                  Datum: <?= $subpage->date()->toDate("d.m.Y") ?>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="timeline-box">
                      <div class="box-title">
                        <i class="fa fa-asterisk text-success" aria-hidden="true"></i><?= $subpage->title() ?>
                      </div>
                      <div class="box-content">
                        <?= $subpage->Text()->blocks()->excerpt(250)   ?>
                      </div>
                      <div class="box-footer">- <b><?= $subpage->author() ?></b></div>
                    </div>
                  </div>

                  <?php if (rand(0, 1) == 1) : ?>

                    <div class="col-sm-4">
                      <div class="timeline-box">
                        <div class="box-title">
                          <i class="fa fa-pencil text-info" aria-hidden="true"></i> PROBETEXT
                        </div>
                        <div class="box-content">
                          <a class="btn btn-xs btn-default pull-right">DEMOTEXT ZUM TESTEN VOM DESIGN</a>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati vitae numquam, quo, nam, adipisci neque reiciendis ipsum illum deleniti perferendis tempora libero! Minima qui repellendus ipsam animi nihil, modi veritatis!
                        </div>
                        <div class="box-footer">- Tyler</div>
                      </div>
                    </div>

                  <?php endif ?>

                  <?php if (rand(0, 1) == 1) : ?>

                    <div class="col-sm-4">
                      <div class="timeline-box">
                        <div class="box-title">
                          <i class="fa fa-pencil text-info" aria-hidden="true"></i> PROBETEXT
                        </div>
                        <div class="box-content">
                          <a class="btn btn-xs btn-default pull-right">DEMOTEXT ZUM TESTEN VOM DESIGN</a>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati vitae numquam, quo, nam, adipisci neque reiciendis ipsum illum deleniti perferendis tempora libero! Minima qui repellendus ipsam animi nihil, modi veritatis!
                        </div>
                        <div class="box-footer">- Tyler</div>
                      </div>
                    </div>

                  <?php endif ?>


                </div>

              </div>



            <?php endif ?>
          <?php endforeach ?>



        </div>
      </div>

      <!-- --------------------------------- -->



      <a href="<?= page("blogs") ?>">
        <button class="btn btn-secondary">Weitere Nachrichten aus der Schule &#8594;</button>
      </a>

    </div>
    <div class="col-md-3">
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