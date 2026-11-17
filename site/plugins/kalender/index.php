<?php

use Kgs\Kalender\Kalender;
use Kirby\Cms\App as Kirby;
use Kirby\Cms\Response;

/**
 * Schulkalender aus IServ für die Kalenderseite und die Box auf der Startseite.
 * Adresse des IServ-Kalenders: Option `kgs.kalender.url` in secrets.php.
 * Erklärung: siehe src/Kalender.php
 */

load([
    'Kgs\\Kalender\\IcsParser' => 'src/IcsParser.php',
    'Kgs\\Kalender\\Kalender'  => 'src/Kalender.php',
], __DIR__);

Kirby::plugin('kgs/kalender', [
    'options' => [
        'cache'           => true,
        'maxAlter'        => 3600, // Sekunden, bis die ICS-Datei neu geholt wird
        'wiederholenNach' => 600,  // Sekunden Pause nach einem fehlgeschlagenen Abruf
        'timeout'         => 5,    // Sekunden, die auf IServ gewartet wird
    ],
    'routes' => [
        [
            // JSON-Quelle für FullCalendar, der Zeitraum kommt als ?start=…&end=…
            'pattern' => 'kalender.json',
            'method'  => 'GET',
            'action'  => function () {
                $termine = Kalender::termine(
                    Kalender::datumAus(get('start')),
                    Kalender::datumAus(get('end'))
                );

                if ($termine === null) {
                    return Response::json(['fehler' => 'Der Kalender ist gerade nicht verfügbar.'], 503);
                }

                return new Response(
                    json_encode(Kalender::fuerFullCalendar($termine), JSON_UNESCAPED_UNICODE),
                    'application/json',
                    200,
                    ['Cache-Control' => 'public, max-age=300']
                );
            },
        ],
    ],
]);
