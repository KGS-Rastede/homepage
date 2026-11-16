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

        // Weiterleitung nach Login je nach Rolle
        'home' => function () {
            $role = kirby()->user()?->role()->id() ?? 'nobody';
            return match ($role) {
                'blogger'    => 'pages/blogs',
                'fachleiter' => 'pages/blogs',
                'hfp'        => 'pages/unterricht+herausforderungsprojekt',
                'nilepe'     => 'pages/blogs',
                'schulleitung' => 'pages/schule',
                default      => 'site',
            };
        },

        'menu' => function () {
            $role = kirby()->user()?->role()->id() ?? 'nobody';

            return match ($role) {
                'blogger' => [
                    'blogs' => [
                        'label' => 'Blogs',
                        'link'  => 'pages/blogs',
                        'icon'  => 'edit',
                    ],
                ],
                'fachleiter' => [
                    'blogs' => [
                        'label' => 'Blogs',
                        'link'  => 'pages/blogs',
                        'icon'  => 'edit',
                    ],
                    'faecher' => [
                        'label' => 'Fächer',
                        'link'  => 'pages/Faecher',
                        'icon'  => 'book',
                    ],
                ],
                'hfp' => [
                    'hfp' => [
                        'label' => 'Herausforderungsprojekt',
                        'link'  => 'pages/unterricht+herausforderungsprojekt',
                        'icon'  => 'bolt',
                    ],
                ],
                'nilepe' => [
                    'blogs' => [
                        'label' => 'Blogs',
                        'link'  => 'pages/blogs',
                        'icon'  => 'edit',
                    ],
                    'beratungskonzept' => [
                        'label' => 'Beratungskonzept',
                        'link'  => 'pages/beratungskonzept',
                        'icon'  => 'heart',
                    ],
                    'unterricht' => [
                        'label' => 'Unterricht',
                        'link'  => 'pages/unterricht',
                        'icon'  => 'tag',
                    ],
                ],
                'schulleitung' => [
                    'schule' => [
                        'label' => 'Schule',
                        'link'  => 'pages/schule',
                        'icon'  => 'home',
                    ],
                    'blogs' => [
                        'label' => 'Blogs',
                        'link'  => 'pages/blogs',
                        'icon'  => 'edit',
                    ],
                    'unterricht' => [
                        'label' => 'Unterricht',
                        'link'  => 'pages/unterricht',
                        'icon'  => 'tag',
                    ],
                    'faecher' => [
                        'label' => 'Fächer',
                        'link'  => 'pages/Faecher',
                        'icon'  => 'book',
                    ],
                    'sv' => [
                        'label' => 'SV',
                        'link'  => 'pages/sv',
                        'icon'  => 'users',
                    ],
                ],
                // admin und alle anderen: volles Menü
                default => [
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
            };
        },
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
    // Rollen ohne Eintrag (z. B. admin) sind nicht eingeschränkt.
    // Umsetzung: site/plugins/bereichsrechte
    'kgs.bereichsrechte' => [
        'blogger'      => ['blogs'],
        'fachleiter'   => ['blogs', 'Faecher'],
        'hfp'          => ['unterricht/herausforderungsprojekt'],
        'nilepe'       => ['blogs', 'beratungskonzept', 'unterricht'],
        'schulleitung' => ['blogs', 'unterricht', 'sv', 'Faecher', 'schule'],
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
