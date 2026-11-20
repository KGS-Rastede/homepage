# Umstieg auf Kirby 6

Stand: 20.11.2026, Branch `kirby6port` läuft mit Kirby 6.0.0-rc.2.
Quellen: Migrationsseiten für Site- und Plugin-Entwickler und das Changelog
unter <https://getkirby.com/releases/6>.

## Erledigt

- [x] Presets durch explizite Sections ersetzt (`2d9f003e`)
- [x] Upload-Verkleinerung über `$file->manipulate()` (`4889a870`)
- [x] Blueprints für den strengeren YAML-Parser bereinigt (`9dd86e51`)
- [x] Skripte zum Prüfen und Korrigieren des Contents (`cb5208db`)
- [x] Bereichsrechte als Plugin statt `route:before`-Hook (`1d109899`)

## Jetzt schon mit Kirby 5 erledigen

- [x] **Frontend-Login entfernen.** Dazu gehören `site/controllers/login.php`,
      `content/login/` und `site/blueprints/pages/login.yml`.
      Das ist ein alter Frontend-Login. Es gibt dafür kein Template und kein
      Formular, er ist also tot. Der Panel-Login ist davon nicht betroffen.
      Das Panel liegt lokal unter `/panel` und live unter `/intern`
      (`panel.slug` in `config.kgs-rastede.de.php`). Bekäme der Controller je wieder ein Template, würde
      `auth()->login()` die 2FA umgehen. In Kirby 6 bräuchte er
      `auth()->authenticate()`.
- [x] **Namenskollision in `pages/countdown.yml`:** Die Section `countdowns`
      und das Feld `countdowns` haben denselben Namen. In Kirby 6 teilen sich
      Sections und Felder einen Namensraum, das ergibt eine Fehlerbox.
      Die Section umbenennen, z. B. in `liste`.
- [x] **Panel-CSS:** `--color-background` entfernt. Kirby setzt die Variable
      nur als Alias auf `--panel-color-back`, das Überschreiben hatte schon
      unter Kirby 5 keine Wirkung. Die ungenutzte, veraltete
      `custom-panel.min.css` ist gelöscht.
- [ ] Beim Umstieg prüfen, ob die Selektoren in `custom-panel.css` noch
      greifen: `.k-tabs`, `.k-header`, `.k-login-view` (Login ist in Kirby 6
      neu gebaut), `.k-icon-key`.
- [x] **Rollen nur an einer Stelle pflegen:** `panel.home` und
      `panel.menu` werden aus `kgs.bereichsrechte` abgeleitet (erster
      Bereich = Startseite, Reihenfolge = Menü). Bezeichnung und Icon stehen
      einmal pro Bereich in `kgs.bereiche`.
- [x] **Smoke-Test-Skript** (`scripts/kirby6/smoke-test.php`, Aufruf und
      Optionen im Kopf der Datei). Prüft Frontend inkl. aller Links,
      Panel-Ansichten aller Seiten/Dateien/Vorlagen und die Bereichsrechte
      jeder Rolle, optional Vergleich mit einer Kirby-5-Referenz. Läuft auf
      einer Kopie des Projekts, weil Kirby beim Prüfen UUIDs in den
      Content schreibt.
- [x] **Panel-Smoke-Test** (`scripts/kirby6/panel-smoke-test.php`): meldet
      Admin und jede Rolle über das echte Login an und ruft per HTTP alle
      Ansichten, Dialoge, Dropdowns, Listen, Picker, Block-Formulare und
      die Suche auf (ca. 24.000 Anfragen, 1 Minute; `--schnell` 20 s).
- [ ] Optional: Bei unerlaubtem Panel-Zugriff wieder auf die Startseite der
      Rolle weiterleiten. Das hat der alte Hook gemacht, das Plugin macht es
      nicht.

## Befunde des Smoke-Tests (20.11.2026)

