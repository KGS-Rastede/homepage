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

        'language' => 'de',

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


    'routes' => [

        // Dokumentation zur Sitemap hier:
        // https://getkirby.com/docs/cookbook/content/sitemap
        [
            'pattern' => 'sitemap.xml',
            'action'  => function () {
                $pages = site()->pages()->index();

                // fetch the pages to ignore from the config settings,
                // if nothing is set, we ignore the error page
                $ignore = kirby()->option('sitemap.ignore', ['error']);

                $content = snippet('sitemap', compact('pages', 'ignore'), true);

                // return response with correct header type
                return new Kirby\Cms\Response($content, 'application/xml');
            }
        ],
        [
            'pattern' => 'sitemap',
            'action'  => function () {
                return go('sitemap.xml', 301);
            }
        ],

        //  Diese Route ist für den versteckten Login (aktuell nur für die WLAN-Voucher)
        // https://getkirby.com/docs/cookbook/security/access-restriction
        [
            'pattern' => 'logout',
            'action'  => function () {

                if ($user = kirby()->user()) {
                    $user->logout();
                }

                go('login');
            }
        ]
    ],

    'markdown' => [
        'extra' => true,
    ],

    'studyGroups' => [
        'url' => 'https://ag-wahl.kgsraste.de/api/v1/study_groups',
        'apiKey' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBUElVU0VSIiwiaWF0IjoxNTE2MjM5MDIyfQ.CYrLWRa3dIURYyXjAW0FBfyiQK2C5mYoVeMY2clN_hY'
    ],
];
