<!doctype html>
<html lang="en">
<head>
  <title><?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <?= css('assets/css/kgs.css') ?>

  <?= date_default_timezone_set("Europe/Amsterdam");?>
</head>

<body>
  
    <header>
        <?php snippet('nav') ?>
    </header>
