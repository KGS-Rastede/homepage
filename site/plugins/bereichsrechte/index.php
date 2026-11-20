<?php

use Kgs\Bereichsrechte\Bereiche;
use Kgs\Bereichsrechte\BereichsPage;
use Kirby\Cms\App as Kirby;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Cms\User;
use Kirby\Exception\PermissionException;

/**
 * Bereichsrechte für eingeschränkte Panel-Rollen.
 * Konfiguration: Option `kgs.bereichsrechte` in site/config/config.php.
 * Erklärung: siehe src/Bereiche.php
 */

load([
    'Kgs\\Bereichsrechte\\Bereiche'                => 'src/Bereiche.php',
    'Kgs\\Bereichsrechte\\BereichsPage'            => 'src/BereichsPage.php',
    'Kgs\\Bereichsrechte\\BereichsGuards'          => 'src/BereichsGuards.php',
    'Kgs\\Bereichsrechte\\BereichsPagePermissions' => 'src/BereichsPagePermissions.php',
], __DIR__);

Kirby::plugin('kgs/bereichsrechte', [
    'pageModels' => [
        // gilt für alle Vorlagen ohne eigenes Model in site/models
        'default' => BereichsPage::class,
    ],
    'userMethods' => [
        // Startseite im Panel: In den Blueprints der eingeschränkten Rollen
        // steht `home: "{{ user.bereichsHome }}"`. Kirby kennt keine
        // Option `panel.home`, nur `home:` im Benutzer-Blueprint.
        'bereichsHome' => function (): string {
            /** @var User $this */
            return $this->kirby()->url('panel') . '/' . (Bereiche::panelHome($this) ?? 'site');
        },
    ],
    'hooks' => [
        // Kirby prüft beim Verschieben nur die Seite selbst, nicht das Ziel
        'page.move:before' => function (Page $page, Page|Site $parent) {
            if (Bereiche::allows($parent) === false) {
                throw new PermissionException(
                    message: 'Seiten dürfen nur innerhalb des eigenen Bereichs verschoben werden.'
                );
            }
        },
    ],
]);
