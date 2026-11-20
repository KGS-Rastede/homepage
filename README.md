# Homepage der KGS Rastede

Die Homepage läuft mit dem CMS [Kirby 6](https://getkirby.com), das Design mit [TailwindCSS 4](https://tailwindcss.com). Eine Datenbank gibt es nicht: Kirby speichert alle Inhalte als Textdateien im Ordner `content/`.

Diese Anleitung beschreibt, wie ihr die Homepage auf eurem eigenen Rechner zum Laufen bringt, um daran mitzuarbeiten.

## Schnellstart

### Das wird gebraucht

- **PHP 8.5** und ein lokaler Webserver. Am einfachsten ist [Herd](https://herd.laravel.com) (macOS und Windows), das bringt PHP, Composer und den Webserver in einem Paket mit. Alternativen stehen [weiter unten](#lokaler-webserver).
- [Composer](https://getcomposer.org/download/) (bei Herd schon dabei)
- [Node.js](https://nodejs.org/) für TailwindCSS und die JavaScript-Bibliotheken
- [Git](https://git-scm.com/downloads) und ein Account bei [GitHub](https://github.com)
- ein Editor, z. B. [VS Code](https://code.visualstudio.com/) oder [Zed](https://zed.dev/)

### Herunterladen und einrichten

```console
git clone https://github.com/KGS-Rastede/homepage
cd homepage

composer install     # installiert Kirby (Ordner kirby/ und vendor/)
npm install          # installiert TailwindCSS und die JS-Bibliotheken
npm run copy         # kopiert die JS-Bibliotheken nach assets/vendor/
```

Falls Git euch noch nicht kennt, einmalig eure eigenen Daten eintragen:

```console
git config --global user.name "Vorname Nachname"
git config --global user.email "eure@adresse.de"
```

### Zugangsdaten (secrets.php)

Ein paar Zugangsdaten stehen nicht in Git: der Schlüssel für den IServ-Kalender, der Mapbox-Token für Karten und der API-Key der AG-Wahl. Die Seite läuft auch ohne, nur Kalender, Karten und AG-Angebot bleiben dann leer.

```console
cp site/config/secrets.example.php site/config/secrets.php
```

Die echten Werte bekommt ihr bei Bedarf von mir.

### Starten

Mit Herd: den Ordner `homepage` in Herd als Site hinzufügen (oder in einem von Herd überwachten Ordner ablegen). Die Seite ist dann z. B. unter `http://homepage.test` erreichbar.

Ohne Herd geht es auch mit dem in PHP eingebauten Server:

```console
php -S localhost:8000 kirby/router.php
```

Dann die Seite unter <http://localhost:8000> öffnen.

### Anmelden im Panel

Das Panel (die Redaktionsoberfläche) liegt lokal unter `/panel`, auf dem Live-Server unter `/intern`. Benutzerkonten stehen nicht in Git. Beim ersten Aufruf von `/panel` bietet Kirby daher an, ein Admin-Konto anzulegen. Das gilt nur für eure lokale Kopie.

Lokal ist die Zwei-Faktor-Anmeldung aus, auf dem Live-Server ist sie Pflicht.

## Inhalte und Live-Server

- Der Ordner `content/` ist in Git, damit ihr lokal echte Inhalte habt. **Gepflegt werden die Inhalte aber live im Panel.** Lokale Änderungen an `content/` werden nicht hochgeladen. Sie würden sonst Änderungen der Redaktion überschreiben.
- Den aktuellen Stand einzelner Bereiche vom Server holen: `npm run pull-blog`, `pull-faecher`, `pull-unterricht`, `pull-kontakte`, `pull-presse`. Der Server ist nur per SFTP erreichbar, die Skripte benutzen dafür `lftp`. Zugang zum Server gibt es nur nach Absprache.
- Code (Templates, Blueprints, Plugins, CSS) geht über GitHub: Branch anlegen, Änderungen committen, Pull Request stellen.

## CSS und JavaScript

Wir verwenden **TailwindCSS 4**. Eine `tailwind.config.js` gibt es nicht mehr, die Konfiguration steht direkt in `assets/css/tailwind.css`. Tailwind durchsucht den Ordner `site/` nach benutzten Klassen. Klassen müssen deshalb im Code vollständig ausgeschrieben sein (`md:col-span-8`, nicht `md:col-span-<?= $n ?>`).

Gebaut werden zwei Dateien:

- `assets/css/twkgs_shrinked.css`: lesbar, wird lokal benutzt (Debug-Modus) und ist in Git
- `assets/css/twkgs_shrinked.min.css`: minifiziert, wird auf dem Live-Server benutzt, ist nicht in Git

### npm-Befehle

| Befehl | Wann |
| --- | --- |
| `npm run copy` | einmalig nach `npm install`: kopiert die JS-Bibliotheken nach `assets/vendor/` |
| `npm run dev` | beim Entwickeln: baut das CSS bei jeder Änderung automatisch neu |
| `npm run build` | baut beide CSS-Dateien einmal (lesbar und minifiziert) |
| `npm run build:prod` | baut nur die minifizierte Datei für den Live-Server |
| `npm run format` | formatiert die PHP-Dateien in `site/` mit Prettier |
| `npm run format:check` | prüft die Formatierung, ohne etwas zu ändern |
| `npm run farben` | zählt die benutzten Tailwind-Farbklassen, um Farb-Wildwuchs zu erkennen |
| `npm run clean` | löscht `node_modules/`, `vendor/` und `assets/vendor/` für einen sauberen Neustart |

### JavaScript-Bibliotheken

Alle kommen über `npm install` und werden mit `npm run copy` nach `assets/vendor/` kopiert:

- [AlpineJS](https://alpinejs.dev/) für interaktive Elemente (z. B. das mobile Menü)
- [FullCalendar](https://fullcalendar.io/) für den Schulkalender
- [Bootstrap Icons](https://icons.getbootstrap.com/) als Icon-Set

## Vor dem Hochladen prüfen

Zwei Skripte testen die ganze Seite automatisch, damit niemand jede Seite von Hand anklicken muss. Beide arbeiten auf einer Kopie des Projekts im Temp-Ordner und ändern nichts an euren Dateien.

```console
php scripts/kirby6/smoke-test.php          # Frontend, Links, Panel-Ansichten, Bereichsrechte (ca. 25 s)
php scripts/kirby6/panel-smoke-test.php    # Panel über echten Login, pro Rolle (ca. 1 min)
```

Mit `--hilfe` zeigen beide ihre Optionen. Gemeldet werden z. B. PHP-Fehler, kaputte Seiten, tote Links, Fehlerboxen im Panel und Seiten, die eine eingeschränkte Rolle nicht sehen dürfte.

## Wo was liegt

| Ordner | Inhalt |
| --- | --- |
| `site/blueprints/` | Aufbau der Eingabemasken im Panel: Seiten (`pages/`), Blöcke (`blocks/`), wiederverwendbare Felder (`fields/`), Rollen (`users/`) |
| `site/templates/` | PHP-Vorlagen für die Seiten. Vorlagen ohne eigene Datei benutzen `default.php`. |
| `site/snippets/` | wiederverwendbare Teile, z. B. `inhalt.php` (Layout mit Spalten), `blocks/` für die Ausgabe der Blöcke |
| `site/plugins/` | eigene Plugins: `bereichsrechte` (welche Rolle welche Seiten bearbeiten darf), `kalender` (IServ-Kalender) |
| `site/config/` | `config.php` (lokal), `config.kgs-rastede.de.php` (zusätzlich auf dem Live-Server), `secrets.php` (nicht in Git) |
| `assets/` | CSS, Schriften, Bilder, kopierte JS-Bibliotheken |
| `scripts/` | Hilfsskripte, u. a. die Smoke-Tests in `scripts/kirby6/` |

Die Kirby-Dokumentation ist sehr gut: <https://getkirby.com/docs>.

## Lokaler Webserver

**Herd** (empfohlen, macOS und Windows): bringt PHP 8.5, Composer und den Webserver mit, Einrichtung in wenigen Minuten. <https://herd.laravel.com>

**PHP-Server**: `php -S localhost:8000 kirby/router.php` reicht zum Arbeiten völlig. Dafür muss PHP 8.5 installiert sein.

**DDEV** mit Docker: alles läuft in Containern, nichts muss direkt installiert werden. Die [Anleitung von Kirby](https://getkirby.com/docs/cookbook/development-deployment/ddev) funktioniert gut. Eine Datenbank braucht Kirby nicht:

```console
ddev config --php-version=8.5 --omit-containers=db
```

## Probleme?

Kein Problem! Meldet euch, dann treffen wir uns (z. B. in einer Mittagspause) und richten es zusammen ein.