- [ ] **Panel-Startseite der Rollen greift nicht** (Panel-Smoke-Test,
      auch unter Kirby 5 so): Die Option `panel.home` in `config.php`
      gibt es in Kirby nicht, Kirby liest die Startseite nur aus `home:`
      im Benutzer-Blueprint. Eingeschränkte Rollen landen daher auf
      `/panel/site`. `erasmus.yml` hat `home: pages/unterricht+erasmus`
      ohne Panel-Pfad und leitet ins Frontend (404). Lösung z. B.:
      `home: "{{ kirby.url('panel') }}/pages/blogs"` pro Rolle (Panel-Slug
      ist live `intern`) oder eine User-Method im Bereichsrechte-Plugin,
      damit `kgs.bereichsrechte` die einzige Quelle bleibt.

- [x] **Blogkarten:** `site/snippets/blogkarte-bild.php:41` ruft
      `$block->karousel()->first()` auf. Die Field-Method `first` gibt es
      nicht, Kirby 5 hat das ignoriert, Kirby 6 bricht ab. Folge: Status 500
      auf `/blogs/page:28` und den Tag-Filtern Ukraine, Sofa-Team,
      Schülerfirmen, Demokratiebildung u. a. Ersatz: `->toFile()`.
- [ ] **Content-Fix nötig, betrifft mehr als gedacht:** `content-check.php`
      hat Picker-Felder (`pages`, `files`, `users`) bisher nicht geprüft.
      Mit Kirby 6 bekommen lange IDs in `- >`-Blöcken einen Zeilenumbruch
      und werden nicht mehr gefunden. 19 Felder in 18 Dateien, sichtbar z. B.
      bei GSW (Erdkunde, Geschichte, Religion fehlen), Englisch (Lehrplan)
      und Schulsport (NWZ-Artikel). `content-fix.php` behebt alle.
- [x] **Block „Tabelle“ entfernt.** Er brauchte das Plugin `table-field`,
      das seit November 2024 gelöscht ist (`e86d6e80`). Dadurch gab es eine
      Fehlerbox auf jeder Seite mit Blocks-Feld (435 Stellen). Ein Snippet
      gab es auch nicht, die Tabelle war also im Frontend unsichtbar.
      `tabelle.yml` ist gelöscht und aus den 9 Seiten-Blueprints entfernt.
      Die einzige Nutzung („Kunstarten“, Kunst-Seite) ist jetzt ein
      Markdown-Block mit Markdown-Tabelle (Markdown Extra ist an).
      **Live:** Dort muss der Block auf der Kunst-Seite ebenfalls ersetzt
      werden, sonst bleibt er ein unbekannter Block.
- [ ] Tote interne Links, mit `-v` alle anzeigen. Darunter steht
      `herausforderungsprojekt-2026` (auf fast jeder Seite verlinkt, aber 404)
      und ein toter `/@/file/…`-Permalink im Hallenplan-Blog.

- [ ] **Blogbeitrag „Einrichten der Homepage“** (`blogs/einrichten-der-homepage`,
      2021, nicht gelistet, aber öffentlich erreichbar) ist komplett veraltet:
      GitLab statt GitHub, Discord-Einladung, WAMP, `chmod 777`. Im
      Live-Panel auf Entwurf setzen oder löschen (nicht lokal, der Content
      wird live gepflegt).
- [ ] **README aktualisieren** als Ersatz für den Beitrag: GitHub
      (`KGS-Rastede/homepage`), Herd statt WAMP, PHP 8.5, Kirby 6,
      Smoke-Test.

## Beim Umstieg

- [ ] Auf die stabile 6.0.0 warten und ihr Changelog gegen diese Liste prüfen.
- [x] PHP 8.5 auf dem IONOS-Server: ist umgestellt.
- [ ] Content frisch vom Server holen, `php scripts/kirby6/content-check.php`
      und `php scripts/kirby6/content-fix.php --write` ausführen, geänderte
      Dateien sofort hochladen.
