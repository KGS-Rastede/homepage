# Umstieg auf Kirby 6

Stand: 16.11.2026, Kirby 6 Beta 4. Portiert wird mit RC 1.
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
- [ ] **Panel-CSS:** Die Variable `--color-background` in
      `assets/css/custom-panel.css:69` gibt es in Kirby 6 nicht mehr.
      Den Ersatz von der Migrationsseite einsetzen und `.min.css` neu bauen.
- [ ] **Rollen nur an einer Stelle pflegen:** `panel.home`, `panel.menu`
      und `kgs.bereichsrechte` in `config.php` führen dieselben Rollen und
      Bereiche dreimal. Besser alles aus einer Struktur ableiten, z. B.
      Bereiche plus Startseite plus Menüpunkte pro Rolle. Das verringert
      außerdem den Aufwand, falls sich `panel.menu` in Kirby 6 ändert.
- [ ] **Smoke-Test-Skript** (`scripts/kirby6/smoke-test.php`): alle Seiten
      lokal rendern und Exceptions oder Statuscodes ungleich 200 melden.
      Damit lässt sich jetzt ein Referenzstand festhalten und nach dem
      Umstieg vergleichen. Wichtig ist das wegen dieser Änderung in
      Kirby 6: Unbekannte Field-Methods werfen eine `BadMethodCallException`,
      statt still das Feld zurückzugeben.
- [ ] Optional: Bei unerlaubtem Panel-Zugriff wieder auf die Startseite der
      Rolle weiterleiten. Das hat der alte Hook gemacht, das Plugin macht es
      nicht.

## Beim Umstieg (RC 1)

- [ ] Auf einer Kopie arbeiten, mit Backup von `content/`.
- [ ] `composer require getkirby/cms:6.0.0-rc.1`
- [ ] Changelog von RC 1 gegen diese Liste prüfen.
- [ ] `php scripts/kirby6/content-check.php` und bei Bedarf
      `php scripts/kirby6/content-fix.php` ausführen.
- [ ] **Picker-Felder umbenennen:** In 63 Fällen `type: pages`, `files` bzw.
      `users` ersetzen durch `pagepicker`, `filepicker` bzw. `userpicker`.
      Die alten Namen sind veraltet. Die neuen Namen kennt Kirby 5 nicht,
      deshalb geht das erst beim Umstieg. Ermitteln lassen sich die Stellen
      mit der Unterscheidung Feld/Section aus der Analyse vom 16.11.
- [ ] **Sections:** 27 Sections vom Typ `pages`/`files` werden automatisch
      konvertiert. Später gezielt umschreiben: `pagelist` bzw. `filelist`
      statt `pages`/`files`, `label` statt `headline`, Felder aus
      `type: fields`-Sections direkt in die Spalte bzw. den Tab.
- [ ] **Bereichsrechte-Plugin auf Guards umstellen:**
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
      testen kann. Danach entscheiden, ob Passkeys
      (`webauthn`) in `auth.methods` aufgenommen werden. Sie brauchen HTTPS.
- [ ] Redaktion vorwarnen: Kirby 6 signiert Cookies neu, deshalb müssen sich
      alle einmal neu anmelden. Login geht nur noch per E-Mail-Adresse.
- [ ] Smoke-Test laufen lassen und mit dem Referenzstand vergleichen.
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
