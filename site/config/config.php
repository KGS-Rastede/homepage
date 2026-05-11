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
                'nilepe'     => 'pages/unterricht',
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
                    'unterricht' => [
                        'label' => 'Unterricht',
                        'link'  => 'pages/unterricht',
                        'icon'  => 'tag',
                    ],
                ],
                'schulleitung' => [
                    'site',
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

    // Seitenbasierter Zugriffschutz für eingeschränkte Rollen.
    // Gilt für Panel-View-Routen (panel/pages/…) UND für API-Routen,
    // die das Vue-SPA bei interner Navigation nutzt (api/pages/…).
    'hooks' => [
        'file.create:after' => function ($file) {
            if (!$file->isResizable()) return;

            $maxWidth = option('kgs.autoresize.maxWidth', 1000);
            $quality  = option('kgs.autoresize.quality', 85);

            if ($file->width() <= $maxWidth) return;

            $root = $file->root();
            $mime = $file->mime();

            $src = match ($mime) {
                'image/jpeg' => imagecreatefromjpeg($root),
                'image/png'  => imagecreatefrompng($root),
                'image/webp' => imagecreatefromwebp($root),
                default      => null,
            };

            if (!$src) return;

            $newHeight = (int) round($file->height() * ($maxWidth / $file->width()));
            $dst = imagecreatetruecolor($maxWidth, $newHeight);

            if ($mime === 'image/png') {
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
            }

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $maxWidth, $newHeight, $file->width(), $file->height());

            match ($mime) {
                'image/jpeg' => imagejpeg($dst, $root, $quality),
                'image/png'  => imagepng($dst, $root),
                'image/webp' => imagewebp($dst, $root, $quality),
                default      => null,
            };

            imagedestroy($src);
            imagedestroy($dst);
        },

        'route:before' => function ($route, $path, $method) {
            $user = kirby()->user();
            if (!$user) return;

            $role = $user->role()->id();
            if ($role === 'admin') return;

            // Erlaubte Seitenwurzeln pro Rolle (Pfad-Notation mit /)
            $allowedRoots = [
                'blogger'    => ['blogs'],
                'fachleiter' => ['blogs', 'Faecher'],
                'hfp'        => ['unterricht/herausforderungsprojekt'],
                'nilepe'     => ['unterricht'],
            ];

            // Rollen ohne Seitenbeschränkung (z.B. schulleitung) → überspringen
            if (!isset($allowedRoots[$role])) return;

            $roots = $allowedRoots[$role];

            // Zielseite nach unerlaubtem Zugriff
            $panelHome = match ($role) {
                'blogger'    => '/panel/pages/blogs',
                'fachleiter' => '/panel/pages/blogs',
                'hfp'        => '/panel/pages/unterricht+herausforderungsprojekt',
                'nilepe'     => '/panel/pages/unterricht',
                default      => '/panel',
            };

            // Vollständige Seitenübersicht sperren
            if ($path === 'panel/site' || str_starts_with($path, 'panel/site/')) {
                go($panelHome);
                return;
            }

            // Seiten-ID aus Panel- oder API-Route extrahieren
            // Kirby kodiert verschachtelte Seiten mit + (blogs+artikel → blogs/artikel)
            $pageId = null;
            if (str_starts_with($path, 'panel/pages/')) {
                $slug = explode('/', substr($path, strlen('panel/pages/')))[0];
                $pageId = str_replace('+', '/', $slug);
            } elseif (str_starts_with($path, 'api/pages/')) {
                $slug = explode('/', substr($path, strlen('api/pages/')))[0];
                $pageId = str_replace('+', '/', $slug);
            }

            if ($pageId === null || $pageId === '') return;

            // Prüfen ob die Seite innerhalb der erlaubten Wurzeln liegt
            // Vergleich case-insensitiv, da Kirby Ordnernamen ggf. großschreibt
            $isAllowed = false;
            $pageIdLower = strtolower($pageId);
            foreach ($roots as $root) {
                $rootLower = strtolower($root);
                if ($pageIdLower === $rootLower || str_starts_with($pageIdLower, $rootLower . '/')) {
                    $isAllowed = true;
                    break;
                }
            }

            if ($isAllowed) return;

            if (str_starts_with($path, 'api/')) {
                // JSON-Fehler für interne Vue-API-Anfragen
                return new \Kirby\Http\Response(
                    json_encode(['status' => 'error', 'code' => 403, 'message' => 'Zugriff nicht erlaubt']),
                    'application/json',
                    403
                );
            } else {
                // Weiterleitung bei direktem URL-Aufruf
                go($panelHome);
            }
        },
    ],

    'markdown' => [
        'extra' => true,
    ],
]);
