<?php

/**
 * Represents weather data fetched from the OpenWeatherMap API.
 *
 * Downloads weather data from the OpenWeatherMap API and caches it locally.
 * Checks if the cached data is stale (older than 5 minutes) before fetching new data.
 */

class Weather extends Page
{
    public $city;
    public $apiKey;
    private $cacheFile;

    function __construct()
    {
        $this->city = Config::get('weather.city');
        $this->apiKey = Config::get('weather.apiKey');
        $this->cacheFile = Config::get('weather.cacheFile');
    }

    public function getWeather()
    {
        if ($this->isCacheValid()) {
            return $this->readCache();
        } else {
            $weatherData = $this->fetchWeatherData();
            return $weatherData;
        }
    }

    private function isCacheValid()
    {
        if (!file_exists($this->cacheFile)) {
            return false;
        }

        $cacheData = json_decode(file_get_contents($this->cacheFile), true);

        // Check if the dateTime exists and is within 5 minutes
        if (isset($cacheData['dateTime'])) {
            date_default_timezone_set('Europe/Berlin');
            $cacheDateTime = strtotime($cacheData['dateTime']);
            return (time() - $cacheDateTime) < 300; // 5 minutes
            date_default_timezone_set('UTC');
        }

        // If dateTime doesn't exist or is invalid, consider cache as invalid
        return false;
    }


    private function readCache()
    {
        $cachedData = file_get_contents($this->cacheFile);
        $cacheData = json_decode($cachedData, true);
        return $cacheData['data'];
    }

    private function writeCache($data)
    {
        date_default_timezone_set('Europe/Berlin');
        // Get the current date and time in the desired format
        $dateTime = date('Y-m-d H:i:s');
        date_default_timezone_set('UTC');
        // Add date and time along with the weather data
        $cacheData = [
            'dateTime' => $dateTime,
            'data' => $data
        ];

        // Encode the data
        $jsonData = json_encode($cacheData);

        // Write the data to the cache file
        file_put_contents($this->cacheFile, $jsonData);
    }

    private function fetchWeatherData()
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($this->city) . "&appid=" . $this->apiKey . "&lang=de";
        // try catch block to handle exceptions
        try {
            $response = Remote::get($url);
            if ($response->code() !== 200) {
                throw new Exception('Failed to fetch weather data.');
            }
            $weatherData = json_decode($response->content(), true);
            $this->writeCache($weatherData);
            return $weatherData;
        } catch (Exception $e) {
            // use cached data if fetching new data fails
            return $this->readCache();
        }
    }
}
