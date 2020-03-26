<div class="card card-pricing">
    <div class="card-body ">
        <h4 class="card-category text-primary">Wetterstation der Schule</h4>
        <div class="text-left">
            <?php
            global $arr;
            $pfad = "https://www.kgs-rastede.de/_wetter/"; //absoluter Pfad zu den Messdaten
            $file = fopen($pfad . "all-sensors.txt", "r");
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
            $content  =  "<table cellSpacing=\"1\" cellPadding=\"1\" width=\"100%\" border=\"0\">";
            $content  .= "  <tr>";
            $content  .= "    <left>" . "... unterstützt vom Förderverein.</left>";
            $content  .= "  </tr>";
            $windchill = komma($arr["actual_wind0_chill_c"]) . "°C";
            $temp = komma($arr["actual_th0_temp_c"]) . "°C";
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
            $mondprozent = komma($arr["actual_lunar_phase_percentage"]);
            $messzeitpunkt_tag = leer($arr["actual_date0_puredate_local"]);
            $messzeitpunkt_zeit = leer(substr($arr["actual_date0_time_local"], 0, 5)) . ' Uhr';
            $messzeitpunkt = wotag($arr["actual_date0_dayofweek_local"]) . $messzeitpunkt_tag . ' ' . $messzeitpunkt_zeit;
            $vorhersage = leer(str_replace('_', ' ', $arr["actual_thb0_fc_textde"]));
            $content  .= "  <tr>";
            $content  .= "    <td style=\"font-family: Verdana,Helvetica; font-size: 11px\">";
            $content  .= "    <b>Messzeitpunkt</b>: <br>" . $messzeitpunkt . "<br><br>";
            if ($temp == "---°C") {
                $content  .= "    <span style=\"font-weight: bold; color: red;\">Leider gibt es eine Störung bei der Messwerterfassung.<br>Der Temperatursensor ist ausgefallen. Wir arbeiten dran ...</span><br>";
            }
            $content  .= "    <b>Temperatur</b>: " . $temp . "<br>";
            $content  .= "    <b>Gef&uuml;hlte Temp.</b>: " . $windchill . "<br>";
            $content  .= "    <b>Feuchtigkeit</b>: " . $feucht . "<br>";
            $content  .= "    <b>Luftdruck</b>: " . $press . "<br>";
            $content  .= "    <b>Regen aktuell</b>: " . $regen . "<br>";
            $content  .= "    <b>Regen am Tag</b>: " . $regen_tag . "<br>";
            $content  .= "    <hr>";
            //Wind
            $content  .= "    <b>Windrichtung</b>: " . $winddir . "<br>";
            $content  .= "    <b>Windstärke</b>: " . $wind . "<br><hr>";

            $content  .= "    <b>Sonnenaufgang</b>: " . $sonnenaufgang . "<br>";
            $content  .= "    <b>Sonnenuntergang</b>: " . $sonnenuntergang . "<br>";

            $content  .= "    <b>UV-Index</b>: " . $uv_index . "<br>";
            $content  .= "    <b>Intensität</b>: " . $sonne_watt . "<br>";
            $content  .= "    <hr>";
            $content  .= "</td>";
            $content  .= "</tr>";
            $content  .= "    <tr><td><b>Mondaufgang</b>: " . $mondaufgang . "<br></td></tr>";
            $content  .= "    <tr><td><b>Monduntergang</b>: " . $monduntergang . "<br></td></tr>";
            $content  .= "    <tr><td><b>Mondphase</b>: " . $mondprozent . " %<br></td></tr>";

            $content  .= "  <tr>";
            $content  .= "    <td vAlign=\"top\" style=\"font-family: Verdana,Helvetica; font-size: 11px\">";
            $content  .= "    <center><img src=$pfad.\'moonphase.png></center></td></tr>";
            $content  .= "<tr><td>";
            $content  .= "<hr>";
            $content  .= "</td>";

            $content  .= "    <tr><td><center><b>Vorhersage</b><br></center></td></tr>";

            $content  .= "  <tr>";
            $content  .= "    <td vAlign=\"top\" style=\"font-family: Verdana,Helvetica; font-size: 11px\">";
            $content  .= "    <center><img width=\"40%\" height=\"40%\" src=$pfad.\'forecast0.png></center></td></tr>";
            $content  .= "   <tr><td style=\"font-family: Verdana,Helvetica; font-size: 8px; line-height: 8px\">" . $vorhersage . "<br></td></tr>";
            $content  .= "</table>";
            echo $content;
            ?>
        </div>

    </div>
</div>