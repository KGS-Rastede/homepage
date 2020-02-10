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
            
            </div>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">school</i> &Uuml;ber die Schule
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>"><i class="material-icons">timer</i>Zeitraster</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/beratung')->url() ?>"><i class="material-icons">people_outline</i>Beratung</a>
            </div>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">subject</i>F&auml;cher
            </a>
            <div class="dropdown-menu dropdown-with-icons"> 
            <!-- Sport -->    
            <a class="dropdown-item" href="<?= page('Faecher/Sport')->url() ?>"><i class="material-icons">sports_football</i>Sport</a>
            <div class="dropdown-divider"></div>

            <!-- NTW -->
            <a class="dropdown-item" href="<?= page('Faecher/Physik')->url() ?>"><i class="material-icons">battery_charging_full</i>Physik</a>
            <a class="dropdown-item" href="<?= page('Faecher/Biologie')->url() ?>"><i class="material-icons">filter_vintage</i>Biologie</a>
            <a class="dropdown-item" href="<?= page('Faecher/Chemie')->url() ?>"><i class="material-icons">outdoor_grill</i>Chemie</a>
            <div class="dropdown-divider"></div>

            <!-- Fremdsprachen -->
            <a class="dropdown-item" href="<?= page('Faecher/franzoesisch')->url() ?>"><i class="material-icons">chat_bubble_outline</i>Französisch</a>
            <a class="dropdown-item" href="<?= page('Faecher/latein')->url() ?>"><i class="material-icons">chat_bubble_outline</i>Latein</a>
            <a class="dropdown-item" href="<?= page('Faecher/spanisch')->url() ?>"><i class="material-icons">chat_bubble_outline</i>Spanisch</a>
            <a class="dropdown-item" href="<?= page('Faecher/englisch')->url() ?>"><i class="material-icons">chat_bubble_outline</i>Englisch</a>

            
            <!-- AWT / Informatik -->
            <a class="dropdown-item" href="<?= page('Faecher/Informatik')->url() ?>"><i class="material-icons">computer</i>Informatik</a>
            <a class="dropdown-item" href="<?= page('Faecher/technik')->url() ?>"><i class="material-icons">traffic</i>Technik</a>
            <a class="dropdown-item" href="<?= page('Faecher/hauswirtschaft')->url() ?>"><i class="material-icons">emoji_food_beverage</i>Hauswirtschaft</a>
            <div class="dropdown-divider"></div>

            <!-- GSW -->
            <a class="dropdown-item" href="<?= page('Faecher/politik-wirtschaft')->url() ?>"><i class="material-icons">monetization_on</i>Politik/Wirtschaft</a>
            <a class="dropdown-item" href="<?= page('Faecher/geschichte')->url() ?>"><i class="material-icons">history</i>Geschichte</a>
            <a class="dropdown-item" href="<?= page('Faecher/erdkunde')->url() ?>"><i class="material-icons">landscape</i>Erdkunde</a>
            <a class="dropdown-item" href="<?= page('Faecher/religion')->url() ?>"><i class="material-icons">thumbs_up_down</i>Religion</a>
            <a class="dropdown-item" href="<?= page('Faecher/WuN')->url() ?>"><i class="material-icons">thumbs_up_down</i>Werte und Normen</a>
            <div class="dropdown-divider"></div>

            <!-- Mukubi -->
            <a class="dropdown-item" href="<?= page('Faecher/musik')->url() ?>"><i class="material-icons">music_note</i>Musik</a>
            <a class="dropdown-item" href="<?= page('Faecher/kunst')->url() ?>"><i class="material-icons">photo</i>Kunst</a>
            <div class="dropdown-divider"></div>

            <!-- Mathematik -->
            <a class="dropdown-item" href="<?= page('Faecher/Mathematik')->url() ?>"><i class="material-icons">add</i>Mathematik</a>

            
            

            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>