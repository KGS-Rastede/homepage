 <?php

    /**
     * Einmalige Migration: verteilt die Pressenachrichten der Seite
     * schule/presse auf Unterseiten je Jahr (Template presse-jahr).
     *
     * Aufruf im Kirby-Wurzelverzeichnis:
     *   php scripts/presse-aufteilen.php [content-Ordner]
     *
     * Kann gefahrlos mehrfach laufen: Sind auf schule/presse keine
     * Meldungen mehr, passiert nichts. Vorhandene Jahresseiten werden ergänzt.
     */

    $root = dirname(__DIR__);
    require $root . '/kirby/bootstrap.php';

    $roots = ['index' => $root];
    if (isset($argv[1])) {
        $roots['content'] = realpath($argv[1]);
    }

    $kirby = new Kirby(['roots' => $roots]);
    $kirby->impersonate('kirby');

    $presse = $kirby->page('schule/presse');
    if (!$presse) {
        exit("Seite schule/presse nicht gefunden\n");
    }

    $eintraege = $presse->content()->get('pressenachrichten')->yaml();
    if (count($eintraege) === 0) {
        exit("Keine Meldungen auf schule/presse – nichts zu tun\n");
    }

    // Nach Jahr gruppieren
    $jahre = [];
    foreach ($eintraege as $eintrag) {
        $jahr = substr((string)($eintrag['datum'] ?? ''), 0, 4);
        if (!preg_match('/^\d{4}$/', $jahr)) {
            $jahr = 'ohne-datum';
        }
        $jahre[$jahr][] = $eintrag;
    }
    krsort($jahre);

    foreach ($jahre as $jahr => $liste) {
        $seite = $presse->findPageOrDraft((string)$jahr);

        if ($seite) {
            $liste = array_merge($seite->pressenachrichten()->yaml(), $liste);
            $seite->update(['pressenachrichten' => Data::encode($liste, 'yaml')]);
        } else {
            $presse->createChild([
                'slug'     => (string)$jahr,
                'template' => 'presse-jahr',
                'content'  => [
                    'title'             => (string)$jahr,
                    'pressenachrichten' => Data::encode($liste, 'yaml'),
                ],
            ])->changeStatus('unlisted');
        }

        echo $jahr, ': ', count($liste), " Meldungen\n";
    }

    // Liste und das alte leere Info-Feld von der Übersichtsseite entfernen
    $presse->update(['pressenachrichten' => null, 'info' => null]);

    echo 'Fertig: ', count($eintraege), " Meldungen verteilt\n";
