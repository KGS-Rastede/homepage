# Wie UNSERE Homepage runterladen

Kirby ist soweit vorbereitet. Der aktuelle Stand ist bei Git verfügbar. Dann könnt ihr den Code mit folgenden Befehlen runterladen:

## Kirby 6: Entwicklungsstand

Dieses Projekt verwendet **Kirby 6.0.0-beta.1** mit **PHP 8.4 oder 8.5**.
Die genaue Beta-Version ist in `composer.json` festgelegt; `composer.lock` gehört
zum Repository und hält die installierten PHP-Abhängigkeiten reproduzierbar.
`package.json` verwaltet die Frontend-Bibliotheken, nicht Kirby.

Nach dem Checkout bzw. Update:

```console
composer install
composer check-platform-reqs
php scripts/check-kirby.php --content --render
```

Der Check prüft PHP-Syntax, alle Blueprint-YAML-Dateien, das Laden der Seiten- und
Site-Blueprints, bestehende YAML-Listen in Inhalten und ausgewählte Seitenaufrufe
inklusive Sitemap und Panel-Weiterleitung. Ohne `--render` werden keine Seiten
aufgerufen. Beim Rendern können wie bei normalen Seitenaufrufen Cache- und
Mediendateien entstehen. Der Check ersetzt keine Prüfung der Panel-Bedienung.

Die vorhandenen Inhalte verwenden vorerst weiterhin `yaml.handler: spyc` (in der
PHP-Konfiguration als `'yaml.handler' => 'spyc'`). Der Vergleich der Parser fand
in 50 von 320 YAML-Inhaltsfeldern Unterschiede, unter anderem bei unquotierten
Datumswerten. Eine Umstellung auf den neuen Symfony-Parser erfolgt deshalb
separat mit einer gesicherten Inhaltskopie. Die Blueprints sind bereits für
striktes Symfony-YAML bereinigt. Bestehende Sections konvertiert Kirby 6 beim
Laden; entfernte Presets sind durch explizite Listenfelder ersetzt.

### Vor dem Produktivstart im Dezember 2026

Die Beta nur lokal oder auf Staging mit einer Kopie von `content/` verwenden.
Beta-Inhalte nicht zurück auf die Kirby-5-Produktionsseite synchronisieren.
Vor jedem weiteren Update die Release- und Migrationshinweise erneut prüfen.

- Auf eine dann verfügbare stabile Kirby-6-Version wechseln und `composer.lock`
  mit aktualisieren; eine stabile Veröffentlichung im Dezember ist keine Zusage.
- Vollständiges Backup inklusive Inhalt, Accounts und Konfiguration erstellen.
- Login mit allen verwendeten Rollen, zweitem Faktor, Berechtigungen, Uploads,
  Blocks und Live-Vorschau im Browser prüfen. Der Frontend-Login übergibt eine
  erforderliche zweite Authentifizierungsstufe an das Panel.
- Eigenes Panel-CSS visuell prüfen; das Panel benötigt aktuelle Browser
  (Chrome/Edge 124+, Firefox 125+ oder Safari 17.5+).
- Auf Produktion `debug: false` beibehalten und nach dem Deployment Frontend,
  Sitemap, Feeds, Suche, Kalender und Notfallmodus prüfen.
- Falls auf dem Server zusätzliche, hier nicht vorhandene Plugins installiert
  sind, deren Kirby-6-/Vue-3-Kompatibilität vor dem Wechsel prüfen.

Bekannter offener Punkt: `site/blueprints/blocks/tabelle.yml` verwendet das
Plugin-Feld `type: table`. Das zugehörige Plugin ist in diesem Checkout nicht
installiert. Vor der Bearbeitung solcher Tabellen-Blöcke muss eine mit Kirby 6
kompatible Lösung installiert bzw. der Block samt vorhandenen Daten migriert
werden. Die automatischen Checks validieren YAML und Seiten-/Site-Blueprints,
prüfen aber nicht sämtliche verschachtelten Block-Formulare im Panel.

