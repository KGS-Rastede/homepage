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
              <img src="<?= $kirby->url('assets') ?>/icons/people.svg">Kontakt
            </a>
            <div class="dropdown-menu dropdown-with-icons">     
            <a class="dropdown-item" href="<?= page('allgemeines/anfahrt')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Anfahrt</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('kontakte/hausmeister')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Hausmeister</a>
            <a class="dropdown-item" href="<?= page('kontakte/schulleitung')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Schulleitung</a>
            <a class="dropdown-item" href="<?= page('kontakte/fbl')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Fachbereichsleiter</a>
            <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Sekretariate</a>
            <a class="dropdown-item" href="<?= page('lehrer')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">das Kollegium</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('sv/die_sv')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Schülervertretung (SV)</a>
            <a class="dropdown-item" href="<?= page('kontakte/spr')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Personalrat (SPR)</a>
            <a class="dropdown-item" href="<?= page('ser/vorstand')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Schulelternrat (SER)</a>  
          </div>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <img src="<?= $kirby->url('assets') ?>/icons/house.svg"> &Uuml;ber die Schule
            </a>
            <div class="dropdown-menu dropdown-with-icons">    
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/bus')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Schulbusverkehr</a>
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/zeitraster')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Zeitraster</a>
            <a class="dropdown-item" href="<?= page('allgemeines/schulstruktur/presse')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">...aus der Presse</a>
            <a class="dropdown-item" href="<?= page('allgemeines/ausbildungsschule')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Ausbildungsschule</a>
            <a class="dropdown-item" href="<?= page('allgemeines/inklusion')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Inklusion</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/grundschule')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Übergang Grundschule/KGS</a>


            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/beratung')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Beratung</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/zweige')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Die drei Schulzweige</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('allgemeines/konzepte')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Pädagogische Konzepte</a>
            
            </div>
          </li>
          <li class="dropdown nav-item">
            <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/calendar.svg">Kalender</a>
          </li>

          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg"> Unterricht &amp; Schulleben
            </a>
            <div class="dropdown-menu dropdown-with-icons">    
            <a class="dropdown-item" href="<?= page('allgemeines/ssd')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Schulsanitätsdienst</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= page('Faecher')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Fächer</a>
            <a class="dropdown-item" href="<?= page('allgemeines/oberstufe')->url() ?>"><img src="<?= $kirby->url('assets') ?>/icons/people-fill.svg">Oberstufe</a>



          </div>

          </li>


            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>