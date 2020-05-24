# Wie funktioniert das?
In der kgs.scss sind alle Änderungen an Bootstrap drin

In dem Unterordner /assets/bootstrap/ ist eine Kopie von Bootstrap 4.5 drin. In dem Ordner ist absolut nichts anderes drin, der wird auchin keiner Weise modifiziert.

Alle Änderungen werden in der kgs.scss vorgenommen.

Auf dem PC muss Ruby SASS installiert sein, zuletzt getestet mit:

```
Ruby Sass 3.7.4
```

Außerdem habe ich in VS Code die `minify` Extension installiert, die macht aus kgs.css dann die kgs.min.css. Das spart laut Ausgabe fast 80% Speicher ein.

Man gibt dann als Befehl ein:

```
sass .\kgs.scss ..\css\kgs.css
```

Dieser Befehl erzeugt die .css-Datei. Man öffnet diese Datei und startet mit `F1` dann den Minifier. 


# Update von Bootstrap
Sollte mal Bootstrap 4.5.1 rauskommen, so muss man nur den Bootstrap-Ordner 1:1 austauschen und dann `sass` nau laufen lassen.

# TODO
Grundsätzlich kann man durch angepasste `@include`-Befehle erreichen, dass nur das CSS kompiliert wird, das auch benutzt wird. 
Benutzt man z.B. verschiedene Farben nicht, werden die rausgeworfen. So wird das CSS noch ein wenig kompakter.