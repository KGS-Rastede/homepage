<?php

require 'kirby/bootstrap.php';

$kirby  = new Kirby();
$notfall = $kirby->page('wichtige-informationen');

// Notfallmodus mit Weiterleitung: alle Seiten außer der Startseite leiten
// auf die Startseite um. Panel, API und Mediendateien bleiben erreichbar,
// sonst ließe sich der Notfallmodus nicht mehr abschalten.
if (
    $notfall?->togglenotfall()->toBool() === true &&
    $notfall->notfallredirect()->toBool() === true
) {
    $path       = '/' . ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '', '/');
    $ausnahmen  = [
        '/' . trim($kirby->option('panel.slug', 'panel'), '/'),
        '/' . trim($kirby->option('api.slug', 'api'), '/'),
        '/media',
    ];
    $ausgenommen = $path === '/';

    foreach ($ausnahmen as $prefix) {
        if ($path === $prefix || str_starts_with($path, $prefix . '/')) {
            $ausgenommen = true;
        }
    }

    if ($ausgenommen === false) {
        go($kirby->url(), 302);
    }
}

echo $kirby->render();
