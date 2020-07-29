<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <!-- 
          Hier kann das Logo stehen oder der Name der Schule.
          Müssen wir am Ende vom Design her entscheiden.      
        -->

  <div class="container">
    <a class="navbar-brand" href="<?= $site->url() ?>">
      <img src="<?= $kirby->url('assets') ?>/logo-kgs-mini.jpg" loading="lazy">
    </a>
  </div>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people" />
          </svg> Kontakt
        </a>

        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('allgemeines/anfahrt')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#geo-alt" />
            </svg> Anfahrt
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>#haus">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tools" />
            </svg> Hausmeister
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/schulleitung')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#person-circle" />
            </svg> Schulleitung
          </a>
          <a class="dropdown-item" href="<?= page('kontakte/fbl')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#person-square" />
            </svg> Fachbereichsleiter
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>#sek">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#telephone-fill" />
            </svg> Sekretariate
          </a>

          <a class="dropdown-item" href="<?= page('lehrer')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#person-lines-fill" />
            </svg> Kollegium
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('sv/die_sv')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people-fill" />
            </svg> Schülervertretung (SV)
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/spr')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#briefcase-fill" />
            </svg> Personalrat (SPR)
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/gleichstellung')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#person-fill" />
            </svg> Gleichstellungsbeauftragte
          </a>

          <a class="dropdown-item" href="<?= page('ser/vorstand')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people-fill" />
            </svg> Schulelternrat (SER)
          </a>

          <a class="dropdown-item" href="<?= page('foerderverein/vorstand')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags-fill" />
            </svg> Förderverein
          </a>
        </div>
      </li>

      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#building" />
          </svg> &Uuml;ber die Schule
        </a>
        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/bus')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#truck" />
            </svg> Schulbusverkehr
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#clock" />
            </svg> Zeitraster
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/presse')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#newspaper" />
            </svg> ...aus der Presse
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/ausbildungsschule')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#award" />
            </svg> Ausbildungsschule
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/inklusion')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Inklusion
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('allgemeines/grundschule')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#box-arrow-right" />
            </svg> Übergang Grundschule/KGS
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('allgemeines/beratung')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-dots" />
            </svg> Beratung
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('allgemeines/zweige')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#list-ol" />
            </svg> Die drei Schulzweige
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('allgemeines/konzepte')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#layout-wtf" />
            </svg> Pädagogische Konzepte
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/geschichte')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#book" />
            </svg> Unsere Geschichte
          </a>

        </div>
      </li>
      <li class="dropdown nav-item">
        <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#calendar2" />
          </svg> Kalender
        </a>
      </li>

      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#easel" />
          </svg> Unterricht &amp; Schulleben
        </a>
        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('allgemeines/ssd')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people" />
            </svg> Schulsanitätsdienst
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= page('Faecher')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#journals" />
            </svg> Fächer
          </a>
          <a class="dropdown-item" href="<?= page('allgemeines/oberstufe')->url() ?>">
            <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#subtract" />
            </svg> Oberstufe
          </a>

        </div>

      </li>
    </ul>
  </div>

</nav>