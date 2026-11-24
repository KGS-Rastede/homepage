# Herausforderungsprojekt (HFP): vom Provisorium zum Modul

## Context

Das HFP-Modul besteht heute aus drei Blueprints und drei Templates ohne eigene Logik. Die Analyse zeigt, warum es 2025 faktisch nicht mehr benutzt wurde (alle 14 Gruppen verlinken auf externe Edumaps, nur 23 Bilder statt 372 im Vorjahr):

- **Jahr anlegen**: kein Dialog, keine Felder für Jahr/Zeitraum. Der Text wird von Hand kopiert, die Übersichtsseite zeigt die Jahre gar nicht an (`herausforderungsprojekt.php` listet keine Kinder, ihr Text steht noch auf „2023 ist gestartet“). Unter dem Projekt liegt zusätzlich eine verwaiste `herausforderungsprojekt-jahrgang.txt`.
- **Gruppen**: `teamfarbe` verweist auf CSS-Klassen, die es nicht gibt (`teamfarbe1`, `bs-teamfarbe*`, doppelte Labels). Die Jahresseite liest `heading()`, das Feld heißt aber `kurzname`. `teamlogo()->toFile()->url()` bricht ohne Logo mit einem Fehler ab. Bilder werden in Originalgröße ausgeliefert.
- **Karte**: Koordinaten müssen als Text eingetippt werden, verschachtelt als Block im Block (`reiseroute` → `koordinate`). Genutzt wurde das genau einmal (2022). `koordinate.php` gibt Debug-Text aus („IN DER koordinaten“), `reiseroute-simple.php` braucht einen Mapbox-Token, den es nicht gibt, und vertauscht Breite/Länge. Leaflet kommt von unpkg (Drittanbieter-Request ohne Einwilligung).
- **Rechte**: Rolle `hfp` darf Seiten weder löschen noch den Slug ändern, also keine echte Gruppenverwaltung.

Entscheidungen aus der Rückfrage: Pflege bleibt beim HFP-Team im Panel; Koordinaten per Kartenklick/Ortssuche; erster Ausbau = Jahreskarte aller Gruppen + neue Startseite mit Archiv; 2022–2025 werden migriert.

Ziel: ein eigenes Plugin `site/plugins/hfp` (Muster wie `bereichsrechte`/`kalender`), das Datenmodell, Panel-Komfort und Karten bündelt. Feldnamen bleiben wo möglich gleich, damit die Migration klein bleibt.

## Datenmodell

Seitenstruktur bleibt: `unterricht/herausforderungsprojekt` → Jahr → Gruppe.

**Jahr** (`herausforderungsprojekt-jahrgang`), neu: `jahr` (number), `start`, `ende` (date), `titelbild` (files, max 1); `text` bleibt.
Status wird berechnet, nicht gepflegt: *Planung* (vor `start`), *Unterwegs*, *Abgeschlossen*.

**Gruppe** (`herausforderungsprojekt-gruppenansicht`), in Tabs:
- *Steckbrief*: `kurzname` (bleibt, ohne Mindestlänge 10), `teamlogo` (bleibt, nicht mehr Pflicht), `teamfarbe` (neu als `color`-Feld mit 8 festen Hex-Optionen), `text` (Blocks, ohne `koordinate`/`reiseroute`)
- *Route*: `stationen` (structure): `datum`, `ort` (neuer Feldtyp `hfp-ort`, speichert `name`, `lat`, `lng`), `foto` (files, max 1), `notiz` (text)
- *Fotos*: `gallery` (bleibt)

## Umsetzung

