<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h1>Über die Fächer</h1>

<div class="card-group">
  <div class="card">
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
    <!-- <img src="./logo-kgs.jpg" class="card-img-top" alt="..."> -->
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