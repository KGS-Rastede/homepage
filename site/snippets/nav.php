<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="<?= $site->url() ?>">
          KGS Rastede </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <!--
        Diese Icons stehen zur Verfügung
        https://material.io/resources/icons/?icon=card_travel&style=baseline
        -->
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">people</i>Kontakt
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('allgemeines/anfahrt')->url() ?>"><i class="material-icons">directions_car</i>Anfahrt</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('kontakte/hausmeister')->url() ?>"><i class="material-icons">build</i>Hausmeister</a>
            <a class="dropdown-item" href="<?= page('kontakte/schulleitung')->url() ?>"><i class="material-icons">school</i>Schuleitung</a>
            <a class="dropdown-item" href="<?= page('kontakte/fbl')->url() ?>"><i class="material-icons">face</i>Fachbereichsleiter</a>
            <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>"><i class="material-icons">people</i>Sekretariate</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('kontakte/sv')->url() ?>"><i class="material-icons">face</i>Schülervertretung (SV)</a>
            </div>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">school</i> &Uuml;ber die Schule
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>"><i class="material-icons">timer</i>Zeitraster</a>
            <a class="dropdown-item" href="<?= page('Faecher')->url() ?>"><i class="material-icons">timer</i>Fächer</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/beratung')->url() ?>"><i class="material-icons">people_outline</i>Beratung</a>
            </div>
          </li>
          <li class="dropdown nav-item">
            <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>"><i class="material-icons">calendar_today</i>Kalender</a>
          </li>

            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>