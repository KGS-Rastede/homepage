<?php

namespace Kgs\Bereichsrechte;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Site;

/**
 * Bereichsrechte: Eingeschränkte Rollen dürfen im Panel nur bestimmte
 * Teilbäume der Seite sehen und bearbeiten.
 *
 * Kirby vergibt Rechte nur pro Vorlage und Rolle. Viele Vorlagen
 * (z. B. standardseite) kommen aber in mehreren Bereichen vor. Deshalb
 * prüft das Page-Model zusätzlich, ob die Seite in einem erlaubten
 * Bereich liegt. Die Bereiche stehen in der Config unter
 * `kgs.bereichsrechte` (Rolle => Liste von Seiten-IDs).
 *
 * Rollen ohne Eintrag (z. B. admin) sind nicht eingeschränkt.
 */
class Bereiche
{
    /**
     * Erlaubte Bereiche der aktuell eingeloggten Rolle, oder null,
     * wenn die Rolle nicht eingeschränkt ist.
     *
     * @return string[]|null Seiten-IDs in Kleinschreibung
     */
    public static function forCurrentUser(): array|null
    {
        $kirby = App::instance();
        $user  = $kirby->user();

        // Besucher ohne Login: Kirbys normale Regeln gelten
        if ($user === null) {
            return null;
        }

        $roots = $kirby->option('kgs.bereichsrechte', [])[$user->role()->id()] ?? null;

        if ($roots === null) {
            return null;
        }

        return array_map('strtolower', $roots);
    }

    /**
     * Liegt die Seite (bzw. die Site) im erlaubten Bereich der aktuellen Rolle?
     *
     * Vergleich ohne Groß-/Kleinschreibung, da Ordnernamen teils
     * großgeschrieben sind (z. B. `Faecher`).
     */
    public static function allows(Page|Site $model): bool
    {
        $roots = static::forCurrentUser();

        if ($roots === null) {
            return true;
        }

        // Die Site selbst ist kein Bereich: Neue Seiten direkt
        // unter der Site darf eine eingeschränkte Rolle nicht anlegen.
        if ($model instanceof Site) {
            return false;
        }

        $id = strtolower($model->id());

        foreach ($roots as $root) {
            if ($id === $root || str_starts_with($id, $root . '/')) {
                return true;
            }
        }

        return false;
    }
}
