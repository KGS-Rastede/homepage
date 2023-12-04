# Erzeugen der kgs.css
In der kgs.scss sind alle Änderungen an Bootstrap drin. Diese Datei wird aus Bootstrap heraus kompiliert. Dazu wird unser SASS kompiliert zu CSS.

Alle Änderungen werden in der kgs.scss vorgenommen.

Wir arbeiten mit Prepos (https://prepros.io/). Es gibt diverse andere Methoden, diese ist für uns die einfachste.

# Update von Bootstrap
Sollte mal Bootstrap 5.0.1 rauskommen, so muss man nur durch `composer update` den Bootstrap-Ordner updaten (das macht `composer` für uns automatisch) und mit Prepo neu kompilieren. Dann ist das "Output File" der Pfad '/css/kgs.css' und alles ist aktuell. 

# Purge und Minify

Mit dem Befehl `npm run build` werden zwei Skripte ausgeführt. Diese müssen zunächst mit `npm install` installiert werden.

Die Skripte werden in `package.json` definiert.

Ausgeführt sieht das Ganze so aus:

```bash
c:\wamp64\www\kgs-kirby>npm run build

> kgs-kirby@1.0.0 build c:\wamp64\www\kgs-kirby
> purgecss --config ./assets/css/purgecss.config.js --output ./assets/css/kgs_shrinked.css && css-minify --dir ./assets/css/

c:\wamp64\www\kgs-kirby\css-dist\custom-panel.min.css
c:\wamp64\www\kgs-kirby\css-dist\kgs_shrinked.min.css
c:\wamp64\www\kgs-kirby\css-dist\kgs.min.css
```

PurgeCSS schmeißt alle CSS-Klasse raus, die wir gar nicht benutzen.
minify-css hingegen minifiziert dann den CSS-Code (es werden z.B. alle Kommentare rausgeworfen). Das bringt nochmal ein paar Prozent.