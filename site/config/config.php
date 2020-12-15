<?php

return [

    // Damit bei Fehlern der Debugger angeht
    // https://getkirby.com/docs/cookbook/setup/debugging-basics

    // Auf dem echten Server muss der Debug-Modus aber aus sein! Das ist 
    // eine potentielle Sicherheitslücke:
    // https://getkirby.com/docs/guide/configuration#multi-enviroment-setup
    'debug'  => true,


    // automatische URLs folgen der deuschen Sprache
    'slugs' => 'de',

    // Automatically resize images on upload 2000px width
    'medienbaecker.autoresize.maxWidth' => 1000,

    // Anpassungen des Panels
    // Anleitung siehe hier:
    //    https://getkirby.com/docs/cookbook/panel/customizing-panel
    'panel' => [
        // Damit auf einem oeffentlichen Server das Panel ueberhaupt geht...
        'install' => true,

        'css' => 'assets/css/custom-panel.css'
    ],

    'email' => [
        'presets' => [
            'contact' => [
                'from'    => 'schulleitung@kgs-rastede.de',
                'subject' => 'Testemail von der neuen Homepage',
                'cc'      => 'ni@kgs-rastede.de',
                'body'    => 'Testinhalt der Mail'
            ],
            'transport' => [
                'type' => 'smtp',
                'host' => 'smtp.kgs-rastede.eu',
                'port' => 587,
                'security' => true,
                'auth' => true,
                'username' => 'xxx',
                'password' => 'yyy'
            ]
        ]
    ],

    'markdown' => [
        'extra' => true,
    ],
];
