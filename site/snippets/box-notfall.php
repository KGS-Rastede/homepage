<?php if (page('wichtige_informationen')->toggle()->bool() === true) :
    /* 
        An besonderen Tagen (Schneefrei, Heizungsbruch, ...) soll ganz schnell
        ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
    */
?>

    <div class="bg-danger text-white p-3 fw-light">
        <h1><?php page('wichtige_informationen/')->textTitel() ?></h1>
        <p class="link-white"><?= page('wichtige_informationen/')->text()->kt() ?></p>
    </div>

<?php endif ?>