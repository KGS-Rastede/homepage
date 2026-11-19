<?php

namespace Kgs\Bereichsrechte;

use Kirby\Guards\PagePermissions;

/**
 * Seiten außerhalb des erlaubten Bereichs: keine einzige Aktion erlaubt.
 * Innerhalb des Bereichs gelten die normalen Rechte aus Blueprint und Rolle.
 */
class BereichsPagePermissions extends PagePermissions
{
    public function ensure(string $action, bool $default = false): void
    {
        if (Bereiche::allows($this->model) === false) {
            $this->error($action);
        }

        parent::ensure($action, $default);
    }
}
