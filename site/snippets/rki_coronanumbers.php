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


echo "
<table border='1'>
<tr><td colspan='2'>" . $today_local['GEN'] . "</td></tr>
<tr><td>7-Tage-Inzidenz</td><td>" . round($today_local['cases7_per_100k'], 2) . "</td></tr>

<tr><td colspan='2'>" . $today_local['BL'] . "</td></tr>
<tr><td>7-Tage-Inzidenz</td><td>" . round($today_local['cases7_bl_per_100k'], 2) . "</td></tr>

<tr><td>" . $today_brd['Inz7T'] . "<tr><td>
</table>";
?>