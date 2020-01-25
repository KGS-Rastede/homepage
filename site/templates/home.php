<?php snippet('header') ?>




<div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= $kirby->url('assets') ?>/img/bg3.jpg')">
  <div class="container">
    <div class="row">
      <div class="col-md-8 ml-auto mr-auto">
        <div class="brand text-center">
          <h1><?= $page->title() ?></h1>
          <h3 class="title text-center">Die Schule in Rastede</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main main-raised">
  <div class="container">
    <div class="section text-center">


      <!-- -->

      <div class="blogs-1" id="blogs-1">
        <div class="container">
          <div class="row">
            <div class="col-md-10 ml-auto mr-auto">
              <h2 class="title">Latest Blogposts</h2>
              <br>

              <!--  
              Jetzt werden die Elemente angefügt. 
              -->

              <div class="card card-plain card-blog">
                <div class="row">

                <!-- der ersten beiden Zeilen sind immer gleich -->


                <?php foreach (page('blogs')->children()->filterBy('featured', true) as $subpage) : ?>
      


                  <div class="col-md-5">
                    <div class="card-header card-header-image">
                      <?php if ($subpage->hasImages() > 0) : ?>
                        <img src="<?= $subpage->images()->first()->url() ?>" class="card-img" alt="<?= $subpage->images()->first()->alt() ?>">
                      <?php else : ?>
                        <img src="<?= $kirby->url('assets') ?>/logo-kgs.jpg" class="card-img" alt="Logo der KGS">
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h6 class="card-category text-info">Enterprise</h6>
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

                  <?php endforeach ?>

                  <!-- der letzten beiden Zeilen sind immer gleich -->
                </div>
              </div>


              <!--  -->



              <div class="card card-plain card-blog">
                <div class="row">
                  <div class="col-md-7">
                    <h3 class="card-title">
                      <a href="#pablo">6 insights into the French Fashion landscape</a>
                    </h3>
                    <p class="card-description">
                      Like so many organizations these days, Autodesk is a company in transition. It was until recently a traditional boxed software company selling licenses. Today, it’s moving to a subscription model. Yet its own business model disruption is only part of the story — and…
                      <a href="#pablo"> Read More </a>
                    </p>
                    <p class="author">
                      by
                      <a href="#pablo">
                        <b>Mike Butcher</b>
                      </a>, 2 days ago
                    </p>
                  </div>
                  <div class="col-md-5">
                    <div class="card-header card-header-image">
                      <img class="img img-raised" src="./assets/img/office2.jpg">
                    </div>
                  </div>
                </div>
              </div>
 
              <!--  -->

            </div>
          </div>
        </div>
      </div>

      <!--  -->




    </div>
  </div>
</div>


<?php snippet('footer') ?>