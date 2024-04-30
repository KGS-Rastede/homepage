<!-- Wetter für Rastede aus OpenWeatherMap -->
<?php if (page('infodisplay')->toggle_wetter()->bool() === true) : ?>
    <h1><?= $page->label_wetter() ?></h1>
    <?php snippet('weather') ?>
<?php endif ?>

<!-- RSS Feed "news-infobildschirm-sek1" aus Iserv -->
<?php if (page('infodisplay')->toggle_iserv()->bool() === true) : ?>
    <h1><?= $page->label_iserv() ?></h1>
    <?php snippet('rssfeed') ?>
<?php endif ?>
