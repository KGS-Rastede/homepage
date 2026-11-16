<?php
// Gibt die per FTP in content/sprechtag/ abgelegte HTML-Datei (z.B. esp.html) unverändert aus.
// Kirby erlaubt keine HTML-Uploads über das Panel, daher der Weg über das Dateisystem.
$dateien = glob($page->root() . '/*.html') ?: [];
usort($dateien, fn($a, $b) => filemtime($b) <=> filemtime($a));

if (empty($dateien)) {
    http_response_code(404);
    echo '<!doctype html><meta charset="utf-8"><title>Sprechtag</title><p>Aktuell ist keine Sprechtag-Seite hinterlegt.</p>';
    return;
}

header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
readfile($dateien[0]);
