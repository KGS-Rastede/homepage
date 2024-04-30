<?php

use Kirby\Cms\Page;

// get weather data
$weather = new Weather();
$weatherData = $weather->getWeather();

// get the current weather
$weatherMain = $weatherData['weather'][0]['main'];
$weatherDescription = $weatherData['weather'][0]['description'];
$weatherIcon = $weatherData['weather'][0]['icon'];

// get the temperature
$temperature = $weatherData['main']['temp'] - 273.15; // convert from Kelvin to Celsius

// get the wind speed
$windSpeed = $weatherData['wind']['speed'];

// get the humidity
$humidity = $weatherData['main']['humidity'];

date_default_timezone_set('Europe/Berlin');
$sunrise = date('H:i', $weatherData['sys']['sunrise']);
$sunset = date('H:i', $weatherData['sys']['sunset']);
date_default_timezone_set('UTC');


?>

<div class="weather">
    <h2>Wetter in Rastede</h2>
    <p><?= $weatherMain ?> (<?= $weatherDescription ?>)</p>
    <img src="http://openweathermap.org/img/wn/<?= $weatherIcon ?>.png" alt="weather icon">
    <p>Temperatur: <?= round($temperature, 1) ?>°C</p>
    <p>Windgeschwindigkeit: <?= $windSpeed ?> m/s</p>
    <p>Luftfeuchtigkeit: <?= $humidity ?>%</p>
    <p>Sonnenaufgang: <?= $sunrise ?></p>
    <p>Sonnenuntergang: <?= $sunset ?></p>
</div>