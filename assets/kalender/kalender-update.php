<?php 

class kalender_update {
    public function __construct(string $cache_file, string $ics_file)
    {
        $this->cache_file = $cache_file;
        $this->ics_file = $ics_file;
    }

    public function checkForUpdate()
    {
        $day = new DateTime("today -" . 0 . " day");
        $date = $day->format('Ymd');

        $cache = $this->hasCache($date); //boolean
        if (!$cache) { //if not up to date
            $result = $this->fetchData($date); //bytes or false

            if ($result == false) {
                return false;
            }
            else //returned bytes -> content new chache created
                return true;
        }
        else //up to date
            return $cache; //boolean

    }

    private function hasCache(string $date) //checks if the cache is up to date and ics is available
    {
        $file = @file_get_contents($this->cache_file);
        $ics = @file_exists($this->ics_file);

        if ($file == false or $ics == false) { //no chache file or content, or no ics file
            return false;
        }

        if ($file == $date) { //files exists and contains date
            return true;
        } else { //not correct date
            return false;
        }
    }

    private function fetchData(string $pDate) //new ICS is loaded, returns true in case of success
    {        
        $remote = new Remote('https://kgs-rastede.eu/iserv/public/calendar/?key=1bad7fec91a3d07904543f4476774fd1');

        if ($remote->code() < 400) {
            $content = $remote->content();
            return $this->setCache($content, $pDate); //bytes or false
        }
        else
            return false;
    }

    private function setCache($data, $pDate)
    {
        $ics = fopen($this->ics_file, 'w');
        fwrite($ics, $data);
        $cache = fopen($this->cache_file, 'w');
        return fwrite($cache, $pDate); //bytes or false
    }
}
?>