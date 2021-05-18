<?php
# Kirby-Aufruf für Zugriff auf Informationen des RKI:  https://getkirby.com/docs/reference/objects/http/remote/__construct
# GitHub für Projekt Idee: https://github.com/jamct/incidence-snippet
# API Landkreis / Bundeland: https://npgeo-corona-npgeo-de.hub.arcgis.com/datasets/917fc37a709542548cc3be077a786c17_0
# API Deutschland: https://www.arcgis.com/home/item.html?id=61d0f74ed79d454baad7712a1b85a6d0

class Incidence_local
{

    private $cache_file;
    private $region_id;

    // Parameter für den API aufruf
    private $fields = [
        'OBJECTID',
        'GEN',
        'BEZ',
        'BL',
        // 'cases',
        // 'deaths',
        // 'cases_per_population',

        'cases7_per_100k',
        // 'cases7_lk',
        // 'death7_lk',

        'cases7_bl_per_100k',
        // 'cases7_bl',
        // 'death7_bl',

        'last_update'
    ];

    // Konstruktor der Klasse, wird ausgeführt, wenn die Klasse erstellt wird
    public function __construct(int $ri, string $cache_file)
    {
        $this->cache_file = $cache_file;
        $this->region_id = $ri;
    }

    // Die eigentliche Methode, die von aussen aufgerufen wird, um die aktuellen Inzidenzen zu erhalten
    // Inzidenzen und andere Informationen werden in einem array zurückgegeben
    public function getDaily($offset = 0) // offset kann benutzt werden, um Daten von vorherigen Tagen zu erhalten
    {
        date_default_timezone_set('Europe/Berlin'); // Zeitzone richtig festlegen und nicht auf php.ini Einstellung verlassen
        // Es wird ein Datumschlüssel angelegt: 20.01.2021 wird zu 20210120
        $d = new DateTime("today -" . $offset . " day");
        $dt = $d->format('Ymd');

        $t = new DateTime();
        $hour = $t->format('H'); // aktuelle Stunde im 24 Stundenformat

        // Es wird abgefragt, ob ein Cache vorhanden ist, der den Datumschlüssel von heute besitzt
        // ist das der Fall wird das array zurückgegeben
        $c = $this->getCache($dt);
        if (is_array($c)) {
            $c['cached'] = true;
            return $c;
        }

        // nur wenn es nach 6 Uhr ist sollen neue Daten geladen werden, es kann sonst bei der Inzidenz für BRD dazu kommen, dass diese auf dem vorherigen Tag bleibt
        if ($hour >= 6) { 
            // gibt es keinen aktuellen Cache werden neue Informationen angefragt, und zurückgegeben
            $c = $this->fetchData($dt);
            if (is_array($c)) {
                $c['cached'] = false;
                return $c;
            }
        }
        
        // Wenn der Cache nicht aktuell ist und der Server nicht erreicht werden kann bzw. auch noch nicht aktuell ist
        // dann wird getestet, ob im Cache noch Informationen gibt, die von der letzten Woche sind
        for ($i = 1; $i <= 7; $i++) {    
            $offset = $offset + $i;
            $d = new DateTime("today -" . $offset . "day");
            $dt = $d->format('Ymd');

            // getCache() mit aktualisiertem Schlüssel aufrufen
            $cache = $this->getCache($dt);

            // wenn ein array zurückgegeben (von Methode getCache) wird, wird dieses zurückgegeben
            if (is_array($cache)) {
                $cache['cashed'] = true;
                return $cache;
            }
        }
    }

    // Es wird überprüft, ob es im Cache einen Eintrag für den gegeben Datumschlüssel gibt
    private function getCache(string $dt)
    {
        $f = @file_get_contents($this->cache_file); // gibt es die Cache Datei, wenn ja Inhalt lesen

        if ($f == false) { // keine Cache Datei vorhanden -> abbrechen
            return;
        }

        $data = json_decode($f, true); // Json in php code umwandeln
        if (isset($data[$dt])) {
            return $data[$dt]; // Die Informationen zurückgeben, wenn sie dem erhaltenem Datumschlüssel entsprechen
        } else {
            return;
        }
    }

