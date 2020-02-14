<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h1>Über die Fächer</h1>
<!--Reihe1 - SPRACHEN-->
<div class="row">
  <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sprachen</h4>
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Deutsch</a></li>
            <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Englisch</a></li>
            <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Französisch</a></li>
            <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Spanisch</a></li>
            <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Latein</a></li>
          </div>
          </div>
        </div>
    </div>
<!--NTW-->
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">Mathematik und Naturwissenschaften</h4>
          <div class="list-group">
            <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">monetization_on</i>Mathe</a>
            <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Physik</a>
            <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">monetization_on</i>Biologie</a>
            <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Chemie</a>
            <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">monetization_on</i>Informatik</a>
            <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Technik</a>
            <a href="<?= page('Faecher/ntw')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">monetization_on</i>NTW</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--Reihe2 - GSW-->
<div class="row">
  <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Gesellschaftswissenschaften</h4>
          <div class="list-group">
            <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Geschichte</a></li>
            <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Politik-Wirtschaft</a></li>
            <a href="<?= page('Faecher/erdkunde')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Erdkunde</a></li>
            <a href="<?= page('Faecher/religion')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Religion</a></li>
            <a href="<?= page('Faecher/WuN')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Werte und Normen</a></li>
          </div>
          </div>
        </div>
    </div>
<!--MUKUBA-->
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">Musisch-Kultureller Bereich</h4>
        <div class="list-group">
          <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Musik</a></li>
          <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Kunst</a></li>
          <a href="#" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Darstellendes Spiel</a></li>
        </div>
        </div>
    </div>
  </div>
</div>
<!--Reihe3 - SPORT-->
<div class="row">
  <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sport</h4>
          <div class="list-group">
            <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Sport</a></li>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card-group">
  <div class="card bg-danger">
    <div class="card-body">
      <h5 class="card-title">Aufgabenfeld A</h5>
      <div class="list-group">
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">chat_bubble_outline</i>Englisch
        </a>
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">chat_bubble_outline</i>Französisch
        </a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">chat_bubble_outline</i>Spanisch
        </a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">chat_bubble_outline</i>Deutsch
        </a>
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">chat_bubble_outline</i>Latein
        </a>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Aufgabenfeld B</h5>
      <div class="list-group">
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">landscape</i>Erdkunde
        </a>
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">monetization_on</i>Politik/Wirtschaft
        </a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">history</i>Geschichte
        </a>
      </div>
    </div>
  </div>
  <div class="card">
    <!-- so könnte man hier ein hübsches Bild einfügen  -->
    <!-- <img src="./logo-kgs.jpg" class="card-img-top" alt="...">-->
    <div class="card-body">
      <h5 class="card-title">Aufgabenfeld C</h5>
      <div class="list-group">
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">computer</i>Informatik
        </a>
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">add</i>Mathematik
        </a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">outdoor_grill</i>Chemie
        </a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">filter_vintage</i>Biologie
        </a>
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action">
          <i class="material-icons">battery_charging_full</i>Physik
        </a>
      </div>
    </div>
  </div>
</div>

<?php snippet('blogs', [
  'blogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Biologie', ',')
]) ?>

<?php snippet('footer') ?>