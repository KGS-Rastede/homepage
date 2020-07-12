<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Fremdsprachen</h3>
      <h4 class="card-title">Fachbereichsleiterin: Frau Backhaus</h4>
      <div class="list-group text-white">
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Englisch</a></li>
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Französisch</a></li>
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Spanisch</a></li>
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Latein</a></li>
      </div>
    </div>
  </div>
  <!--KULTURELL-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Musisch-Kultureller Bereich</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Schneemann</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Musik</a></li>
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Kunst</a></li>
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Darstellendes Spiel</a></li>
        <a href="<?= page('Faecher/tg')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Textiles Gestalten</a></li>
        <a href="<?= page('Faecher/werken')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Gestaltendes Werken</a></li>
      </div>
    </div>
  </div>

  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Mathematik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Mönnich</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/table.svg">Mathematik</a>
      </div>
    </div>
  </div>

  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Sport</h3>
      <h4 class="card-title">Fachbereichsleiterin: Frau Müller-Pulsfort</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Sport</a></li>
      </div>
    </div>
  </div>


  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Deutsch</h3>
      <h4 class="card-title">Fachbereichsleiterin: Frau Wohltmann (komm.)</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/deutsch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-dots.svg">Deutsch</a></li>
        <a href="<?= page('Faecher/deutsch-als-zweitsprache-daz')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-square-dots.svg">Deutsch als Zweitsprache</a></li>
      </div>
    </div>
  </div>


  <!--NTW-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Naturwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Dr. Fach</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/plug.svg">Physik</a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/droplet.svg">Biologie</a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Chemie</a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/laptop.svg">Informatik</a>
      </div>
    </div>
  </div>

  <!--AWT-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Arbeit-Wirtschaft-Technik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Henken</h4>
      <div class="list-group">
        <a href="<?= page('allgemeines/schulstruktur/schuelerfirmen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Schülerfirmen</a></li>
        <a href="<?= page('Faecher/wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Wirtschaft</a></li>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/hammer.svg">Technik</a>
        <a href="<?= page('Faecher/hauswirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Hauswirtschaft</a>

      </div>
    </div>
  </div>
  <!--GSW-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Sozialwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Meyer</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Geschichte</a></li>
        <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Politik / Politik-Wirtschaft</a></li>
        <a href="<?= page('Faecher/erdkunde')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Erdkunde</a></li>
        <a href="<?= page('Faecher/religion')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/gem.svg">Religion</a></li>
        <a href="<?= page('Faecher/WuN')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg">Werte und Normen</a></li>
      </div>
    </div>
  </div>
</div>


<?php snippet('footer') ?>
  