    // Es wird beim Server eine neue Anfrage gestartet
    private function fetchData(string $dt)
    {
        // hier werden die Parameter von oben als ein String gespeichert und mit Komma getrennt
        $fieldstr = implode(",", $this->fields);
        
        // Mit Kirby wird ein remote erzeugt, siehe Link ganz oben
        $remote = new Remote('https://services7.arcgis.com/mOBPykOjAyBO2ZKk/arcgis/rest/services/RKI_Landkreisdaten/FeatureServer/0/query?where=OBJECTID='
        . $this->region_id . '&outFields=' . $fieldstr . '&returnGeometry=false&outSR=&f=json');

        if ($remote->code() < 400) { // Mit Kirby methoden wird überprüft ob der Remote (hier die API) erreichbar ist. Es wird der HTML staus code überprüft
            $json = $remote->json(); // Wenn erreichbar wird eine anfrage and die API gestartet und das Ergebnis als json interpretiert und als php array gespeichert

            if (!isset($json['features'][0]['attributes'])) { // Falls nicht die richtigen Informationen enthalten sind -> abbrechen 
                return;
            }

            $data = $json['features'][0]['attributes']; // Die API liefert deutlich mehr Text als benötigt -> hier wird das wichtige raus gefilter
            $date = DateTime::createFromFormat("d.m.Y, H:i", str_replace(" Uhr", "", $data['last_update'])); // Aus dem Eintrag "last_update" das Datum ermitteln
            $data['ts'] = $date->format("U"); // Aus dem Datum ein Timestamp Eintrag an dem Array anfügen -> benutzen wir eig. nicht
            $set = $this->setCache($data);
            // Die Methode gibt den Datumsschlüssel zurück, der aus dem Eintrag "last_update" ermittelt wird
            // Entspricht dieser dem übergebenem Datum (welches eig. imemr das aktuelle Datum ist) dann werden die Informationen zurückgegeben
             if ($set == $dt) {  // $dt wird beim Aufruf von fetch() übergeben
                return $data;
            } else {
                return;
            }
        }
        else 
            return;
    }

    // Die übergebenen Daten werden in der Cache Datei gespeichert, dabei wird der Schlüssel aus dem Datumseintrag "last_update" erzeugt
    private function setCache($data)
    {
        $date = DateTime::createFromFormat("d.m.Y, H:i", str_replace(" Uhr", "", $data['last_update'])); // Datum aus Eintrag "last_update" erhalten
        $key = $date->format("Ymd"); // Datumsschlüssel erzeugen
        $array = [];
        $array[$key] = $data;
        file_put_contents($this->cache_file, json_encode($array)); // Informationen in der Datei mit dem Datumsschlüssel speichern, dabei werden alte Einträge entfernt / überschrieben
        return $key;
    }
}

/* ------===============================================------ */
/* ------===============================================------ */

class Incidence_brd
{

    private $cache_file;
    private $region_id;

    // Parameter für den API aufruf
    private $fields = [
        'BundeslandId',
        'Inz7T',
    ];

    // Konstruktor der Klasse, wird ausgeführt, wenn die Klasse erstellt wird
    public function __construct(int $ri, string $cache_file, string $chache_file_local)
    {
        $this->cache_file = $cache_file;
        $this->last_updated_file = $chache_file_local; //Datei mit lokalen / Landkreis Daten um last updated zu ermitteln
        $this->region_id = $ri;
    }

