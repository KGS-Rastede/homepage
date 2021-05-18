<?php 

class kalender_update {

    // Konstruktor der Klasse, wird beim erstellen aufgerufen
    public function __construct(string $cache_file, string $ics_file)
    {
        $this->cache_file = $cache_file;
        $this->ics_file = $ics_file;
    }

    /* Die Hauptmethode, die von aussen aufgerufen werden kann
        Es wird geprüft, ob der Kalender aktuell ist indem die Cache Datei ausgelesen wird, die einen Datumsschlüssel mit dem Datum des letzten Abgleichs mit dem IServ besitzt
        Ist dieser Schlüssel aktuell passiert nichts, ist der Schlüssel nicht aktuell wird eine neue Kalender .ics bei IServ angefragt
    */
    public function checkForUpdate()
    {
        $day = new DateTime("today");
        $date = $day->format('Ymd'); // Datumsschlüssel aus dem heutigen Tag erstellen

        $cache = $this->hasCache($date); //gibt `boolean` zurück
        if (!$cache) { // Falls der Kalender nicht uptodate ist oder Dateien fehlen
            // Mit der Methode fetchData() wird versucht ein neuer Kalender von IServ zu laden
            $result = $this->fetchData($date); // gibt ein boolean zurück

            if ($result == false) { // Der Kalender konnte nicht erfolgreich geladen werden
                return false;
            }
            else if ($result == true) { // Es wurde `true` zurückgegeben, somit wurde der Kalender erfolgreich aktualisiert
                return true;
            }
            else { // Sollte eigentlich nie auftreten -> ist nur sicherhaltsweise drin
                return false;
            }
        }
        else // der Kalender ist uptodate und es kann einfach `true` zurückgegeben werden
            return $cache; // ist ein boolean

    }

    // Die Methode überprüft, ob die Kalender ics vorhanden ist und ob der Kalender uptodate ist -> gibt true oder false zurück
    private function hasCache(string $date) // hier wird ein Datumsschlüssel übergeben
    {
        $file = @file_get_contents($this->cache_file); // gibt es die Cache Datei, falls ja Inhalt erhalten
        $ics = @file_exists($this->ics_file); // gibt es die Kalender ics? Inhalt davon ist egal ¯\_(ツ)_/¯

        if ($file == false or $ics == false) {
            // Es gibt entweder die Kalender Datei nicht oder die Cache Datei nicht -> abbrechen
            return false;
        }

        if ($file == $date) {
            // Der heutige Datumsschlüssel entspricht dem in der Cache Datei, somit ist der Kalender uptodate
            return true;
        } else {
            // die Schlüssel stimmen nicht überein -> der Kalender ist nicht uptodate
            return false;
        }
    }

    // die Methode versucht bei IServ eine neue Kalender ics anzufragen, ist das Erfolgreich wird `true` zurückgegeben, ansosnten `false`
    private function fetchData(string $pDate)
    {
        // einen neuen Remote mit Kirby erzeugen
        $remote = new Remote('https://kgs-rastede.eu/iserv/public/calendar/?key=1bad7fec91a3d07904543f4476774fd1');

        if ($remote->code() < 400) { // überprüfen, ob der HTML Statuscode kleiner als 400 ist -> ob die Seite also erreichbar ist
            $content = $remote->content(); // ICS Inhalt anfragen und in Variable speichern

            // ICS speichern und Cache datei aktualisieren
            return $this->setCache($content, $pDate); // gibt ein boolean zurück
        }
        else
            // falls der Server nicht erreicht werden kann
            return false;
    }

    // Diese Methode speichert $data als Inhalt der Kalender ics Datei und speichert $pDate als Datumsschlüssel in der Cache Datei
    private function setCache($data, $pDate)
    {
        $ics = fopen($this->ics_file, 'w'); // ICS Datei öffnen um darin schreiben zu können, falls die Datei nicht existiert neu erzeugen
        $result_ics = fwrite($ics, $data); // neue Kalender Daten in der Datei speichern
        $cache = fopen($this->cache_file, 'w'); // Cache Datei öffnen um darin schreiben zu können, falls die Datei nicht ecistiert neu erzeugen
        $result_cache = fwrite($cache, $pDate); // neuen Datumsschlüssel vom heutigen Tag speichern

        if ($result_ics == false or $result_cache == false) { // Falls eine der Operationen nicht erfolgreich war
            return false;
        }
        else { // Beide Operationen waren erfolgreich
            return true;
        }
    }
}
?>