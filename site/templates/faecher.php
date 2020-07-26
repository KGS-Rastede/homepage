<?php snippet('header') ?>

<?php snippet('page-header') ?>

<!--SPRACHEN-->
<div class="row row-cols-1 row-cols-md-2 g-4">

  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('fremdsprachen.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-title blockqoute mb-3 text-warning">Fremdsprachen</h3>
      <h3 class="card-title blockquote-footer">Fachbereichsleiterin: Frau Backhaus</h3>
      <div class="list-group text-white">
        <a href="<?= page('Faecher/englisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
        <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-square" />
          </svg> Englisch
        </a></li>
        <a href="<?= page('Faecher/franzoesisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
        <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-left-dots" />
          </svg> Französisch
        </a></li>
        <a href="<?= page('Faecher/spanisch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
        <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-quote" />
          </svg> Spanisch
        </a></li>
        <a href="<?= page('Faecher/latein')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
        <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-left" />
          </svg> Latein
        </a></li>
      </div>
    </div>
  </div>

  <!--KULTURELL-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('mukubi.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Musisch-Kultureller Bereich</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiter: Herr Schneemann</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/musik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/music-note-beamed.svg"> Musik
        </a></li>
        <a href="<?= page('Faecher/kunst')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/brush.svg"> Kunst
        </a></li>
        <a href="<?= page('Faecher/ds')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/file-person.svg"> Darstellendes Spiel
        </a></li>
        <a href="<?= page('Faecher/tg')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/bezier.svg"> Textiles Gestalten
        </a></li>
        <a href="<?= page('Faecher/werken')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/hammer.svg"> Gestaltendes Werken
        </a></li>
      </div>
    </div>

  </div>

  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('mathe.jpg')->url() ?>" class="card-img" alt="Mathematik">

      <h3 class="card-category card-title mb-3 text-warning">Mathematik</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiter: Herr Mönnich</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Mathematik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">

          <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#calculator" />
          </svg> Mathematik
        </a>
      </div>
    </div>

  </div>

  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('sport.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Sport</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiterin: Frau Müller-Pulsfort</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Sport')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#globe" />
          </svg> Sport
        </a>
        </li>
      </div>
    </div>

  </div>


  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('deutsch.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Deutsch</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiterin: Frau Wohltmann (komm.)</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/deutsch')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-dots" />
          </svg>Deutsch
        </a>
        </li>
        <a href="<?= page('Faecher/deutsch-als-zweitsprache-daz')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <svg class="bi" width="32" height="32">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-square-dots" />
          </svg> Deutsch als Zweitsprache
        </a>
        </li>
      </div>
    </div>

  </div>


  <!--NTW-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('ntw.jpg')->url() ?>" class="card-img" alt="Naturwissenschaften">

      <h3 class="card-category card-title mb-3 text-warning">Naturwissenschaften</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiter: Herr Dr. Fach</h4>

      <div class="list-group">
        <a href="<?= page('Faecher/Physik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/plug.svg"> Physik
        </a>
        <a href="<?= page('Faecher/Biologie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/flower1.svg"> Biologie
        </a>
        <a href="<?= page('Faecher/Chemie')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/droplet-half.svg"> Chemie
        </a>
        <a href="<?= page('Faecher/informatik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/terminal.svg"> Informatik
        </a>
      </div>
    </div>
  </div>

  <!--AWT-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('awt.jpg')->url() ?>" class="card-img" alt="AWT">

      <h3 class="card-category card-title mb-3 text-warning">Arbeit-Wirtschaft-Technik</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiter: Herr Henken</h4>
      <div class="list-group">
        <a href="<?= page('allgemeines/schulstruktur/schuelerfirmen')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/wallet2.svg"> Schülerfirmen
        </a></li>
        <a href="<?= page('Faecher/wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/cash-stack.svg"> Wirtschaft
        </a></li>
        <a href="<?= page('Faecher/technik')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/screwdriver.svg"> Technik
        </a>
        <a href="<?= page('Faecher/hauswirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/basket.svg"> Hauswirtschaft
        </a>

      </div>
    </div>
  </div>


  <!--GSW-->
  <div class="card bg-primary mb-3">
    <div class="card-body">
      <img src="<?= $page->files()->find('sozi.jpg')->url() ?>" class="card-img" alt="Fremdsprachen">

      <h3 class="card-category card-title mb-3 text-warning">Sozialwissenschaften</h3>
      <h4 class="card-title blockquote-footer">Fachbereichsleiter: Herr Meyer</h4>
      <div class="list-group">
        <a href="<?= page('Faecher/geschichte')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/clock-history.svg"> Geschichte
        </a></li>
        <a href="<?= page('Faecher/politik-wirtschaft')->url() ?>" class="list-group-item list-group-item-light list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/graph-up.svg"> Politik / Politik-Wirtschaft
        </a></li>
        <a href="<?= page('Faecher/erdkunde')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/geo.svg"> Erdkunde
        </a></li>
        <a href="<?= page('Faecher/religion')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/Signpost-split.svg"> Religion
        </a></li>
        <a href="<?= page('Faecher/WuN')->url() ?>" class="list-group-item list-group-item-light  list-group-item-action">
          <img src="<?= $kirby->url('assets') ?>/icons/diagram-2-fill.svg"> Werte und Normen
        </a></li>
      </div>
    </div>
  </div>



</div>


<?php snippet('footer') ?>