- [ ] **Picker-Felder umbenennen:** In 63 Fällen `type: pages`, `files` bzw.
      `users` ersetzen durch `pagepicker`, `filepicker` bzw. `userpicker`.
      Die alten Namen sind veraltet. Die neuen Namen kennt Kirby 5 nicht,
      deshalb geht das erst beim Umstieg. Ermitteln lassen sich die Stellen
      mit der Unterscheidung Feld/Section aus der Analyse vom 16.11.
- [ ] **Sections:** 27 Sections vom Typ `pages`/`files` werden automatisch
      konvertiert. Später gezielt umschreiben: `pagelist` bzw. `filelist`
      statt `pages`/`files`, `label` statt `headline`, Felder aus
      `type: fields`-Sections direkt in die Spalte bzw. den Tab.
- [x] **Bereichsrechte-Plugin auf Guards umstellen** (`de887258`):
      `$model->permissions()` und `PagePermissions` sind veraltet,
      der Ersatz ist `$model->guards()`. Mit RC 1 nachsehen, wie man Guards
      in einem Page-Model überschreibt. Prüfen, ob sich `isAccessible()`
      geändert hat: Laut Doku hängt es „bis v6“ an der Option `read`.
      Danach jede eingeschränkte Rolle im Panel durchklicken.
- [ ] **Auth auf dem Live-Server** (`config.kgs-rastede.de.php`):
      Ziel: 2FA ist live Pflicht für alle, lokal und auf Testservern aus.
      In Kirby 6 bedeutet `'2fa' => true` genau „Pflicht für alle“, die
      Einstellung bleibt also. Lokal bleibt die Option weg. Dann ist die
      2FA lokal optional, d. h. jeder Benutzer kann selbst einen zweiten
      Faktor einrichten. So soll es sein, weil man die 2FA damit lokal
      testen kann.
- [ ] **Passkeys** (`webauthn` in `auth.methods`) einführen: gewünscht,
      viele im Kollegium nutzen macOS (Touch ID, iCloud-Schlüsselbund).
      Brauchen HTTPS, lokal also mit Herd-TLS testen.
- [ ] Redaktion vorwarnen: Kirby 6 signiert Cookies neu, deshalb müssen sich
      alle einmal neu anmelden. Login geht nur noch per E-Mail-Adresse.
- [ ] Smoke-Test laufen lassen, vorher eine Kirby-5-Referenz speichern
      (Anleitung im Kopf von `smoke-test.php`).
- [ ] AG-Model prüfen: `Mime::toExtension()` und das Abrufen der
      AG-Daten testen. `Mime` liefert jetzt IANA-Typen.
- [ ] Blöcke im Panel durchklicken. Eigene Vue-Previews gibt es nicht,
      trotzdem prüfen, ob alle Blöcke korrekt angezeigt werden.
- [ ] Textfelder: Die Rechtschreibprüfung ist jetzt standardmäßig an.
      Bei Bedarf `spellcheck: false` setzen.

## Geprüft, betrifft uns nicht

- Eigene Panel-Plugins mit Vue/JS, eigene Sections und Felder als Arrays:
  gibt es nicht.
- Plugins von Dritten: gibt es nicht. `site/plugins/sprechtag` ist leer.
- Iterator-Methoden (`current()`, `next()` usw.) an Collections: nicht
  verwendet.
- Entfernte Content-Methoden (`readContent()`, `isLocked()` usw.),
  `Url::to()`, alte Klassennamen, Exceptions mit Array-Argument,
  KirbyTag-Optionen, `push`/`stack`/`$slots`: nicht verwendet.
- Queries mit Bindestrichen oder Backslashes in Blueprints: keine.
- Option `options: query`/`api` in alter Schreibweise, `yes`/`no` in YAML,
  Tabs: keine.
- `video`-KirbyTag mit `style`: nicht im Content.