### 1. Plugin `site/plugins/hfp`
- `index.php`: `load()` + `Kirby::plugin('kgs/hfp', …)` nach Vorbild [site/plugins/bereichsrechte/index.php](../site/plugins/bereichsrechte/index.php)
- `src/JahrPage.php`, `src/GruppePage.php`: Page-Models, **erben von `Kgs\Bereichsrechte\BereichsPage`** (sonst greifen die Bereichsrechte nicht, siehe Kommentar in `BereichsPage.php`). Methoden: `JahrPage::status()`, `gruppen()`, `kartenDaten()`; `GruppePage::stationen()` (sortiert, nur gültige Koordinaten), `aktuelleStation()` (letzte Station ≤ heute), `farbe()` (Fallback aus Palette nach Position), `logo()` (nullsicher).
- Registrierung über `pageModels` im Plugin.
- `src/Hfp.php`: `aktuellesJahr()` (jüngstes gelistetes Jahr), Farbpalette.

### 2. Neues Jahr anlegen (ein Dialog)
- [herausforderungsprojekt-jahrgang.yml](../site/blueprints/pages/herausforderungsprojekt-jahrgang.yml): `create:` mit `fields: [jahr, start, ende]`, `title: "Herausforderungsprojekt {{ page.jahr }}"`, `slug: "herausforderungsprojekt-{{ page.jahr }}"`, `status: unlisted` (von Kirby 5 unterstützt, `kirby/src/Panel/PageCreateDialog.php`).
- Hook `page.create:after` im Plugin: füllt `text` des neuen Jahres mit dem Standardtext aus einem neuen Feld `jahrestext_vorlage` der HFP-Hauptseite (statt Copy-and-paste aus dem Vorjahr).
- [herausforderungsprojekt.yml](../site/blueprints/pages/herausforderungsprojekt.yml): `pages`-Section auf Template `herausforderungsprojekt-jahrgang` beschränkt, `sortBy: jahr desc`, `info: "{{ page.status }} · {{ page.children.count }} Gruppen"`.

### 3. Gruppenverwaltung
- Jahres-Blueprint: Gruppen-Section als `layout: cards` mit Logo, Farbe und Stationszahl; `create:` der Gruppe fragt nur Titel + Kurzname.
- **„Mehrere Gruppen anlegen“**: View-Button im Jahr (Blueprint `buttons:`), der einen Dialog öffnet (Textarea, ein Gruppenname pro Zeile). Button und Dialog rein in PHP über `areas` → `buttons`/`dialogs` des Plugins (`kirby/src/Panel/Ui/Buttons/ViewButton.php` unterstützt `dialog`), Submit legt die Seiten per `createChild()` an und vergibt Farben reihum.
- Rechte: in Gruppen- und Jahres-Blueprint `options: { delete: { hfp: true }, changeSlug: { hfp: true }, duplicate: { hfp: true } }`. [site/blueprints/users/hfp.yml](../site/blueprints/users/hfp.yml) bleibt restriktiv für alles andere.

### 4. Feldtyp `hfp-ort` (Kartenklick + Ortssuche)
- `site/plugins/hfp/index.js` + `index.css`, **handgeschrieben mit Render-Funktionen**, weil `panel.vue.compiler` aus ist und es keinen Panel-Build gibt.
- Leaflet-Karte im Feld: Klick setzt Marker, Marker ist verschiebbar; Suchzeile darüber.
- Ortssuche über Plugin-API-Route `hfp/ortssuche?q=` (nur eingeloggt), die serverseitig Nominatim per `Remote::get` abfragt (eigener User-Agent, Ergebnis im Kirby-Cache). So geht kein Request aus dem Browser an Dritte.
- Leaflet lokal: `leaflet` in `package.json`, Kopie nach `assets/vendor/leaflet/` über [scripts/copy-vendor.js](../scripts/copy-vendor.js).

