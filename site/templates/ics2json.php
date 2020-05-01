<?php
function echo2($inhalt)
{
	global $exportjson;
	$inhalt = str_replace('<br>', chr(13) . chr(10), $inhalt);
	fwrite($exportjson, $inhalt);
}
//Kategorien 1-9 werden farblich unterschiedlich dargestellt
$farbpalette = array("gray", "skyblue", "lightgrey", "lightblue", "greenyellow", "mediumvioletred", "papayawhip", "pink", "turquoise", "orange");
$such_beginn_datensatz = 'BEGIN:VEVENT';
$such_ende_datensatz = 'END:VEVENT';
$such_categorie = 'CATEGORIES:';
$such_start = 'DTSTART';
$such_end = 'DTEND';
$such_description = 'DESCRIPTION:';
$such_summary = 'SUMMARY';
$such_zeilenumbruch_outlook = 'TRANSP';
///////////////////////////////////////////////
// Kalender einlesen
$file = fopen('https://kalender.kgs-rastede.de/schuljahresplanerPaos8UojIsZJF0KZz.ics', "r");
$exportjson = fopen("schuljahresplanerPaos8UojIsZJF0KZz.json", "w");
$datensatz_nr = 0;
$datensatz = false;
echo2('[' . '<br>'); //Zeile 1 der json-Datei für den fullcalendar
while (!feof($file)) {
	$zeile = trim(fgets($file, 4096));
	if (substr($zeile, 0, strlen($such_beginn_datensatz)) == $such_beginn_datensatz) { //Beginn des Termindatensatzes - Initialisierung
		$datensatz_nr = $datensatz_nr + 1;
		$datensatz = true; //Termin beginnt
		$categorie = '';
		$start = '';
		$description = '';
		$summary = '';
		$end = '';
	}
	if (substr($zeile, 0, strlen($such_ende_datensatz)) == $such_ende_datensatz) { //Ende des Datensatzes
		$datensatz = false; //Termin Ende
		$color = "white";
		$color = $farbpalette[substr($categorie, 0, 1)];
		if ($datensatz_nr != 1) {
			echo2(',' . '<br>');
		};
		echo2('{' . '<br>');
		echo2('"title": ' . '"' . $summary . '",' . '<br>');
		echo2('"start": ' . '"' . substr($start, 0, 4) . '-' . substr($start, 4, 2) . '-' . substr($start, 6, 2));
		if (strlen($start) > 8) {
			echo2(substr($start, 8, 3) . ':' . substr($start, 11, 2));
		};
		echo2('",<br>');
		echo2('"end": ' . '"' . substr($end, 0, 4) . '-' . substr($end, 4, 2) . '-' . substr($end, 6, 2));
		if (strlen($end) > 8) {
			echo2(substr($end, 8, 3) . ':' . substr($end, 11, 2));
		};
		echo2('",<br>');
		echo2('"color": ' . '"' . $color . '",' . '<br>');
		echo2('"textColor": ' . '"' . '#707070' . '"<br>');
		echo2('}');
	}
	//Termindetails auslesen
	if ($datensatz == true) {
		if (substr($zeile, 0, strlen($such_categorie)) == $such_categorie) {
			$categorie = trim(substr($zeile, strlen($such_categorie), 100));
		}
		if (substr($zeile, 0, strlen($such_start)) == $such_start) {
			$start = trim(substr($zeile, strpos($zeile, ':') + 1, 100));
		}
		if (substr($zeile, 0, strlen($such_description)) == $such_description) {
			$description = trim(substr($zeile, strlen($such_description), 100));
		}
		if (substr($zeile, 0, strlen($such_summary)) == $such_summary) {
			$summary = trim(substr($zeile, strpos($zeile, ':') + 1, 200));
			$zeile = trim(fgets($file, 4096));
			if (substr($zeile, 0, strlen($such_zeilenumbruch_outlook)) != $such_zeilenumbruch_outlook) {
				$summary .= $zeile;
			}
			//Hochkommas im string austauschen
			$summary = str_replace('"', '\'', $summary);
			$summary = str_replace('\\', '', $summary);
		}
		if (substr($zeile, 0, strlen($such_end)) == $such_end) {
			$end = trim(substr($zeile, strpos($zeile, ':') + 1, 100));
		}
	}
}
echo2('<br>' . ']'); //Ende der JSON-Datei
fclose($file);
fclose($exportjson);
echo 'ics2json fertig ...';
