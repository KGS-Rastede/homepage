<?php

require 'kirby/bootstrap.php';

if (page("wichtige-informationen")->togglenotfall()->toggle()->bool() === true && page("wichtige-informationen")->notfallredirect()->toggle()->bool() === true) {

    // Aktuelle URL prüfen
    $currentUrl = $_SERVER['REQUEST_URI'];
    $baseUrl    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";

    // Weiterleitung nur, wenn die URL nicht "/" und nicht mit "/panel", "/media" oder "/api" beginnt
    if ($currentUrl !== "/" && strpos($currentUrl, "/panel") !== 0 && strpos($currentUrl, "/media") !== 0 && strpos($currentUrl, "/api") !== 0) {
        header("Location: $baseUrl");
        exit;
    }
}

echo (new Kirby)->render();
