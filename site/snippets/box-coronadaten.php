<?php

# Find your region here and get the OBJECTID: 
# https://npgeo-corona-npgeo-de.hub.arcgis.com/datasets/917fc37a709542548cc3be077a786c17_0

snippet('src/rki_numbers');

$id = 50; //Ammerland
$cache_file = 'assets/rki_numbers_local.json';
$incidence_local = new Incidence_local($id, $cache_file);

$today_local = $incidence_local->getDaily(0);

$id = 0; //Deutschland
$cache_file = 'assets/rki_numbers_brd.json';
$incidence_brd = new Incidence_brd($id, $cache_file);

$today_brd = $incidence_brd->getDaily(0);

$name_landkreis =  $today_local['GEN'];
$incidence_landkreis = round($today_local['cases7_per_100k'], 2);
$name_bundesland = $today_local['BL'];
$incidence_bundesland = round($today_local['cases7_bl_per_100k'], 2);
$incidence_brd =  $today_brd['Inz7T'];
?>

<div class="table-responsive">
  <table class="table">
    <thead>
      <th>Name</th>
      <th>Quarantäne</th>
      <th>Infiziert</th>
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
        <td colspan="4">
          <table class="table mb-0">
            <tbody>
              <tr>
                <th>
                  <?= $name_landkreis . ": " . $incidence_landkreis ?>
                </th>
                <th>
                  <?= $name_bundesland . ": " . $incidence_bundesland ?>
                </th>
                <th>
                  <?= $incidence_brd ?>
                </th>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</div>
