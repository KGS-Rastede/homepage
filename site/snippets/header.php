<!doctype html>
<html lang="en">
<head>
  <title><?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="<?= $kirby->url('assets') ?>/css/bootstrap.min.css" >

  <link rel="stylesheet" href="<?= $kirby->url('assets') ?>/css/kgs.css" >

</head>

<body class="sections-page sidebar-collapse">
  
    <header>
        <?php snippet('nav') ?>
    </header>
