<?php

namespace Kgs\Bereichsrechte;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Cms\User;

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
        $roots = static::configured();

        if ($roots === null) {
            return null;
        }

        return array_map('strtolower', $roots);
    }

    /**
     * Startseite der Rolle im Panel (erster Bereich) als Panel-Pfad,
     * z. B. `pages/blogs`, oder null, wenn die Rolle nicht eingeschränkt
     * ist. Ohne Argument gilt der aktuell eingeloggte Benutzer.
     *
     * Kirby liest die Startseite aus `home:` im Benutzer-Blueprint, dort
     * steht `{{ user.bereichsHome }}` (User-Method aus index.php).
     */
    public static function panelHome(User|null $user = null): string|null
    {
        $roots = static::configured($user);

        if ($roots === null || $roots === []) {
            return null;
        }

        return static::panelPath($roots[0]);
    }

    /**
     * Panel-Menü der aktuellen Rolle: ein Eintrag pro Bereich, in der
     * Reihenfolge aus `kgs.bereichsrechte`. Bezeichnung und Icon kommen
     * aus `kgs.bereiche`, sonst der Seitentitel bzw. ein Standard-Icon.
     * null, wenn die Rolle nicht eingeschränkt ist.
     */
    public static function panelMenu(): array|null
    {
        $roots = static::configured();

        if ($roots === null) {
            return null;
        }

        $kirby = App::instance();
        $infos = $kirby->option('kgs.bereiche', []);
        $menu  = [];

        foreach ($roots as $root) {
            $info = $infos[$root] ?? [];

            $menu[str_replace('/', '-', strtolower($root))] = [
                'label' => $info['label'] ?? $kirby->page($root)?->title()->value() ?? $root,
                'link'  => static::panelPath($root),
                'icon'  => $info['icon'] ?? 'page',
            ];
        }

        return $menu;
    }

    /**
     * Bereiche der Rolle so, wie sie in der Config stehen, oder null, wenn
     * niemand eingeloggt oder die Rolle nicht eingeschränkt ist.
     * Ohne Argument gilt der aktuell eingeloggte Benutzer.
     *
     * @return string[]|null
     */
    protected static function configured(User|null $user = null): array|null
    {
        $kirby = App::instance();
        $user ??= $kirby->user();

        // Besucher ohne Login: Kirbys normale Regeln gelten
        if ($user === null) {
            return null;
        }

        return $kirby->option('kgs.bereichsrechte', [])[$user->role()->id()] ?? null;
    }

    /**
     * Panel-Pfad einer Seiten-ID: Kirby schreibt Unterseiten mit +
     * (unterricht/herausforderungsprojekt → pages/unterricht+herausforderungsprojekt).
     */
    protected static function panelPath(string $id): string
    {
        return 'pages/' . str_replace('/', '+', $id);
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
