<?php

namespace Kgs\Bereichsrechte;

use Kirby\Cms\Page;
use Kirby\Cms\User;
use Kirby\Guards\PageGuards;

/**
 * Guards für Seiten mit Bereichsrechten (Kirby 6).
 *
 * Kirby prüft jede Aktion (bearbeiten, Status ändern, löschen, Unterseiten
 * anlegen, aber auch `access` und `list`) über `$page->guards()`. Hier wird
 * nur die Berechtigungsschicht ausgetauscht, Fähigkeiten und Validierung
 * bleiben die von Kirby.
 */
class BereichsGuards extends PageGuards
{
    public function __construct(
        Page $model,
        User $user
    ) {
        parent::__construct($model, $user);

        $this->permissions = new BereichsPagePermissions($model, $user);
    }
}
