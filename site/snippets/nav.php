<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!--
          Hier kann das Logo stehen oder der Name der Schule.
          Müssen wir am Ende vom Design her entscheiden.
        -->
  <div class="d-none d-sm-none d-lg-block d-xl-block">
    <a class="logo" href="<?= $site->url() ?>">
      <?= asset('assets/bilder/logo.svg')->read() ?>
    </a>
  </div>
  <a class="navbar-brand d-block d-sm-block d-lg-none text-white" href="<?= $site->url() ?>">KGS Rastede</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mr-3 mb-lg-0 ">
      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          Kontakt
        </a>

        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('allgemeines/anfahrt')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#geo-alt" />
            </svg> Anfahrt
          </a>

          <div class="dropdown-divider"></div>
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

          <a class="dropdown-item" href="<?= page('lehrer')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#person-lines-fill" />
            </svg> Kollegium
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>#sekr">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#telephone-fill" />
            </svg> Sekretariate
          </a>

          <a class="dropdown-item" href="<?= page('kontakte/sekretariate')->url() ?>#haus">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tools" />
            </svg> Hausmeister
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

          <a class="dropdown-item" href="<?= page('foerderverein/ueber_uns')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags-fill" />
            </svg> Förderverein
          </a>
        </div>
      </li>

      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          &Uuml;ber die Schule
        </a>
        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('schule/leitbild')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#layout-wtf" />
            </svg> Leitbild
          </a>

          <a class="dropdown-item" href="<?= page('schule/schulprogramm')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#layout-wtf" />
            </svg> Schulprogramm
          </a>

          <a class="dropdown-item" href="<?= page('schule/geschichte')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#book" />
            </svg> Unsere Geschichte
          </a>


          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('schule/grundschule')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#box-arrow-right" />
            </svg> Übergang Grundschule/KGS
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('schule/zweige')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#list-ol" />
            </svg> Die drei Schulzweige
          </a>

          <a class="dropdown-item" href="<?= page('schule/oberstufe')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#subtract" />
            </svg> Oberstufe
          </a>


          <a class="dropdown-item" href="<?= page('schule/abschluesse')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#subtract" />
            </svg> Abschlüsse an der KGS
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('schule/organigramm')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#list-ol" />
            </svg> Zuständigkeiten / Organigramm
          </a>


          <div class="dropdown-divider"></div>


          <a class="dropdown-item" href="<?= page('schule/ausbildungsschule')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#award" />
            </svg> Ausbildungsschule
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('schule/presse')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#newspaper" />
            </svg> Unsere Schule in der Presse
          </a>
        </div>
      </li>

      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          Unterricht &amp; Schulleben
        </a>
        <div class="dropdown-menu dropdown-with-icons">

          <a class="dropdown-item" href="<?= page('Faecher')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#journals" />
            </svg> Fächer
          </a>



          <a class="dropdown-item" href="<?= page('unterricht/berufsorientierung')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Berufsorientierung
          </a>


          <a class="dropdown-item" href="<?= page('unterricht/schuelerfirmen')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#journals" />
            </svg> Schülerfirmen
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/beratung')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#chat-dots" />
            </svg> Beratung
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/inklusion')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Inklusion
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('unterricht/kulturelles')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Kulturelles
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/wettbewerbe')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Wettbewerbe
          </a>


          <a class="dropdown-item" href="<?= page('unterricht/ag-angebot')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Das AG-Angebot
          </a>


          <a class="dropdown-item" href="<?= page('unterricht/schule-ohne-rassismus-schule-mit-courage')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Schule ohne Rassismus - Schule mit Courage
          </a>



          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="<?= page('unterricht/ssd')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people" />
            </svg> Schulsanitätsdienst
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/bo-coaches')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> BO-Coaches
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/schulhund')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Schulhund
          </a>


          <a class="dropdown-item" href="<?= page('unterricht/streitschlichter')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#door-open" />
            </svg> Streitschlichter
          </a>

          <a class="dropdown-item" href="<?= page('unterricht/ag-frieden')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#peace" />
            </svg> AG für den Frieden
          </a>


        </div>

      </li>

      <li class="dropdown nav-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          Service &amp; Downloads
        </a>
        <div class="dropdown-menu dropdown-with-icons">
          <a class="dropdown-item" href="<?= page('allgemeines/wichtigelinks')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#journals" />
            </svg> Informationen und Formulare
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/bus')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#truck" />
            </svg> Schulbusverkehr
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/zeitraster')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#clock" />
            </svg> Zeitraster
          </a>

          <a class="dropdown-item" href="<?= page('allgemeines/schulbuchlisten')->url() ?>">
            <svg class="bi" width="24" height="24">
              <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#book" />
            </svg> Schulbuchlisten
          </a>
      </li>

      <li class="dropdown nav-item">
        <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>">
          Kalender
        </a>
      </li>

    </ul>
  </div>
</nav>