<!--
 =========================================================
 Material Kit PRO - v2.2.0
 =========================================================

 Product Page: https://themes.getbootstrap.com/product/material-kit-pro/
 Copyright 2019 Creative Tim (https://www.creative-tim.com)

 Coded by Creative Tim

 =========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">
<head>
  <title><?= $site->title() ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <link href='<?= $kirby->url('assets') ?>/js/packages/core/main.css' rel='stylesheet' />
  <link href='<?= $kirby->url('assets') ?>/js/packages/daygrid/main.css' rel='stylesheet' />
  <link href='<?= $kirby->url('assets') ?>/js/packages/timegrid/main.css' rel='stylesheet' />
  <link href='<?= $kirby->url('assets') ?>/js/packages/list/main.css' rel='stylesheet' />
  <script src='<?= $kirby->url('assets') ?>/js/packages/core/main.js'></script>
  <script src='<?= $kirby->url('assets') ?>/js/packages/interaction/main.js'></script>
  <script src='<?= $kirby->url('assets') ?>/js/packages/daygrid/main.js'></script>
  <script src='<?= $kirby->url('assets') ?>/js/packages/timegrid/main.js'></script>
  <script src='<?= $kirby->url('assets') ?>/js/packages/list/main.js'></script>

  <link rel="stylesheet" href="<?= $kirby->url('assets') ?>/css/material-kit.css" >
  <link rel="stylesheet" href="<?= $kirby->url('assets') ?>/css/kgs.css" >

</head>

<body class="sections-page sidebar-collapse">
  
    <header>
        <?php snippet('nav') ?>
    </header>
