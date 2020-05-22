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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


  <link rel="stylesheet" href="<?= $kirby->url('assets') ?>/css/kgs.css" >

</head>

<body class="sections-page sidebar-collapse">
  
    <header>
        <?php snippet('nav') ?>
    </header>
