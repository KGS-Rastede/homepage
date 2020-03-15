<?php snippet('header') ?>

<?php snippet('page-header') ?>


<h1>Über die Fächer</h1>

<!--SPRACHEN-->
<div class="card-columns">
  <div class="card">
    <div class="card-header card-header-danger"><h4 class="card-title">Sprachen</h4></div>
    <div class="card-body">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Deutsch</a></li>
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Englisch</a></li>
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Französisch</a></li>
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Spanisch</a></li>
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">chat_bubble_outline</i>Latein</a></li>
        </div>
      </div>
    </div>
<!--KULTURELL-->
  <div class="card">
    <div class="card-header card-header-primary"><h4 class="card-title">Musisch-Kultureller Bereich</h4></div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">music_note</i>Musik</a></li>
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">color_lens</i>Kunst</a></li>
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">theaters</i>Darstellendes Spiel</a></li>
        </div>
      </div>
    </div>
<!--NTW-->
  <div class="card">
    <div class="card-header card-header-success"><h4 class="card-title">Mathematik und Naturwissenschaften</h4></div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">exposure</i>Mathe</a>
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">emoji_objects</i>Physik</a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">eco</i>Biologie</a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">warning</i>Chemie</a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">computer</i>Informatik</a>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">build</i>Technik</a>
        </div>
      </div>
    </div>
<!--SPORT-->
  <div class="card">
    <div class="card-header card-header-info"><h4 class="card-title">Sport</h4></div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">directions_run</i>Sport</a></li>
        </div>
      </div>
    </div>
<!--GSW-->
  <div class="card">
    <div class="card-header card-header-warning"><h4 class="card-title">Gesellschaftswissenschaften</h4></div>
    <div class="card-body">
      <div class="list-group">
        <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">today</i>Geschichte</a></li>
        <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-action"><i class="material-icons">show_chart</i>Politik-Wirtschaft</a></li>
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