### 5. Frontend
- `assets/js/hfp-karte.js`: ein Modul für Gruppen- und Jahreskarte (Linie in Teamfarbe, Stationsmarker mit Popup aus Datum/Ort/Foto, „aktueller Standort“ mit Teamlogo, Zoom auf alles). Daten kommen als JSON aus dem Template.
- Snippet `site/snippets/hfp/karte.php`: Karte lädt erst nach Klick („Karte laden“, Hinweis auf OpenStreetMap), da Kacheln von `tile.openstreetmap.org` kommen.
- [herausforderungsprojekt.php](../site/templates/herausforderungsprojekt.php): aktuelles Jahr groß (Status, Zeitraum, Link), darunter Archiv-Kacheln aller Jahre mit Titelbild und Gruppenzahl, dann der bestehende Text und die Blogberichte.
- [herausforderungsprojekt-jahrgang.php](../site/templates/herausforderungsprojekt-jahrgang.php): Statuszeile, Jahreskarte, Gruppenkacheln (nullsicheres Logo, `kurzname`, Thumbs per `->crop()`).
- [herausforderungsprojekt-gruppenansicht.php](../site/templates/herausforderungsprojekt-gruppenansicht.php): Kopf in Teamfarbe mit Logo, Karte, Stationsliste, Galerie mit Thumbs + `alt`/`ort`/`beschreibung`, Vor/Zurück zu Nachbargruppen.
- Tailwind-Klassen wie im Bestand; Teamfarbe als Inline-CSS-Variable, da dynamische Klassen nicht gebaut würden. Danach `npm run build`.

### 6. Aufräumen
- `koordinate`/`reiseroute` aus den Gruppen-Fieldsets entfernen. Der Block `reiseroute` bleibt für die Anfahrt-Seite, bekommt aber lokales Leaflet statt unpkg.
- `reiseroute-simple` (Blueprint + Snippet, Mapbox) löschen, wenn die Migration keinen Treffer mehr findet (aktuell 0 Verwendungen); Debug-Ausgabe in `koordinate.php` entfernen.
- Verwaiste `content/unterricht/herausforderungsprojekt/herausforderungsprojekt-jahrgang.txt` löschen.

### 7. Migration 2022–2025
`scripts/hfp-migration.php` (CLI, wie `scripts/presse-aufteilen.php`), idempotent, mit `--dry-run`:
- Jahre: `jahr` aus dem Slug, `start`/`ende` leer lassen bzw. aus Parametern.
- Gruppen: ungültige `teamfarbe`-Werte durch Palettenfarbe ersetzen; `reiseroute`-Block (1× in 2022) in `stationen` überführen und aus `text` entfernen.
- Edumaps-Links 2025 bleiben im Text.

**Wichtig:** Inhalte liegen auf dem Live-Server. Vor der Migration `npm run pull-unterricht`, danach Ergebnis prüfen und hochladen; die Migration nicht auf veraltetem lokalem Stand laufen lassen.

## Reihenfolge (jeweils eigener PR)
1. Plugin-Gerüst, Models, Blueprints, Rechte, Jahr-Dialog, Sammelanlage
2. Feldtyp `hfp-ort` + Ortssuche
3. Frontend (drei Templates, Kartenmodul)
4. Migration + Aufräumen

## Verifikation
- Dev-Server `kirby` aus `.claude/launch.json` (Port 8321) starten.
- Panel als Rolle `hfp`: neues Jahr 2026 über den Dialog anlegen → Titel, Slug, Standardtext stimmen; fünf Gruppen per Sammeldialog; eine Gruppe löschen/umbenennen; Zugriff außerhalb des Bereichs bleibt gesperrt.
- Gruppe: Ort suchen („Cuxhaven“), per Klick korrigieren, drei Stationen speichern → `stationen` im Content prüfen.
- Frontend: Gruppenkarte und Jahreskarte laden erst nach Klick, keine Requests an unpkg/Mapbox (Netzwerk-Tab), Gruppe ohne Logo und ohne Stationen rendert fehlerfrei, Konsole leer, mobile Ansicht.
- Migration mit `--dry-run`, dann echt; alle 64 Altgruppen und die Anfahrt-Seite stichprobenartig aufrufen.
- `npm run format:check`.

## Nicht im ersten Ausbau
Tagebuch/Zeitstrahl, Steckbrief-Statistik, GPX-Import, EXIF-Standort, Gruppen-Logins, Handy-Upload. Das Datenmodell (`stationen` mit Datum, Foto, Notiz) ist so gewählt, dass Tagebuch und GPX später ohne weitere Migration dazukommen.
