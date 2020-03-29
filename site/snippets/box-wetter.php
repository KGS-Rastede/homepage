<div class="card card-pricing">
    <div class="card-body ">
        <h4 class="card-category text-primary" style="line-height:0.1em">Wetterstation der Schule</h4>
        <h7>... unterstützt vom Förderverein</h7>
        <div class="text-left">
            <?php
            global $arr;

            $pfad = $kirby->url('assets'); //absoluter Pfad zu den Messdaten
            $file = fopen($pfad . "/wetter/all-sensors.txt", "r");
            if ($file) {
                $count = 0;
                while (!feof($file)) {
                    $count = $count + 1;
                    $val = trim(fgets($file, 4096));
                    //Prueft, ob Leerzeile vorliegt
                    if (!empty($val)) {
                        $nameVal = explode(' ', $val);
                        $arr[trim(strtolower($nameVal[0]))] = trim($nameVal[1]);
                    }
                }
                fclose($file);
            }
            function leer($wert)
            {
                if ($wert == '') $wert = '---';
                return $wert;
            }
            function komma($wert)
            {
                if ($wert == '') {
                    $wert = '---';
                } else {
                    $wert = number_format($wert, 1, ',', '.');
                }
                return $wert;
            }

            function wotag($tag)
            {
                $wochentag = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");
                return $wochentag[$tag] . ' ';
            }

            $windchill = komma($arr["actual_wind0_chill_c"]) . "°C";
            $temp = komma($arr["actual_th0_temp_c"]) . "°C";
            if ($temp == "---°C") {
                $temp = "<span style=\"font-weight: bold; color: red;\">Leider gibt es eine Störung bei der Messwerterfassung.<br>Der Temperatursensor ist ausgefallen. Wir arbeiten dran ...</span><br>";
            }
            $regen = komma($arr["actual_rain0_rate_mm"]) . "mm";
            $regen_tag = komma($arr["day1_rain0_total_mm"]) . "mm";
            $feucht = leer($arr["actual_th0_hum_rel"]) . "%";
            $press = komma($arr["actual_thb0_sealevel_hpa"]) . "hPa";
            $wind = komma($arr["actual_wind0_speed_kmh"]) . "km/h";
            $winddir = leer($arr["actual_wind0_dir_de"]);
            $uv_index = komma($arr["actual_uv0_index"]);
            $sonne_watt = komma($arr["actual_sol0_radiation_wqm"]) . "Wqm";
            $sonne_rel = komma($arr["actual_sol0_radiation_rel"]) . "%";
            $sonnenaufgang = leer($arr["actual_sunrise_standard_local"]);
            $sonnenuntergang = leer($arr["actual_sunset_standard_local"]);
            $sonnendauer = leer($arr["actual_daylength_standard_hhmm"]);
            $morgendaemmerung = leer($arr["actual_sunrise_civiltwilight_local"]);
            $abenddaemmerung = leer($arr["actual_sunset_civiltwilight_local"]);
            $mondaufgang = leer($arr["actual_moonset_standard_local"]);
            $monduntergang = leer($arr["actual_moonrise_standard_local"]);
            $mondprozent = komma($arr["actual_lunar_phase_percentage"]) . "%";
            $messzeitpunkt_tag = leer($arr["actual_date0_puredate_local"]);
            $messzeitpunkt_zeit = leer(substr($arr["actual_date0_time_local"], 0, 5)) . ' Uhr';
            $messzeitpunkt = wotag($arr["actual_date0_dayofweek_local"]) . $messzeitpunkt_tag . ' ' . $messzeitpunkt_zeit;
            $vorhersage = leer(str_replace('_', ' ', $arr["actual_thb0_fc_textde"]));
            ?>
            <!--neuer Versuch -->

            <div class="table-responsive">

            <table class="table">
                <tr>
                    <th>Messzeitpunkt</th>
                </tr>
                <tr>
                    <td><?= $messzeitpunkt ?></td>
                </tr>
                <tr>
                    <td><b>Temperatur: </b><?= $temp ?></td>
                </tr>
                <tr>
                    <td><b>Gefühlte Temp.: </b><?= $windchill ?></td>
                </tr>
                <tr>
                    <td><b>Feuchtigkeit: </b><?= $feucht ?></td>
                </tr>
                <tr>
                    <td><b>Luftdruck: </b><?= $press ?></td>
                </tr>
                <tr>
                    <td><b>Regen aktuell: </b><?= $regen ?></td>
                </tr>
                <tr>
                    <td><b>Regen am Tag: </b><?= $regen_tag ?></td>
                </tr>
                <tr>
                    <td><b>Windrichtung: </b><?= $winddir ?></td>
                </tr>
                <tr>
                    <td><b>Windstärke: </b><?= $wind ?></td>
                </tr>
                <tr>
                    <td><b>Sonnenaufgang: </b><?= $sonnenaufgang ?></td>
                </tr>
                <tr>
                    <td><b>Sonnenuntergang: </b><?= $sonnenuntergang ?></td>
                </tr>
                <tr>
                    <td><b>UV-Index: </b><?= $uv_index ?></td>
                </tr>
                <tr>
                    <td><b>Intensität: </b><?= $sonne_watt ?></td>
                </tr>
                <tr>
                    <td><b>Mondaufgang: </b><?= $mondaufgang ?></td>
                </tr>
                <tr>
                    <td><b>Monduntergang: </b><?= $monduntergang ?></td>
                </tr>
                <tr>
                    <td><b>Mondphase: </b><?= $mondprozent ?></td>
                </tr>
                <tr>
                    <td>
                        <center><img src=<?= $pfad ?>.\'moonphase.png></center>
                    </td>
                </tr>
                <tr>
                    <td><b>
                            <center>Vorhersage</center>
                        </b></td>
                </tr>
                <tr>
                    <td>
                        <center><img width="40%" height="40%" src=<?= $pfad ?>.\'forecast0.png></center>
                    </td>
                </tr>
                <tr>
                    <td><?= $vorhersage ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>