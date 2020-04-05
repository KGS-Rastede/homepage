<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="card-columns">
  <div class="card">
    <div class="card-header card-header-danger">
      <h4 class="card-title">Sprachen</h4>
      <p class="category">Fachbereichsleiterin: Frau Backhaus (<a href="mailto:bc@kgs-rastede.de">BC</a>)</p>
    </div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Englisch</a></li>
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Französisch</a></li>
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Spanisch</a></li>
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Latein</a></li>
      </div>
    </div>
  </div>
  <!--KULTURELL-->
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">Musisch-Kultureller Bereich</h4>
      <p class="category">Fachbereichsleiter: Herr Schneemann (<a href="mailto:scm@kgs-rastede.de">SCM</a>)</p>
    </div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">music_note</i>Musik</a></li>
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">color_lens</i>Kunst</a></li>
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">theaters</i>Darstellendes Spiel</a></li>
        <a href="<?= page('Faecher/tg')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">domain</i>Textiles Gestalten</a></li>
        <a href="<?= page('Faecher/werken')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">gavel</i>Gestaltendes Werken</a></li>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-success">
      <h4 class="card-title">Mathematik</h4>
      <p class="category">Fachbereichsleiter: Herr Mönnich (<a href="mailto:mch@kgs-rastede.de">MCH</a>)</p>

    </div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">exposure</i>Mathematik</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-success">
      <h4 class="card-title">Sport</h4>
      <p class="category">Fachbereichsleiterin: Frau Müller-Pulsfort (<a href="mailto:mp@kgs-rastede.de">MP</a>)</p>

    </div>
    <div class="card-body">
      <div class="list-group">
      <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">directions_run</i>Sport</a></li>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header card-header-success">
      <h4 class="card-title">Deutsch</h4>
      <p class="category">Fachbereichsleiter: Herr Schumacher (<a href="mailto:sm@kgs-rastede.de">SM</a>)</p>

    </div>
    <div class="card-body">
      <div class="list-group">
      <a href="<?= page('Faecher/deutsch')->url() ?>" class="list-group-item list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-dots.svg" alt="" width="32" height="32">Deutsch</a></li>
      <a href="<?= page('Faecher/deutsch-als-zweitsprache-daz')->url() ?>" class="list-group-item list-group-item-action"><img src="<?= $kirby->url('assets') ?>/icons/chat-square-dots.svg" alt="" width="32" height="32">Deutsch als Zweitsprache</a></li>
      </div>
    </div>
  </div>


  <!--NTW-->
  <div class="card">
    <div class="card-header card-header-success">
      <h4 class="card-title">Naturwissenschaften</h4>
      <p class="category">Fachbereichsleiter: Herr Dr. Fach (<a href="mailto:fch@kgs-rastede.de">FCH</a>)</p>
    </div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">emoji_objects</i>Physik</a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">eco</i>Biologie</a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">warning</i>Chemie</a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">computer</i>Informatik</a>
      </div>
    </div>
  </div>
  <!--SPORT-->
  <div class="card">
    <div class="card-header card-header-info">
      <h4 class="card-title">Arbeit-Wirtschaft-Technik</h4>
      <p class="category">Fachbereichsleiter: Herr Henken (<a href="mailto:he@kgs-rastede.de">HE</a>)</p>
    </div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('allgemeines/schulstruktur/schuelerfirmen')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">gavel</i>Schülerfirmen</a></li>
        <a href="<?= page('Faecher/wirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">show_chart</i>Wirtschaft</a></li>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">build</i>Technik</a>
        <a href="<?= page('Faecher/hauswirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">local_dining</i>Hauswirtschaft</a>

      </div>
    </div>
  </div>
  <!--GSW-->
  <div class="card">
    <div class="card-header card-header-alert">
      <h4 class="card-title">Sozialwissenschaften</h4>
      <p class="category">Fachbereichsleiter: Herr Meyer (<a href="mailto:my@kgs-rastede.de">MY</a>)</p>

    </div>
    <div class="card-body">
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


<?php snippet('blogs', [
  'blogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Biologie', ',')
]) ?>

<?php snippet('footer') ?>