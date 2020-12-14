# Wie UNSERE Homepage runterladen
Ich habe Kirby soweit vorbereitet. Der aktuelle Stand ist bei Git verfügbar. Dann könnt ihr den Code mit folgenden Befehlen runterladen:

## Vorher ist folgende Software zu installieren

+ composer (https://getcomposer.org/download/)
+ WebServer (WAMP, LAMP, ...)
+ PHP 7 (empfohlen ist PHP 7.4)
+ git
+ ein guter Editor  (Visual Studio Code, Atom, ...)

*Weitere Details sind unten zu finden.*


In der Konsole muss zum herunterladen der Homepage nun folgendes eingegeben werden:

```console
git clone https://gitlab.com/cniehaus/homepage
cd homepage
git config --global user.name "Max Mustermann"
git config --global user.email "max@mustermann.de"
```

Aber Achtung, ihr müsst natürlich *eure Zugangsdaten* eingeben, nicht die oben genannten.

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
* Als Editor eignet sich [VS Code](https://code.visualstudio.com/).
* Unter Linux verwende ich schon immer [Vim](https://www.vim.org/), ein besserer Editor kann kaum existieren :-)
* [Atom](https://atom.io/) ist auch super, technisch VS Code sehr ähnlich
* Zurecht schwören viele auf [Sublime](https://www.sublimetext.com/)
* [Notepad++](https://notepad-plus-plus.org/) ist ein einfacher zu beherschender Editor, der auf jeden Fall auch ok ist. 

### Quellcode verwalten
Um den Quellcode zu verwalten braucht man [Git](https://git-scm.com/). Das kann man einfach installieren, Visual Code kann das dann direkt benutzen. Man (jedenfalls ich) benutzt Git direkt aus VS Code heraus. Auch andere sehr gute Editoren (Vim, Sublime, Atom, ...) unterstüzten Git direkt, denn Git ist ein Standard geworden. Jeder benutzt es.

# WebServer (Kurzfassung: Unter Windows WAMP installieren!)
Nginx ist heutzutage von vielen bevorzugt. Apache ist natürlich genauso gut. Wir brauchen *keinen MySQL-Server* (oder irgendeinen anderen Datenbankserver), denn Kirby nutzt intern kein SQL.

## Windows
Windows ist sicherlich nicht direkt für Entwickler erstellt worden, ich habe fast 20 Jahre nur unter Linux programmiert. Mittlerweile ist aber Git auch unter Windows gut unterstützt und auch die WebServer laufen ganz gut. 
Ich verwende [Wamp64](http://www.wampserver.com/en/download-wampserver-64bits/). Im Wesentlichen muss man dann alles installieren (MySQL gerne weglassen).

Wenn [Wamp64](http://www.wampserver.com/en/download-wampserver-64bits/) bereits installiert sein solte, aber noch auf einer Älteren PHP Version läuft, kann man dies ganz einfach wie [HIER](http://blog.astemplates.com/change-php-version-wamp/) beschrieben auf PHP 7.4.0 ändern. 

## PHP (muss eigentlich nicht direkt installiert werden, kommt mit dem Webserver)
Kibry setzt technisch gesehen nur PHP 7.2+ voraus, dennoch ist PHP  PHP 7.4 zu empfehlen.

Man muss PHP aber nicht direkt installieren, denn PHP kommt als Teil vom Wamp64 mit.

Gegebenfalls muss man aber noch den Pfad ("PATH") unter Windows einrichten. Das folgende Video zeigt, wie das geht. Der korrekte Pfad ist bei meiner Installation:

```
C:\wamp64\bin\php\php7.4.0
```

Über den folgenden Link kann das Video aufgerufen werden: https://youtu.be/83SccoBYSfA?t=80



# Git
Die neue Homepage wird mit Git verwaltet werden. Jeder, der mitmachen möchte, sollte also einen Account bei unserem Git-Server haben. Bitte also auf [den Server](https://gitlab.com/cniehaus/homepage) gehen und einen Account anlegen. 


# CSS
Wir müssen natürlich CSS verwenden. [Bootstrap](https://getbootstrap.com/) ist ein sinnvolles, bekanntes System.
Wir haben uns daher für Bootstrap 5 entschieden. Gute Dokumentation, Anleitungen ohne Ende... Alternativen wie TailwindCSS kommen erstmal nicht in Betracht, vielleicht auf Dauer.


