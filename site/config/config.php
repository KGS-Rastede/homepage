<?php

$secrets = file_exists(__DIR__ . '/secrets.php') ? include __DIR__ . '/secrets.php' : [];

return array_merge($secrets, [
    // Damit bei Fehlern der Debugger angeht
    // https://getkirby.com/docs/cookbook/setup/debugging-basics

    // Auf dem echten Server muss der Debug-Modus aber aus sein! Das ist
    // eine potentielle Sicherheitslücke:
    // https://getkirby.com/docs/guide/configuration#multi-enviroment-setup
    'debug' => true,

    // mach mit VS Code des Debuggen einfacher
    'editor' => 'vscode',

    // automatische URLs folgen der deuschen Sprache
    'slugs' => 'de',

    'kgs.autoresize.maxWidth' => 1000,
    'kgs.autoresize.quality'  => 85,

    // Anpassungen des Panels
    // Anleitung siehe hier:
    //    https://getkirby.com/docs/cookbook/panel/customizing-panel
    'panel' => [
        // Damit auf einem oeffentlichen Server das Panel ueberhaupt geht...
        'install' => true,

        'language' => 'de',

        'css' => 'assets/css/custom-panel.css',

        // Keines unserer Plugins nutzt Vue-Templates als Strings,
        // daher den Template-Compiler aus Sicherheitsgründen abschalten.
        // https://getkirby.com/docs/reference/system/options/panel#vue-template-compiler
        'vue' => [
            'compiler' => false,
        ],

        // Startseite und Menü eingeschränkter Rollen ergeben sich aus
        // kgs.bereichsrechte (siehe unten), alle anderen bekommen das volle Panel.
        'home' => fn () => Kgs\Bereichsrechte\Bereiche::panelHome() ?? 'site',

        'menu' => fn () => Kgs\Bereichsrechte\Bereiche::panelMenu() ?? [
            'site',
            'system',
            'users',
            'languages',
            '-',
            'newblog' => [
                'label' => 'Neuer Blog',
                'link'  => 'pages/blogs',
                'icon'  => 'add',
            ],
            'newpress' => [
                'label' => 'Presseartikel',
                'link'  => 'pages/schule+presse',
                'icon'  => 'book',
            ],
        ],
    ],

    'routes' => [
        // Dokumentation zur Sitemap hier:
        // https://getkirby.com/docs/cookbook/content/sitemap
        [
            'pattern' => 'sitemap.xml',
            'action' => function () {
                $pages = site()->pages()->index();

                // fetch the pages to ignore from the config settings,
                // if nothing is set, we ignore the error page
                $ignore = kirby()->option('sitemap.ignore', ['error']);

                $content = snippet('sitemap', compact('pages', 'ignore'), true);

                // return response with correct header type
                return new Kirby\Cms\Response($content, 'application/xml');
            },
        ],
        [
            'pattern' => 'sitemap',
            'action' => function () {
                return go('sitemap.xml', 301);
            },
        ],
    ],

    // Bereichsrechte: eingeschränkte Rollen sehen und bearbeiten im Panel
    // nur diese Teilbäume (Seiten-IDs, Groß-/Kleinschreibung egal).
    // Der erste Bereich ist die Startseite der Rolle im Panel, die
    // Reihenfolge bestimmt das Menü.
    // Rollen ohne Eintrag (z. B. admin) sind nicht eingeschränkt.
    // Umsetzung: site/plugins/bereichsrechte
    'kgs.bereichsrechte' => [
        'blogger'      => ['blogs'],
        'fachleiter'   => ['blogs', 'Faecher'],
        'hfp'          => ['unterricht/herausforderungsprojekt'],
        'nilepe'       => ['blogs', 'beratungskonzept', 'unterricht'],
        'schulleitung' => ['schule', 'blogs', 'unterricht', 'Faecher', 'sv'],
    ],

    // Bezeichnung und Icon der Bereiche im Panel-Menü
    'kgs.bereiche' => [
        'blogs'                              => ['label' => 'Blogs',                   'icon' => 'edit'],
        'Faecher'                            => ['label' => 'Fächer',                  'icon' => 'book'],
        'unterricht'                         => ['label' => 'Unterricht',              'icon' => 'tag'],
        'unterricht/herausforderungsprojekt' => ['label' => 'Herausforderungsprojekt', 'icon' => 'bolt'],
        'beratungskonzept'                   => ['label' => 'Beratungskonzept',        'icon' => 'heart'],
        'schule'                             => ['label' => 'Schule',                  'icon' => 'home'],
        'sv'                                 => ['label' => 'SV',                      'icon' => 'users'],
    ],

    'hooks' => [
        // Hochgeladene Bilder auf maximale Breite verkleinern (Original wird ersetzt).
        // GIFs bleiben unangetastet, damit Animationen nicht verloren gehen.
        'file.create:after' => function ($file) {
            if (!in_array($file->mime(), ['image/jpeg', 'image/png', 'image/webp'], true)) return;

            $maxWidth = option('kgs.autoresize.maxWidth', 1000);

            if ($file->width() <= $maxWidth) return;

            $file->manipulate([
                'width'   => $maxWidth,
                'quality' => option('kgs.autoresize.quality', 85),
            ]);
        },
    ],

    'markdown' => [
        'extra' => true,
    ],
]);
