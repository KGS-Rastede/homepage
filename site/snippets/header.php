<!doctype html>
<html lang="en">

<head>
  <title><?= $page->title() ?> | <?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Die Homepage der Kooperativen Gesamtschule Rastede (KGS Rastede)" />

  <?= css('assets/css/kgs_shrinked.min.css') ?>

  <!-- 
    Diese Konstruktion dient der Performance. 
    So werden die Icons zuletzt geladen und der Inhalt zuerst
    https://web.dev/defer-non-critical-css/ 
  -->
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

  <noscript>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  </noscript>

  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/site.webmanifest">
  <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>

<body>

  <header>
    <?php //snippet('nav2') 
    ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <?php snippet('navoffcanvas') ?>
  </header>