    // Die eigentliche Methode, die von aussen aufgerufen wird, um die aktuellen Inzidenzen zu erhalten
    // Inzidenzen und andere Informationen werden in einem array zurückgegeben
    public function getDaily($offset = 0)
    {
        date_default_timezone_set('Europe/Berlin'); // Zeitzone richtig festlegen und nicht auf php.ini Einstellung verlassen
        // Es wird ein Datumschlüssel angelegt: 20.01.2021 wird zu 20210120
        $d = new DateTime("today -" . $offset . " day");
        $dt = $d->format('Ymd');

        $t = new DateTime();
        $hour = $t->format('H'); // aktuelle Stunde im 24 Stundenformat
        
        // Es wird abgefragt, ob ein Cache vorhanden ist, der den Datumschlüssel von heute besitzt
        // ist das der Fall wird das array zurückgegeben
        $c = $this->getCache($dt);
        if (is_array($c)) {
            $c['cached'] = true;
            return $c;
        }

        // nur wenn es nach 6 Uhr ist sollen neue Daten geladen werden, es kann sonst bei der Inzidenz für BRD dazu kommen, dass diese auf dem vorherigen Tag bleibt
        if ($hour >= 6) { 
            // gibt es keinen aktuellen Cache werden neue Informationen angefragts
            $c = $this->fetchData($dt);
            if (is_array($c)) {
                $c['cached'] = false;
                return $c;
            }
        }
        
        // Wenn der Cache nicht aktuell ist und der Server nicht erreicht werden kann bzw. auch noch nicht aktuell ist
        // dann wird getestet, ob im Cache noch Informationen gibt, die von der letzten Woche sind
        for ($i = 1; $i <= 7; $i++) {    
            $offset = $offset + $i;      
            $d = new DateTime("today -" . $offset . "day");            
            $dt = $d->format('Ymd');

            // getCache() mit aktualisiertem Schlüssel aufrufen
            $cache = $this->getCache($dt);

            // wenn ein array zurückgegeben (von Methode getCache) wird, wird dieses zurückgegeben
            if (is_array($cache)) {
                $cache['cashed'] = true;
                return $cache;
            }
        }
    }

    // Es wird überprüft, ob es im Cache einen Eintrag für den gegeben Datumschlüssel gibt
    private function getCache(string $dt)
    {
        $f = @file_get_contents($this->cache_file); // gibt es die Cache Datei, wenn ja Inhalt lesen

        if ($f == false) { // keine Cache Datei vorhanden -> abbrechen
            return;
        }

        $data = json_decode($f, true); // Json in php code umwandeln
        if (isset($data[$dt])) {
            return $data[$dt]; // Die Informationen zurückgeben, wenn sie dem erhaltenem Datumschlüssel entsprechen
        } else {
            return;
        }
    }

    // Es wird beim Server eine neue Anfrage gestartet
    private function fetchData(string $dt)
    {
        // hier werden die Parameter von oben als ein String gespeichert und mit Komma getrennt
        $fieldstr = implode(",", $this->fields);
        
        // Mit Kirby wird ein remote erzeugt, siehe Link ganz oben
        $remote = new Remote('https://services7.arcgis.com/mOBPykOjAyBO2ZKk/arcgis/rest/services/rki_key_data_v/FeatureServer/0/query?where=BundeslandId='
        . $this->region_id . '&outFields=' . $fieldstr . '&returnGeometry=false&outSR=&f=json');

        if ($remote->code() < 400) { // Mit Kirby methoden wird überprüft ob der Remote (hier die API) erreichbar ist. Es wird der HTML staus code überprüft
            $json = $remote->json(); // Wenn erreichbar wird eine anfrage and die API gestartet und das Ergebnis als json interpretiert und als php array gespeichert

            if (!isset($json['features'][0]['attributes'])) { // Falls nicht die richtigen Informationen enthalten sind -> abbrechen
                return;
            }

            $data = $json['features'][0]['attributes']; // Die API liefert deutlich mehr Text als benötigt -> hier wird das wichtige raus gefilter
            $utd = $this->isUpToDate($dt); //gibt es bei local_zahlen einen Eintrag für den heutigen Tag? Sind die infos also Uptodate?
            if ($utd) {
                $this->setCache($data, $dt);
                return $data;
            } else {
                return;
            }
        }
    }

    // in BRD Zahlen gibt es keine 'last_updated', um zu ermittlen, ob die Daten vom Server aktuell sind, deshalb aus local Zahlen auslesen
    // also aus der anderen Cache Datei
    private function isUpToDate($dt) 
    {
        $f = @file_get_contents($this->last_updated_file);
        if ($f == false) { // andere Cache Datei vorhanden?
            return;
        }

        $data = json_decode($f, true); //Json als php interpretieren
        if (isset($data[$dt])) { // Eintrag für das Datum von heute? bzw. dem Datum das übergeben wurde
            return true;
        } else {
            return;
        }
    }

    // Die übergebenen Daten werden in der Cache Datei gespeichert, der Schlüssel wird hier auch einfach übergeben
    private function setCache($data, $key)
    {        
        $array = [];
        $array[$key] = $data;
        file_put_contents($this->cache_file, json_encode($array));
    }
}