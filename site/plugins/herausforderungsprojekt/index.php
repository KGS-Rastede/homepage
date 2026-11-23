<?php

use Kirby\Cms\App as Kirby;
use Kirby\Cms\Page;

/**
 * Herausforderungsprojekt: liefert die Seite des neuesten Jahrgangs,
 * damit das Menü nicht jedes Jahr im Code angepasst werden muss.
 * Ein neues Jahr legt man im Panel als Unterseite mit der Vorlage
 * "herausforderungsprojekt-jahrgang" an (Entwürfe zählen nicht).
 */
Kirby::plugin('kgs/herausforderungsprojekt', [
    'siteMethods' => [
        'aktuellesHerausforderungsprojekt' => function (): ?Page {
            $projekt = page('unterricht/herausforderungsprojekt');

            if ($projekt === null) {
                return null;
            }

            $jahrgaenge = $projekt->children()
                ->filterBy('intendedTemplate', 'herausforderungsprojekt-jahrgang')
                ->filter(fn ($p) => preg_match('/(\d{4})/', $p->slug()) === 1);

            if ($jahrgaenge->isEmpty()) {
                return $projekt;
            }

            return $jahrgaenge->sortBy(
                fn ($p) => (int)preg_replace('/\D*(\d{4}).*/', '$1', $p->slug()),
                'desc'
            )->first();
        },
    ],
]);
