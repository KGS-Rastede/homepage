<!doctype html>
<html lang="en">

<head>
  <title><?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?= css('assets/css/tailwind-build.css') ?>
</head>

<style>
  .topnav {
    overflow: hidden;
    background-color: #333;
  }

  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .active {
    background-color: #4CAF50;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

  .dropdown {
    float: left;
    overflow: hidden;
  }

  .dropdown .dropbtn {
    font-size: 17px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .topnav a:hover,
  .dropdown:hover .dropbtn {
    background-color: #555;
    color: white;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
    color: black;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  @media screen and (max-width: 600px) {

    .topnav a:not(:first-child),
    .dropdown .dropbtn {
      display: none;
    }

    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  @media screen and (max-width: 600px) {
    .topnav.responsive {
      position: relative;
    }

    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }

    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }

    .topnav.responsive .dropdown {
      float: none;
    }

    .topnav.responsive .dropdown-content {
      position: relative;
    }

    .topnav.responsive .dropdown .dropbtn {
      display: block;
      width: 100%;
      text-align: left;
    }
  }
</style>



<navbar>
  <div class="topnav" id="KGSMenu">
    <div class="dropdown">
      <button class="dropbtn">
        <svg class="bi" width="24" height="24">
          <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people" />
        </svg> Kontakt
      </button>
      <div class="dropdown-content">
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
    </div>
    <div class="dropdown">
      <button class="dropbtn">
        <svg class="bi" width="24" height="24">
          <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#building" />
        </svg> &Uuml;ber die Schule
      </button>
      <div class="dropdown-content">
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
    </div>
    <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>">
      <svg class="bi" width="24" height="24">
        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#calendar2" />
      </svg> Kalender
    </a>

    <div class="dropdown">
      <button class="dropbtn">
        <svg class="bi" width="24" height="24">
          <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#easel" />
        </svg>
        Unterricht und Schulleben
      </button>
      <div class="dropdown-content">
        <a class="dropdown-item" href="<?= page('allgemeines/ssd')->url() ?>">
          <svg class="bi" width="24" height="24">
            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#people" />
          </svg> Schulsanitätsdienst
        </a>
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
    </div>

    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
</navbar>

<body class="bg-gray-300">