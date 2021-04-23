<?php

# Find your region here and get the OBJECTID: 
# https://npgeo-corona-npgeo-de.hub.arcgis.com/datasets/917fc37a709542548cc3be077a786c17_0

snippet('src/rki_numbers');
$id = 50; //Ammerland
$cache_file = './data.json';
$incidence_local = new Incidence_local($id, $cache_file);

$today_local = $incidence_local->getDaily(0);
/*
$id = 0; //Deutschland
$cache_file = './rkinumbersbrd.json';
$incidence_brd = new Incidence_brd($id, $cache_file);

$today_brd = $incidence_brd->getDaily(0);


<tr><td>" . $today_brd['Inz7T'] . "<tr><td>
*/

echo "
<table border='1'>
<tr><td colspan='2'>" . $today_local['GEN'] . "</td></tr>
<tr><td>7-Tage-Inzidenz</td><td>" . round($today_local['cases7_per_100k'], 2) . "</td></tr>
<tr><td>Fälle insgesamt</td><td>" . $today_local['cases'] . "</td></tr>
<tr><td>Fälle letzte 7 Tage</td><td>" . $today_local['cases7_lk'] . "</td></tr>
<tr><td>Tote</td><td>" . $today_local['deaths'] . "</td></tr>
<tr><td colspan='2'>" . $today_local['BL'] . "</td></tr>
<tr><td>7-Tage-Inzidenz</td><td>" . round($today_local['cases7_bl_per_100k'], 2) . "</td></tr>
<tr><td>Fälle letzte 7 Tage</td><td>" . $today_local['cases7_bl'] . "</td></tr>
</table>";
?>