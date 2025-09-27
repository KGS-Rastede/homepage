# Wie UNSERE Homepage runterladen

Kirby ist soweit vorbereitet. Der aktuelle Stand ist bei Git verfügbar. Dann könnt ihr den Code mit folgenden Befehlen runterladen:

## Welche Software muss vorher installiert werden?

- [composer](https://getcomposer.org/download/)
- WebServer (WAMP, LAMP, XAMPP, etc) oder falls [VS Code](https://code.visualstudio.com/) benutzt wird, die Extension [PHP-Server](https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver)
- PHP 8 (mindestens PHP 8.3)
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

eingeben. Dieser Befehl läd fehlende Abhängkeiten nach. Das dauert ein paar Minuten. Wenn das abgeschlossen ist sollte man im 'localhost' die neue Seite sehen.

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

Um den Quellcode zu verwalten braucht man [Git](https://git-scm.com/). Das kann man einfach installieren, Visual Code kann das dann direkt benutzen. Man (jedenfalls ich) benutzt Git direkt aus VS Code heraus. Auch andere sehr gute Editoren (Vim, Sublime, Atom, ...) unterstüzten Git direkt, denn Git ist ein Standard geworden. Jeder benutzt es.

# WebServer (Kurzfassung: Unter Windows WAMP installieren!)

Nginx ist heutzutage von vielen bevorzugt. Apache ist natürlich genauso gut. Wir brauchen _keinen MySQL-Server_ (oder irgendeinen anderen Datenbankserver), denn Kirby nutzt intern kein SQL.

## Windows

Windows ist sicherlich nicht direkt für Entwickler erstellt worden. Mittlerweile ist aber Git auch unter Windows gut unterstützt und auch die WebServer laufen ganz gut.
Ich verwende [Wamp64](http://www.wampserver.com/en/download-wampserver-64bits/). Im Wesentlichen muss man dann alles installieren (MySQL gerne weglassen).

## PHP (muss eigentlich nicht direkt installiert werden, kommt mit dem Webserver)

Kirby setzt technisch gesehen PHP8 voraus. Die echte Homepage läuft schon auf PHP 8.3.

Man muss PHP aber nicht direkt installieren, denn PHP kommt als Teil vom Wamp64 mit.

Gegebenfalls muss man aber noch den Pfad ("PATH") unter Windows einrichten. Das folgende Video zeigt, wie das geht. Der korrekte Pfad ist bei meiner Installation:

Über den folgenden Link kann das Video aufgerufen werden: https://youtu.be/83SccoBYSfA?t=80

## DDEV

Ein sehr gute Methode ist [DDEV](https://getkirby.com/docs/cookbook/development-deployment/ddev) mit Docker. Dann muss man weder MAMP noch WAMP etc installieren, alle Pakete sind aktuell. Die Anleitung von Kirby funktioniert super.

```bash
ddev config --php-version=8.3 --omit-containers=db
```

zum Reparieren hat schonmal geholfen:

```bash
sudo launchctl stop com.docker.vmnetd
sudo launchctl unload /Library/LaunchDaemons/com.docker.vmnetd.plist
sudo launchctl load /Library/LaunchDaemons/com.docker.vmnetd.plist
sudo launchctl start com.docker.vmnetd
```

# Git

Die Homepage wird mit Git verwaltet werden. Jeder, der mitmachen möchte, sollte also einen Account bei Gitlab haben. Bitte geh also auf [Gitlab](https://gitlab.com/cniehaus/homepage) lege einen Account an

# CSS

Wir müssen natürlich CSS verwenden. [TailwindCSS](https://tailwindcss.com) ist ein sinnvolles, bekanntes System.
Wir haben uns daher für TailwindCSS entschieden. Gute Dokumentation, Anleitungen ohne Ende...
