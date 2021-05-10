<?php
# rki_numbers.php betrachten für weitere Informationen
# Find your region here and get the OBJECTID: 
# https://npgeo-corona-npgeo-de.hub.arcgis.com/datasets/917fc37a709542548cc3be077a786c17_0

snippet('src/rki_numbers');

// <<<--- Inzidenzen aufrufen --->>>
$id = 50; //Ammerland
$cache_file_local = 'assets/rki_numbers_local.json';
$incidence_local = new Incidence_local($id, $cache_file_local);

$today_local = $incidence_local->getDaily(0);

$id = 0; //Deutschland
$cache_file = 'assets/rki_numbers_brd.json';
$incidence_brd = new Incidence_brd($id, $cache_file, $cache_file_local);

$today_brd = $incidence_brd->getDaily(0);

// <<<--- Variablen festlegen --->>>
$loaded = false;
if (isset($today_local) && isset($today_brd)) { //Wenn die Daten nicht leer sind
  $name_landkreis =  $today_local['GEN'];
  $incidence_landkreis = round($today_local['cases7_per_100k'], 2);
  $name_bundesland = $today_local['BL'];
  $incidence_bundesland = round($today_local['cases7_bl_per_100k'], 2);
  $incidence_brd =  round($today_brd['Inz7T'], 2);
  $datum_daten =  str_replace(', 00:00 Uhr', '', $today_local['last_update'], );
  $loaded = true;
}

// <<<--- Festellen, ob Daten aktuell --->>>
$day = new DateTime("today");
$date_key = $day->format('Ymd');

$date_numbers = DateTime::createFromFormat("d.m.Y, H:i", str_replace(" Uhr", "", $today_local['last_update']));
$numbers_key = $date_numbers->format("Ymd");

if ($date_key == $numbers_key) 
  $uptodate = true;
else
  $uptodate = false;

?>

<div class="table-responsive">
  <table class="table">
    <thead>
      <th>Name</th>
      <th>Quarantäne</th>
      <th>davon infiziert</th>
    </thead>
    <tbody>
      <?php foreach ($coronapage->children() as $l) : ?>
        <tr>
          <td>
            <?= $l->name() ?>
          </td>
          <td>
            <?= $l->quarantaene() ?>

          </td>
          <td>
            <?= $l->infiziert() ?>
          </td>
        </tr>
      <?php endforeach ?>
      <tr>
        <td colspan="3">
          <table class="table table-borderless mb-0">
            <tbody>

            <td colspan="3" class="fs-3 text-center">Inzidenzen</td>

              <?php if ($loaded) : //Wenn die Daten nicht leer sind ?> 
                <tr>
                  <th>
                    <?= $name_landkreis . ": " . $incidence_landkreis ?>
                  </th>
                  <th>
                    <?= $name_bundesland . ": " . $incidence_bundesland ?>
                  </th>
                  <th>
                    <?= "Deutschland: " . $incidence_brd ?>
                  </th>
                </tr>

                <td colspan="3" class="fs-6">Inzidenzen (RKI, Stand: 

                  <?php if($uptodate) { //Wenn die Inzidenzen nicth aktuell sind soll das Datum rot sein
                    echo $datum_daten . ')';
                   }else {
                    echo '<span class="text-danger">' . $datum_daten  . '</span>)';
                   }
                  ?>

                </td>
              <?php else : //Wenn die Daten leer sind ?>
                <tr><th>Es konnten keine Inzidenzen geladen werden!</th></tr>
              <?php endif ?>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</div>