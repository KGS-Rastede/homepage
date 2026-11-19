<?php

namespace Kgs\Bereichsrechte;

use Kirby\Cms\Page;
use Kirby\Guards\PageGuards;

/**
 * Standard-Model für alle Seiten. Eigene Page-Models in site/models
 * müssen von dieser Klasse erben, damit die Bereichsrechte auch dort gelten.
 *
 * guards() prüft jede Aktion im Panel und in der API (siehe
 * BereichsGuards), isAccessible() greift überall, wo Kirby eine Seite für das Panel oder
 * die API auflöst (Ansicht, API-Aufrufe, Dialoge, Dateien der Seite).
 * isListable() ruft isAccessible() auf, dadurch verschwinden die Seiten
 * auch aus Listen, der Suche und den Seitenauswahl-Feldern.
 */
class BereichsPage extends Page
{
    public function isAccessible(): bool
    {
        return Bereiche::allows($this) && parent::isAccessible();
    }

    public function guards(): PageGuards
    {
        return BereichsGuards::for($this);
    }
}
