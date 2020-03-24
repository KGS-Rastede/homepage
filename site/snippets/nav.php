<nav class="navbar fixed-top navbar-expand-lg id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <!-- 
          Hier kann das Logo stehen oder der Name der Schule.
          Müssen wir am Ende vom Design her entscheiden.      
        -->
        <a class="navbar-brand" href="<?= $site->url() ?>">
          <div class="logo-image">
            <img src="<?= $kirby->url('assets') ?>/logo-kgs-mini.jpg" class="img-fluid">        
          </div>
          <!-- KGS Rastede -->
        </a>
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
            <a class="dropdown-item" href="<?= page('lehrer')->url() ?>"><i class="material-icons">people</i>das Kollegium</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('sv/die_sv')->url() ?>"><i class="material-icons">face</i>Schülervertretung (SV)</a>
            <a class="dropdown-item" href="<?= page('kontakte/spr')->url() ?>"><i class="material-icons">face</i>Personalrat (SPR)</a>
            <a class="dropdown-item" href="<?= page('ser/vorstand')->url() ?>"><i class="material-icons">people_alt</i>Schulelternrat (SER)</a>  
          </div>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">school</i> &Uuml;ber die Schule
            </a>
            <div class="dropdown-menu dropdown-with-icons">    
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/bus')->url() ?>"><i class="material-icons">directions_bus</i>Schulbusverkehr</a>
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>"><i class="material-icons">timer</i>Zeitraster</a>
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/presse')->url() ?>"><i class="material-icons">pages</i>...aus der Presse</a>
            <a class="dropdown-item" href="<?= page('allgemeines/ausbildungsschule')->url() ?>"><i class="material-icons">school</i>Ausbildungsschule</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/beratung')->url() ?>"><i class="material-icons">people_outline</i>Beratung</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/zweige')->url() ?>"><i class="material-icons">people_outline</i>Die drei Schulzweige</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/konzepte')->url() ?>"><i class="material-icons">people_outline</i>Pädagogische Konzepte</a>
            
            </div>
          </li>
          <li class="dropdown nav-item">
            <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>"><i class="material-icons">calendar_today</i>Kalender</a>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">school</i> Unterricht &amp; Schulleben
            </a>
            <div class="dropdown-menu dropdown-with-icons">    
            <a class="dropdown-item" href="<?= page('allgemeines/ssd')->url() ?>"><i class="material-icons">local_hospital</i>Schulsanitätsdienst</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('Faecher')->url() ?>"><i class="material-icons">library_books</i>Fächer</a>
            <a class="dropdown-item" href="<?= page('allgemeines/oberstufe')->url() ?>"><i class="material-icons">library_books</i>Oberstufe</a>

          </div>

          </li>


            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>