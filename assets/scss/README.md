# Erzeugen der kgs.css
In der kgs.scss sind alle Änderungen an Bootstrap drin. Diese Datei wird aus Bootstrap heraus kompiliert. Dazu wird unser SASS kompiliert zu CSS.

Alle Änderungen werden in der kgs.scss vorgenommen.

Wir arbeiten mit Prepos (https://prepros.io/). Es gibt diverse andere Methoden, diese ist für uns die einfachste.

# Update von Bootstrap
Sollte mal Bootstrap 5.0.1 rauskommen, so muss man nur durch `composer update` den Bootstrap-Ordner updaten (das macht `composer` für uns automatisch) und mit Prepo neu kompilieren. Dann ist das "Output File" der Pfad '/css/kgs.css' und alles ist aktuell. 

# TODO
Grundsätzlich kann man durch angepasste `@include`-Befehle in der `bootstrap.scss`erreichen, dass nur das CSS kompiliert wird, das auch benutzt wird. 
Benutzt man z.B. verschiedene Funktionen (wie Tooltipps) nicht, werden die rausgeworfen. So wird das CSS noch ein wenig kompakter.
Viel besser wäre es allerdings, wenn wir einfach PurgeCSS oder PurifyCSS verwenden würden. Bisher habe ich das aber noch nicht hinbekommen...