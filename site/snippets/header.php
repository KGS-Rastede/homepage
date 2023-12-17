<!doctype html>
<html lang="en">

<head>
  <title><?= $page->title() ?> | <?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Die Homepage der Kooperativen Gesamtschule Rastede (KGS Rastede)" />

  <?= css('assets/css/kgs_shrinked.min.css') ?>
  <?= css('assets/css/twkgs_shrinked.min.css') ?>
  <script defer src="../../node_modules/alpinejs/dist/cdn.min.js"></script>

  <link rel="preload" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  
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

    <?php if ($_SERVER["HTTP_HOST"] == "niehaus-ol.de") : 
      // Auf https://niehaus-ol.de wird ein riesiges knall gelbes Banner angezeigt, dass darüber informaiert das man nicht auf der richtigen Seite ist. Wenn niehaus-ol z.B. in SuchmaschinenErgebnissen auftaucht ?>
      <a href="<?= "https://kgs-rastede.de" . $_SERVER["REQUEST_URI"] ?>" class="text-start text-decoration-none text-black" role="button">
        <div class="container-fluid p-md-5 py-4" style="background-color: #F7F700;">
          <h1 class="mb-3">Sie befinden sich momentan nicht auf der offiziellen Homepage der KGS. Diese erreichen Sie unter: <span class="link-danger">kgs-rastede.de</span> !</h1>
          <p class="mb-0">Diese Webseite wird verwendet um neue Funktionen für die offizielle Homepage zu testen. Die Informationen auf dieser Webseite sind jedoch nicht aktuell. Aus diesem Grund bitten wir Sie die offizielle Webseite zu verwenden.<br><br>Vielen Dank für Ihr Verständnis!</p>
        </div>
      </a>
    <?php endif ?>

  </header>
