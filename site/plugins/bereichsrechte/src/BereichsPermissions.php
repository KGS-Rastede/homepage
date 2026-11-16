<?php

namespace Kgs\Bereichsrechte;

use Kirby\Cms\PagePermissions;

/**
 * Seiten außerhalb des erlaubten Bereichs: keine einzige Aktion erlaubt
 * (bearbeiten, Status ändern, löschen, Unterseiten anlegen, ...).
 */
class BereichsPermissions extends PagePermissions
{
    public function can(string $action, bool $default = false): bool
    {
        if (Bereiche::allows($this->model) === false) {
            return false;
        }

        return parent::can($action, $default);
    }
}
