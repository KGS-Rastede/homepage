<?php

    /*

    So soll das Ergebnis am Ende aussehen

    [
    {
    "title": "Reformationstag",
    "start": "2019-10-31",
    "end": "2019-11-01",
    "color": "orange",
    "textColor": "#707070"
    },
    {
    "title": "Wanderwoche (Klassenfahrten - Studienfahrten)",
    "start": "2019-09-16",
    "end": "2019-09-21",
    "color": "greenyellow",
    "textColor": "#707070"
    },
    {
    "title": "Veranstaltung 'Jugendzimmer' Jg. 8",
    "start": "2019-08-22",
    "end": "2019-08-24",
    "color": "lightblue",
    "textColor": "#707070"
    },
    {
    "title": "Schulvorstand",
    "start": "2020-04-23T17:00",
    "end": "2020-04-23T19:00",
    "color": "lightgrey",
    "textColor": "#707070"
    }
    ]
    */
    ?>

<?php
function echo2 ($inhalt){
	global $exportjson;
	$inhalt = str_replace('<br>',chr(13).chr(10),$inhalt);
	fwrite ($exportjson, $inhalt);
	//echo $inhalt;
}
//Kategorien 1-9 werden farblich unterschiedlich dargestellt
$farbpalette =array("gray","skyblue","lightgrey","lightblue","greenyellow","mediumvioletred","papayawhip","pink","turquoise","orange");
$such_beginn_datensatz = 'BEGIN:VEVENT';
$such_ende_datensatz = 'END:VEVENT';
$such_categorie = 'CATEGORIES:';
$such_start = 'DTSTART;VALUE=DATE:';
$such_end = 'DTEND;VALUE=DATE:';
$such_description = 'DESCRIPTION:';
$such_summary = 'SUMMARY:';
$such_farbe = 'COLOR:';
///////////////////////////////////////////////
// Kalender einlesen
$file_name = 'schuljahresplaner.ics';
$file = fopen($file_name, "r");
$exportjson = fopen ("schuljahresplaner.json",'w');
$datensatz_nr = 0;
$datensatz = false;
echo2 ('['.'<br>'); //Zeile 1 der json-Datei für den fullcalendar
while(!feof($file)) {
  $zeile = fgets($file,4096);
  $zeile = str_replace('TZID=Europe/Berlin:','VALUE=DATE:',$zeile);
  if (trim($zeile) == $such_beginn_datensatz && $datensatz == false){//Beginn des Termindatensatzes - Initialisierung
	$datensatz_nr = $datensatz_nr + 1;
	$datensatz = true;//Termin beginnt
	$categorie ='';
	$start = '';
	$description = '';
	$summary = '';
    $color = 'white';
	$end = '';
  }
  if (trim($zeile) == $such_ende_datensatz && $datensatz == true){//Ende des Datensatzes

    $datensatz = false; //Termin Ende
	if ($datensatz_nr != 1) {echo2 (','.'<br>');};
	echo2 ('{'.'<br>');
	echo2 ('"title": '.'"'.$summary.'",'.'<br>');
	echo2 ('"start": '.'"'.substr($start,0,4).'-'.substr($start,4,2).'-'.substr($start,6,2));
	if (strlen($start)>8) {echo2 (substr($start,8,3).':'.substr($start,11,2));};
	echo2 ('",<br>');
	echo2 ('"end": '.'"'.substr($end,0,4).'-'.substr($end,4,2).'-'.substr($end,6,2));
	if (strlen($end)>8) {echo2 (substr($end,8,3).':'.substr($end,11,2));};
	echo2 ('",<br>');
	if (substr($categorie,0,1)>=1 && substr($categorie,0,1)<=9) {$color = $farbpalette[substr($categorie,0,1)];}
	echo2 ('"color": '.'"'.$color.'",'.'<br>');
	echo2 ('"textColor": '.'"'.'#707070'.'"<br>');
	echo2 ('}');
  }	  
  //Termindetails auslesen
  if ($datensatz == true) {
	  if (preg_match('/'.$such_farbe.'/',trim($zeile)) == 1) {$color = trim(substr($zeile,strlen($such_farbe),100));}
	  if (preg_match('/'.$such_categorie.'/',trim($zeile)) == 1) {$categorie = trim(substr($zeile,strlen($such_categorie),100));}
	  if (preg_match('/'.$such_start.'/',trim($zeile)) == 1) {$start = trim(substr($zeile,strlen($such_start),100));}
	  if (preg_match('/'.$such_description.'/',trim($zeile)) == 1) {$description = trim(substr($zeile,strlen($such_description),100));}
	  if (preg_match('/'.$such_summary.'/',trim($zeile)) == 1) {$summary = trim(substr($zeile,strlen($such_summary),200));
	  //Hochkommas im string austauschen
		$summary = str_replace('"','\'',$summary);
		$summary = str_replace('\\','',$summary);
	  }
	  if (preg_match('/'.$such_end.'/',trim($zeile)) == 1) {$end = trim(substr($zeile,strlen($such_end),100));
	  }	  	  
  } //Datensatz == true
} //end of File
echo2 ('<br>'.']'); //Ende der JSON-Datei
fclose ($file);
fclose ($exportjson);
echo $datensatz_nr.'Termine umgewandelt ics <-> json, ics2json fertig ...';
?>