Offizielle Hinweise: [Installation und Anforderungen](https://getkirby.com/releases/6/migration),
[Migration für Seitenentwickler](https://getkirby.com/releases/6/migration/site-developers).

## Welche Software muss vorher installiert werden?

- [composer](https://getcomposer.org/download/)
- WebServer (WAMP, LAMP, XAMPP, etc) oder falls [VS Code](https://code.visualstudio.com/) benutzt wird, die Extension [PHP-Server](https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver)
- PHP 8 (mindestens PHP 8.4)
- [Node.js](https://nodejs.org/) (für TailwindCSS und JS-Abhängigkeiten)
- [git](https://git-scm.com/downloads)
- Ein Editor wie Visual Studio Code oder ZED

_Weitere Details sind unten zu finden._

Wenn alle der vorherigen Punkte erfüllt sind, kann der Code mit folgenden Befehlen in der Console heruntergeladen werden:

```console
git clone https://github.com/KGS-Rastede/homepage
cd homepage
```

Anschließend müsst ihr in Git konfigurieren (mit --global werden diese Login Daten für alle Git Projekte gespeichert).

```console
git config --global user.name "Max Mustermann"
git config --global user.email "max@mustermann.de"
```

Aber Achtung, ihr müsst natürlich _eure Zugangsdaten_ eingeben, nicht die oben genannten.

In Git fehlt ein Unterordner namens 'vendor'. Man muss noch den Befehl

```console
composer install
```

eingeben. Dieser Befehl läd fehlende Abhängkeiten nach. Das dauert ein paar Minuten.

Danach noch die JavaScript-Abhängigkeiten installieren und die Vendor-Dateien in den `assets/`-Ordner kopieren:

```console
npm install
npm run copy
```

Wenn das abgeschlossen ist sollte man im 'localhost' die neue Seite sehen.

# Probleme bei diesen Sachen?

Kein Problem! Wir können uns entweder mal (z.B. in einer Mittagspause) treffen oder ich logge mich per TeamViewer aus der Ferne ein und helfe bei der Installation. Da finden wir Wege.

---

# Hier noch einige Details und Hinweise zu den oben genannten Dingen...

## Sinnvolle Software

### Editor

- Als Editor eignet sich [VS Code](https://code.visualstudio.com/).
- Unter Linux verwende ich schon immer [Vim](https://www.vim.org/), ein besserer Editor kann kaum existieren :-) Mit NeoVim exisitiert eine Variante, die etwas moderner ist.
- Zurecht schwören viele auf [Sublime](https://www.sublimetext.com/)
- [Notepad++](https://notepad-plus-plus.org/) ist ein einfacher zu beherschender Editor, der auf jeden Fall auch ok ist.

### Quellcode verwalten

Um den Quellcode zu verwalten braucht man [Git](https://git-scm.com/). Das kann man einfach installieren, Visual Code kann das dann direkt benutzen. Man (jedenfalls ich) benutzt Git direkt aus VS Code heraus. Auch andere sehr gute Editoren (Vim, Sublime, ...) unterstüzten Git direkt, denn Git ist ein Standard geworden. Jeder benutzt es.

# WebServer (Kurzfassung: Unter Windows WAMP oder Herd installieren!)

Nginx ist heutzutage von vielen bevorzugt. Apache ist natürlich genauso gut. Wir brauchen _keinen MySQL-Server_ (oder irgendeinen anderen Datenbankserver), denn Kirby nutzt intern kein SQL.

## Windows

Windows ist sicherlich nicht direkt für Entwickler erstellt worden. Mittlerweile ist aber Git auch unter Windows gut unterstützt und auch die WebServer laufen ganz gut.
Ich verwende [Wamp64](http://www.wampserver.com/en/download-wampserver-64bits/). Im Wesentlichen muss man dann alles installieren (MySQL gerne weglassen).

## PHP (muss eigentlich nicht direkt installiert werden, kommt mit dem Webserver)

Kirby 6 setzt technisch gesehen PHP 8.3 voraus, wir verwenden aber mindestens PHP 8.4. Die echte Homepage läuft auf PHP 8.4.

Man muss PHP aber nicht direkt installieren, denn PHP kommt als Teil vom Wamp64 mit.

Gegebenfalls muss man aber noch den Pfad ("PATH") unter Windows einrichten. Das folgende Video zeigt, wie das geht. Der korrekte Pfad ist bei meiner Installation:

Über den folgenden Link kann das Video aufgerufen werden: https://youtu.be/83SccoBYSfA?t=80

## DDEV

Ein sehr gute Methode ist [DDEV](https://getkirby.com/docs/cookbook/development-deployment/ddev) mit Docker. Dann muss man weder MAMP noch WAMP etc installieren, alle Pakete sind aktuell. Die Anleitung von Kirby funktioniert super.

```bash
ddev config --php-version=8.4 --omit-containers=db
```

zum Reparieren hat schonmal geholfen:

```bash
sudo launchctl stop com.docker.vmnetd
sudo launchctl unload /Library/LaunchDaemons/com.docker.vmnetd.plist
sudo launchctl load /Library/LaunchDaemons/com.docker.vmnetd.plist
sudo launchctl start com.docker.vmnetd
```

# Git

Die Homepage wird mit Git verwaltet werden. Jeder, der mitmachen möchte, sollte also einen Account bei Github haben. Bitte geh also auf [Github](https://github.com/KGS-Rastede/homepage/) und lege einen Account an

# CSS

Wir müssen natürlich CSS verwenden. [TailwindCSS](https://tailwindcss.com) ist ein sinnvolles, bekanntes System.
Wir haben uns daher für TailwindCSS entschieden. Gute Dokumentation, Anleitungen ohne Ende...

Wir verwenden **TailwindCSS v4**. Im Vergleich zu älteren Versionen gibt es kein `tailwind.config.js` mehr — die Konfiguration erfolgt direkt in der CSS-Datei `assets/css/tailwind.css`.

## npm-Scripts

| Befehl | Wann |
| --- | --- |
| `npm run copy` | Einmalig nach `npm install` — kopiert Vendor-Dateien nach `assets/vendor/` |
| `npm run clean` | Löscht `node_modules/`, `vendor/` und `assets/vendor/` für einen sauberen Neustart |
| `npm run dev` | Beim Entwickeln — TailwindCSS wird automatisch neu gebaut |
| `npm run build` | CSS einmalig bauen (ohne Minify) |
| `npm run build:prod` | Vor dem Deploy — CSS minifiziert bauen |
| `npm run format` | PHP-Dateien mit Prettier formatieren |
| `npm run format:check` | Prettier-Prüfung ohne Änderungen (z.B. für CI) |
| `npm run farben` | Zählt alle verwendeten Tailwind-Farbklassen, gruppiert nach Basisfarbe — hilft, Farb-Wildwuchs (z.B. 10 Stufen Slate) zu erkennen |

Typischer Workflow nach einem sauberen Checkout:

```console
composer install
npm install
npm run copy
npm run dev
```

Vor dem Deploy:

```console
npm run build:prod
```

Sauberer Neustart (löscht alle installierten Abhängigkeiten):

```console
npm run clean
```

## JavaScript-Abhängigkeiten

Das Projekt verwendet folgende JavaScript-Bibliotheken (alle über `npm install` installiert, per `npm run copy` nach `assets/vendor/` kopiert):

- [AlpineJS](https://alpinejs.dev/) — leichtgewichtiges JS-Framework für interaktive Elemente
- [FullCalendar](https://fullcalendar.io/) — Kalenderdarstellung (mit iCal-Unterstützung)
- [Bootstrap Icons](https://icons.getbootstrap.com/) — Icon-Set
