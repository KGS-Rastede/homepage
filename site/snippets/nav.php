<?php 
/* 
--Navbar--
Doc zur class navbar: https://v5.getbootstrap.com/docs/5.0/components/navbar/
Verfügbare icons: https://icons.getbootstrap.com/

--Erklärung der Arrays--
$titel = name
  name -> Name der Kategorie die Angezeigt werden soll

$items = name => link
  name -> Name der Links die in den Kategorien angezeigt werden / spezial Wörter
    Möglchkeiten für name: 
      String = Ein Item mit diesem Displaynamen und link wird eingefügt
      "trenn" = Ein Trennstrich wird eingeüfgt
      "spalte_anfang" = Es wird ein neuer Menüpunkt (Spalte) eingefügt
      "spalte_ende" = Makiert das Ende eines Menüpunktes (Spalte)
  link -> der zugehörige Link

$icons = name => icon_name  
  name -> ist nicht unbedingt nötig und dient nur zur Übersicht
  icon_name -> der name des icons z.B. "alarm-fill"
*/

$titel = array(
  "Kontakt", "Über die Schule", "Unterricht & Schulleben", "Service & Downloads"
);
$items = array(
  "spalte_anfang" => "",
  "Anfahrt" => "allgemeines/anfahrt",
  "Schulleitung" => "kontakte/schulleitung",
  "Fachbereichsleiter" => "kontakte/fbl",
  "Kollegium" => "lehrer",
  "Sekretariate" => "kontakte/sekretariate",
  "Hausmeister" => "kontakte/sekretariate",
  "Schülervertretung (SV)"  => "sv/die_sv",
  "Personalrat (SPR)" => "kontakte/spr",
  "Gleichstellungsbeauftragte" => "kontakte/gleichstellung",
  "Schulelternrat (SER)" => "ser/vorstand",
  "Förderverein" => "foerderverein/ueber_uns",
  "spalte_ende" => "",

  "spalte_anfang" => "",
  "Leitbild" => "schule/leitbild",
  "Schulprogramm" => "schule/schulprogramm",
  "Unsere Geschichte" => "schule/geschichte",
  "Übergang Grundschule/KGS" => "schule/grundschule",
  "Die drei Schulzweige" => "schule/zweige",
  "Oberstufe" => "schule/oberstufe",
  "Abschlüsse an der KGS" => "schule/abschluesse",
  "Zuständigkeiten / Organigramm" => "schule/organigramm",
  "Ausbildungsschule" => "schule/ausbildungsschule",
  "Unsere Schule in der Presse" => "schule/presse",
  "spalte_ende" => "",

  "spalte_anfang" => "",
  "Fächer" => "Faecher",
  "Berufsorientierung" => "unterricht/berufsorientierung",
  "Schülerfirmen" => "unterricht/schuelerfirmen",
  "Beratung" => "unterricht/beratung",
  "Inklusion" => "unterricht/inklusion",
  "Kulturelles" => "unterricht/kulturelles",
  "Wettbewerbe" => "unterricht/wettbewerbe",
  "Das AG-Angebot" => "unterricht/ag-angebot",
  "Schule ohne Rassismus - Schule mit Courage" => "unterricht/schule-ohne-rassismus-schule-mit-courage",
  "Schulsanitätsdienst" => "unterricht/ssd",
  "BO-Coaches" => "unterricht/bo-coaches",
  "Schulhund" => "unterricht/schulhund",
  "Streitschlichter" => "unterricht/streitschlichter",
  "spalte_ende" => "",

  "spalte_anfang" => "",
  "Informationen und Formulare" => "allgemeines/wichtigelinks",
  "Schulbusverkehr" => "allgemeines/bus",
  "Zeitraster" => "allgemeines/zeitraster",
  "spalte_ende" => ""

);
$icons = array(

  "spalte_anfang",
  "Anfahrt" => "geo-alt",
  "Schulleitung" => "person-circle",
  "Fachbereichsleiter" => "person-square",
  "Kollegium" => "person-lines-fill",
  "Sekretariate" => "telephone-fill",
  "Hausmeister" => "tools",
  "Schülervertretung (SV)"  => "people-fill",
  "Personalrat (SPR)" => "briefcase-fill",
  "Gleichstellungsbeauftragte" => "person-fill",
  "Schulelternrat (SER)" => "people-fill",
  "Förderverein" => "tags-fill",
  "spalte_ende",

  "spalte_anfang",
  "Leitbild" => "layout-wtf",
  "Schulprogramm" => "layout-wtf",
  "Unsere Geschichte" => "book",
  "Übergang Grundschule/KGS" => "box-arrow-right",
  "Die drei Schulzweige" => "list-ol",
  "Oberstufe" => "subtract",
  "Abschlüsse an der KGS" => "subtract",
  "Zuständigkeiten / Organigramm" => "list-ol",
  "Ausbildungsschule" => "award",
  "Unsere Schule in der Presse" => "newspaper",
  "spalte_ende",

  "spalte_anfang",
  "Fächer" => "journals",
  "Berufsorientierung" => "door-open",
  "Schülerfirmen" => "journals",
  "Beratung" => "chat-dots",
  "Inklusion" => "door-open",
  "Kulturelles" => "door-open",
  "Wettbewerbe" => "door-open",
  "Das AG-Angebot" => "door-open",
  "Schule ohne Rassismus - Schule mit Courage" => "door-open",
  "Schulsanitätsdienst" => "people",
  "BO-Coaches" => "door-open",
  "Schulhund" => "door-open",
  "Streitschlichter" => "door-open",
  "spalte_ende",

  "spalte_anfang",
  "Informationen und Formulare" => "journals",
  "Schulbusverkehr" => "truck",
  "Zeitraster" => "clock",
  "spalte_ende"
);
$titel_count = -1;
$icons_count = 0;

