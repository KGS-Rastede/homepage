<nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="<?= $site->url() ?> ">
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
              <i class="material-icons">school</i> &Uuml;ber die Schule
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('kontakte/hausmeister')->url() ?>"><i class="material-icons">directions_car</i>Anfahrt</a>
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>"><i class="material-icons">timer</i>Zeitraster</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('kontakte/hausmeister')->url() ?>"><i class="material-icons">build</i>Hausmeister</a>
            <a class="dropdown-item" href="<?= page('kontakte/schulleitung')->url() ?>"><i class="material-icons">school</i>Schuleitung</a>
            <a class="dropdown-item" href="<?= page('kontakte/fbl')->url() ?>"><i class="material-icons">face</i>Fachbereichsleiter</a>
            <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>"><i class="material-icons">people</i>Sekretariate</a>
            
            </div>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">subject</i> &Uuml;ber die F&auml;cher
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('Faecher/Sport')->url() ?>"><i class="material-icons">sports_football</i>Sport</a>
            <a class="dropdown-item" href="<?= page('Faecher/Physik')->url() ?>"><i class="material-icons">battery_charging_full</i>Physik</a>
            <a class="dropdown-item" href="<?= page('Faecher/Biologie')->url() ?>"><i class="material-icons">filter_vintage</i>Biologie</a>
            <a class="dropdown-item" href="<?= page('Faecher/Chemie')->url() ?>"><i class="material-icons">outdoor_grill</i>Chemie</a>
            <a class="dropdown-item" href="<?= page('Faecher/Informatik')->url() ?>"><i class="material-icons">computer</i>Informatik</a>

            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>