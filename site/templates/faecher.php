<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="card-columns">
  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Fremdsprachen</h3>
      <h4 class="card-title">Fachbereichsleiter: Frau Backhaus</h4>
      <div class="list-group text-white">
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Englisch</a></li>
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Französisch</a></li>
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Spanisch</a></li>
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Latein</a></li>
      </div>
    </div>
  </div>
  <!--KULTURELL-->
  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Musisch-Kultureller Bereich</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Schneemann</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">music_note</i>Musik</a></li>
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">color_lens</i>Kunst</a></li>
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">theaters</i>Darstellendes Spiel</a></li>
        <a href="<?= page('Faecher/tg')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">domain</i>Textiles Gestalten</a></li>
        <a href="<?= page('Faecher/werken')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">gavel</i>Gestaltendes Werken</a></li>
      </div>
    </div>
  </div>

  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Mathematik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Mönnich</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">exposure</i>Mathematik</a>
      </div>
    </div>
  </div>

  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Sport</h3>
      <h4 class="card-title">Fachbereichsleiter: Frau Müller-Pulsfort</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">directions_run</i>Sport</a></li>
      </div>
    </div>
  </div>


  <div class="card text-white bg-info  mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Deutsch</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Schumacher</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/deutsch')->url() ?>" class="list-group-item list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-dots.svg" alt="" width="32" height="32">Deutsch</a></li>
        <a href="<?= page('Faecher/deutsch-als-zweitsprache-daz')->url() ?>" class="list-group-item list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-square-dots.svg" alt="" width="32" height="32">Deutsch als Zweitsprache</a></li>
      </div>
    </div>
  </div>


  <!--NTW-->
  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Naturwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Dr. Fach</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">emoji_objects</i>Physik</a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">eco</i>Biologie</a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">warning</i>Chemie</a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">computer</i>Informatik</a>
      </div>
    </div>
  </div>

  <!--AWT-->
  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Arbeit-Wirtschaft-Technik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Henken</h4>
      <div class="list-group">
        <a href="<?= page('allgemeines/schulstruktur/schuelerfirmen')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">gavel</i>Schülerfirmen</a></li>
        <a href="<?= page('Faecher/wirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">show_chart</i>Wirtschaft</a></li>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">build</i>Technik</a>
        <a href="<?= page('Faecher/hauswirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">local_dining</i>Hauswirtschaft</a>

      </div>
    </div>
  </div>
  <!--GSW-->
  <div class="card text-white bg-info mb-3">
    <div class="card-body">
      <h3 class="card-category card-title text-warning">Sozialwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Meyer</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">today</i>Geschichte</a></li>
        <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">show_chart</i>Politik / Politik-Wirtschaft</a></li>
        <a href="<?= page('Faecher/erdkunde')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">public</i>Erdkunde</a></li>
        <a href="<?= page('Faecher/religion')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">menu_book</i>Religion</a></li>
        <a href="<?= page('Faecher/WuN')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">book</i>Werte und Normen</a></li>
      </div>
    </div>
  </div>
</div>


<?php snippet('footer') ?>