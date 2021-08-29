<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">


  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('fremdsprachen.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-title mb-3 text-warning">Fremdsprachen</h3>
      <h3 class="card-title">Fachbereichsleiterin: Frau Backhaus</h3>
      <div class="list-group text-white">
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-square"></i> Englisch
        </a> 
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-left-dots"></i> Französisch
        </a> 
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-quote"></i> Spanisch
        </a> 
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-left"></i> Latein
        </a> 
      </div>
    </div>
  </div>

  <!--KULTURELL-->
  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('mukubi.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Musisch-Kultureller Bereich</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Schneemann</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-music-note-beamed"></i> Musik
        </a> 
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-brush"></i> Kunst
        </a> 
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-file-person"></i> Darstellendes Spiel
        </a> 
        <a href="<?= page('Faecher/tg')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-bezier"></i> Textiles Gestalten
        </a> 
        <a href="<?= page('Faecher/werken')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-hammer"></i> Gestaltendes Werken
        </a> 
      </div>
    </div>

  </div>

  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('mathe.jpg')->url() ?>" class="card-img" alt="Mathematik">

      <h3 class="card-category card-title mb-3 text-warning">Mathematik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Mönnich</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-calculator"></i> Mathematik
        </a>
      </div>
    </div>

  </div>

  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('sport.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Sport</h3>
      <h4 class="card-title">Fachbereichsleiterin: Frau Müller-Pulsfort</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-globe"></i> Sport
        </a>
      </div>
    </div>

  </div>


  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('deutsch.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Deutsch</h3>
      <h4 class="card-title">Fachbereichsleiterin: Frau Wohltmann (komm.)</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/deutsch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-dots"></i> Deutsch
        </a>
        <a href="<?= page('Faecher/deutsch-als-zweitsprache-daz')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-chat-square-dots"></i> Deutsch als Zweitsprache
        </a>
      </div>
    </div>

  </div>


  <!--NTW-->
  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('ntw.jpg')->url() ?>" class="card-img" alt="Naturwissenschaften">

      <h3 class="card-category card-title mb-3 text-warning">Naturwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Dr. Fach</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-plug"></i> Physik
        </a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-flower1"></i> Biologie
        </a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-droplet-half"></i> Chemie
        </a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-terminal"></i> Informatik
        </a>
      </div>
    </div>
  </div>

  <!--AWT-->
  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('awt.jpg')->url() ?>" class="card-img" alt="AWT">

      <h3 class="card-category card-title mb-3 text-warning">Arbeit-Wirtschaft-Technik</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Henken</h4>
      <div class="list-group">
        <a href="<?= page('unterricht/schuelerfirmen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-wallet2"></i> Schülerfirmen
        </a>
        <a href="<?= page('Faecher/wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-cash-stack"></i> Wirtschaft
        </a>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-screwdriver"></i> Technik
        </a>
        <a href="<?= page('Faecher/hauswirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-basket"></i> Hauswirtschaft
        </a>

      </div>
    </div>
  </div>


  <!--GSW-->
  <div class="card mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('sozi.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Sozialwissenschaften</h3>
      <h4 class="card-title">Fachbereichsleiter: Herr Meyer</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-clock-history"></i> Geschichte
        </a>
        <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <i class="bi bi-graph-up"></i> Politik / Politik-Wirtschaft
        </a>
        <a href="<?= page('Faecher/erdkunde')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <i class="bi bi-geo"></i> Erdkunde
        </a>
        <a href="<?= page('Faecher/religion')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <i class="bi bi-signpost-split"></i> Religion
        </a>
        <a href="<?= page('Faecher/WuN')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <i class="bi bi-diagram-2-fill"></i> Werte und Normen
        </a>
      </div>
    </div>
  </div>



</div>


<?php snippet('footer') ?>