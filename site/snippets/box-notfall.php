<?php if (page('wichtige_informationen')->toggle()->bool() === true) :
    /* 
        An besonderen Tagen (Schneefrei, Heizungsbruch, ...) soll ganz schnell
        ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
    */
?>
    <?php if (page('wichtige_informationen/')->category() == "sturm") :
        $titel = "Schulausfall wegen Sturm";
    endif ?>
    <?php if (page('wichtige_informationen/')->category() == "eis") :
        $titel = "Schulausfall wegen Glatteis";
    endif ?>
    <?php if (page('wichtige_informationen/')->category() == "regen") :
        $titel = "Schulausfall wegen Starkregen";
    endif ?>
    <?php if (page('wichtige_informationen/')->category() == "heizung") :
        $titel = "Schulausfall wegen Heizungsausfall";
    endif ?>
    <?php if (page('wichtige_informationen/')->category() == "eigenerTitel") :
        $titel = page('wichtige_informationen/')->textTitel();
    endif ?>

    <div class="bg-danger text-white p-3 fw-light">
        <h1><?php echo $titel ?></h1>
        <p><?= page('wichtige_informationen/')->text()->kt() ?></p>
    </div>

<?php endif ?>