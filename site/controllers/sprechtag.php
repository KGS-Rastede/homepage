<?php

return function ($page) {
    $lehrkraefte = [];
    $fehler = null;
    $datei = $page->csvDatei()->toFile();
    $pfad = $datei && $datei->parent()->id() === $page->id() && $datei->extension() === 'csv'
        ? $datei->root()
        : $page->root() . '/sprechtagdaten.csv';

    if (!is_file($pfad) || !is_readable($pfad)) {
        return ['lehrkraefte' => [], 'fehler' => 'Die Raumübersicht ist aktuell noch nicht verfügbar.'];
    }

    $inhalt = file_get_contents($pfad);
    if (!mb_check_encoding($inhalt, 'UTF-8')) {
        $inhalt = mb_convert_encoding($inhalt, 'UTF-8', 'Windows-1252');
    }
    $inhalt = preg_replace('/^\xEF\xBB\xBF/', '', $inhalt);
    $stream = fopen('php://temp', 'r+');
    fwrite($stream, $inhalt);
    rewind($stream);
    $ersteZeile = fgets($stream);
    $trenner = ';';
    foreach ([',', "\t"] as $kandidat) {
        if (count(str_getcsv($ersteZeile ?: '', $kandidat, '"', '')) > count(str_getcsv($ersteZeile ?: '', $trenner, '"', ''))) {
            $trenner = $kandidat;
        }
    }
    rewind($stream);
    $kopf = fgetcsv($stream, null, $trenner, '"', '');
    $kopf = array_map(fn ($wert) => mb_strtolower(trim($wert)), $kopf ?: []);
    $spalten = array_flip($kopf);

    if (array_diff(['kürzel', 'anrede', 'nachname', 'raum'], $kopf)) {
        $fehler = 'Die CSV-Datei benötigt die Spalten Kürzel, Anrede, Nachname und Raum.';
    } else {
        while (($zeile = fgetcsv($stream, null, $trenner, '"', '')) !== false) {
            $eintrag = [];
            foreach (['kürzel', 'anrede', 'nachname', 'raum'] as $spalte) {
                $eintrag[$spalte] = trim($zeile[$spalten[$spalte]] ?? '');
            }
            if ($eintrag['nachname'] !== '') {
                $lehrkraefte[] = $eintrag;
            }
        }
    }
    fclose($stream);

    $sortierung = new Collator('de_DE');
    usort($lehrkraefte, fn ($a, $b) => $sortierung->compare($a['nachname'], $b['nachname']) ?: strcmp($a['kürzel'], $b['kürzel']));

    return compact('lehrkraefte', 'fehler');
};