//Nachfolgend wird die Grundstruktur für die Navbar erstellt
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-secondary">
  <!--
          Hier kann das Logo stehen oder der Name der Schule.
          Müssen wir am Ende vom Design her entscheiden.
        -->
  <div class="d-none d-sm-none d-lg-block d-xl-block">
    <a class="logo" href="<?= $site->url() ?>">
      <?= asset('assets/bilder/logo.svg')->read() ?>
    </a>
  </div>

  <a class="navbar-brand text-white d-block d-sm-block d-lg-none" href="<?= $site->url() ?>">KGS Rastede</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mr-3 mb-lg-0 ">


      <?php  foreach($items as $name => $link) : $titel_count++; //Ab hier werden die Arrays durchlaufen und alle Elemente werden in die navbar eingefügt
      
        if (strcmp ($name, "spalte_anfang") == 0) : echo strcmp ($name, "spalte_anfang");//Anfang einer Spalte ?>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <?= $titel[$titel_count] ?>
            </a>

            <div class="dropdown-menu dropdown-with-icons">

        <?php elseif (strcmp ($name, "spalte_ende") == 0) : //Ende einer Spalte ?>
            </div>
          </li>    

        <?php elseif (strcmp ($name, "trenn") == 0) : //Ein Trennstrich zwischen zwei Elementen ?>
              <div class="dropdown-divider"></div>

        <?php else : //Die Elemente bzw. links ?>
              <a class="dropdown-item" href="<?= page($link)->url() ?>">
                <svg class="bi" width="24" height="24">
                  <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#<?= $icons[$name] ?>" />
                </svg> <?= $name ?>
              </a>

        <?php endif;
      endforeach ?>

    </ul>
  </div>
</nav> 




<?php  /*Ab hier kommt der alte code für die navbar  ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-secondary">
  <!--
          Hier kann das Logo stehen oder der Name der Schule.
          Müssen wir am Ende vom Design her entscheiden.
        -->
  <div class="d-none d-sm-none d-lg-block d-xl-block">
    <a class="logo" href="<?= $site->url() ?>">
      <?= asset('assets/bilder/logo.svg')->read() ?>
    </a>
  </div>
  <a class="navbar-brand text-white d-block d-sm-block d-lg-none" href="<?= $site->url() ?>">KGS Rastede</a>
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
      </li>

      <li class="dropdown nav-item">
        <a class="nav-link" href="<?= page('allgemeines/kalender')->url() ?>">
          Kalender
        </a>
      </li>


  </div>


</nav> 
*/ ?>