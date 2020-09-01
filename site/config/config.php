<?php

return [


    // Damit auf einem oeffentlichen Server das Panel ueberhaupt geht...
    'panel' => ['install' => true],

    // Damit bei Fehlern der Debugger angeht  
    'debug'  => true,

    // automatische URLs folgen der deuschen Sprache
    'slugs' => 'de',

    // Automatically resize images on upload 2000px width
    'medienbaecker.autoresize.maxWidth' => 1000,

    // Anpassungen des Panels
    // Anleitung siehe hier: 
    //    https://getkirby.com/docs/cookbook/panel/customizing-panel
    'panel' => [
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
                'host' => 'smtp.company.com',
                'port' => 465,
                'security' => true,
                'auth' => true,
                'username' => '...',
                'password' => '...'
            ]
        ]
    ]
];
