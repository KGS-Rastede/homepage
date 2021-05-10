<?php
# Kirby-Aufruf für Zugriff auf Informationen des RKI:  https://getkirby.com/docs/reference/objects/http/remote/__construct
# GitHub für Projekt Idee: https://github.com/jamct/incidence-snippet
# API Landkreis / Bundeland: https://npgeo-corona-npgeo-de.hub.arcgis.com/datasets/917fc37a709542548cc3be077a786c17_0
# API Deutschland: https://www.arcgis.com/home/item.html?id=61d0f74ed79d454baad7712a1b85a6d0

class Incidence_local
{

    private $cache_file;
    private $region_id;

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


    public function __construct(int $ri, string $cache_file)
    {
        $this->cache_file = $cache_file;
        $this->region_id = $ri;
    }

    public function getDaily($offset = 0)
    {
        $d = new DateTime("today -" . $offset . " day");
        $dt = $d->format('Ymd');

        $c = $this->getCache($dt);
        if (is_array($c)) {
            $c['cached'] = true;
            return $c;
        }
        $c = $this->fetchData($dt);
        if (is_array($c)) {
            $c['cached'] = false;
            return $c;
        }
        
        //If cache is not up to date & (server not contactable or server data not up to date)
        //-> Try to get chache from past 7 days
        for ($i = 1; $i <= 7; $i++) {    
            $offset = $offset + $i;      
            $d = new DateTime("today -" . $offset . "day");            
            $dt = $d->format('Ymd');

            $cache = $this->getCache($dt);

            if (is_array($cache)) {
                $cache['cashed'] = true;
                return $cache;
            }
        }
    }

    private function getCache(string $dt)
    {
        $f = @file_get_contents($this->cache_file);

        if ($f == false) {
            return;
        }

        $data = json_decode($f, true);
        if (isset($data[$dt])) {
            return $data[$dt];
        } else {
            return;
        }
    }

    private function fetchData(string $dt)
    {
        $fieldstr = implode(",", $this->fields);
        
        $remote = new Remote('https://services7.arcgis.com/mOBPykOjAyBO2ZKk/arcgis/rest/services/RKI_Landkreisdaten/FeatureServer/0/query?where=OBJECTID='
        . $this->region_id . '&outFields=' . $fieldstr . '&returnGeometry=false&outSR=&f=json');

        if ($remote->code() < 400) { //API erreichbar?
            $json = $remote->json(); //json anfragen

            if (!isset($json['features'][0]['attributes'])) {
                return;
            }

            $data = $json['features'][0]['attributes'];
            $date = DateTime::createFromFormat("d.m.Y, H:i", str_replace(" Uhr", "", $data['last_update']));
            $data['ts'] = $date->format("U");
            $set = $this->setCache($data);
            if ($set == $dt) {
                return $data;
            } else {
                return;
            }
        }
        else 
            return;
    }

    private function setCache($data)
    {
        $date = DateTime::createFromFormat("d.m.Y, H:i", str_replace(" Uhr", "", $data['last_update']));
        $key = $date->format("Ymd");
        $array = [];
        $array[$key] = $data;
        file_put_contents($this->cache_file, json_encode($array));
        return $key;
    }
}

/* ------===============================================------ */
/* ------===============================================------ */

class Incidence_brd
{

    private $cache_file;
    private $region_id;

    private $fields = [
        'BundeslandId',
        'Inz7T',
    ];


    public function __construct(int $ri, string $cache_file, string $chache_file_local)
    {
        $this->cache_file = $cache_file;
        $this->last_updated_file = $chache_file_local; //Datei mit lokalen / Landkreis Daten um last updated zu ermitteln
        $this->region_id = $ri;
    }

    public function getDaily($offset = 0)
    {
        $d = new DateTime("today -" . $offset . " day");
        $dt = $d->format('Ymd');

        $c = $this->getCache($dt);
        if (is_array($c)) {
            $c['cached'] = true;
            return $c;
        }
        $c = $this->fetchData($dt);
        if (is_array($c)) {
            $c['cached'] = false;
            return $c;
        }

        
        //If cache is not up to date & (server not contactable or server data not up to date)
        //-> Try to get chache from past 7 days
        for ($i = 1; $i <= 7; $i++) {    
            $offset = $offset + $i;      
            $d = new DateTime("today -" . $offset . "day");            
            $dt = $d->format('Ymd');

            $cache = $this->getCache($dt);

            if (is_array($cache)) {
                $cache['cashed'] = true;
                return $cache;
            }
        }
    }

    private function getCache(string $dt)
    {
        $f = @file_get_contents($this->cache_file);

        if ($f == false) {
            return;
        }

        $data = json_decode($f, true);
        if (isset($data[$dt])) {
            return $data[$dt];
        } else {
            return;
        }
    }

    private function fetchData(string $dt)
    {
        $fieldstr = implode(",", $this->fields);
        
        $remote = new Remote('https://services7.arcgis.com/mOBPykOjAyBO2ZKk/arcgis/rest/services/rki_key_data_v/FeatureServer/0/query?where=BundeslandId='
        . $this->region_id . '&outFields=' . $fieldstr . '&returnGeometry=false&outSR=&f=json');

        if ($remote->code() < 400) { //API erreichbar?
            $json = $remote->json(); //json anfragen

            if (!isset($json['features'][0]['attributes'])) {
                return;
            }

            $data = $json['features'][0]['attributes'];           
            $utd = $this->isUpToDate($dt); //gibt es bei local_zahlen einen Eintrag für den heutigen Tag? Uptodate?
            if ($utd) {
                $this->setCache($data, $dt);
                return $data;
            } else {
                return;
            }
        }
    }

    private function isUpToDate($dt) //in BRD Zahlen gibt es keine 'last_updated' deshalb aus local Zahlen auslesen
    {
        $f = @file_get_contents($this->last_updated_file);
        if ($f == false) { //Datei vorhanden?
            return;
        }

        $data = json_decode($f, true);
        if (isset($data[$dt])) { //Eintrag für das Datum von heute?
            return true;
        } else {
            return;
        }
    }

    private function setCache($data, $key)
    {        
        $array = [];
        $array[$key] = $data;
        file_put_contents($this->cache_file, json_encode($array));
    }
}