<?php if (page('wichtige_informationen/notfall')->toggle()->bool() === true) : ?>
    <div class="row">
        <div class="col-xl-8 mt-4">
            <div class="card bg-primary">
                <!-- 
          An besonderen Tagen (Schneefrei, Heizungsbruch, ...) soll ganz schnell
          ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
          -->

                <?php if (page('wichtige_informationen/notfall')->category() == "sturm") :
                    $titel = "Schulausfall wegen Sturm";
                endif ?>
                <?php if (page('wichtige_informationen/notfall')->category() == "eis") :
                    $titel = "Schulausfall wegen Glatteis";
                endif ?>
                <?php if (page('wichtige_informationen/notfall')->category() == "regen") :
                    $titel = "Schulausfall wegen Starkregen";
                endif ?>
                <?php if (page('wichtige_informationen/notfall')->category() == "heizung") :
                    $titel = "Schulausfall wegen Heizungsausfall";
                endif ?>
                <?php if (page('wichtige_informationen/notfall')->category() == "eigenerTitel") :
                    $titel = page('wichtige_informationen/notfall')->textTitel();
                endif ?>

                <div class="card bg-info text-white">
                    <h1><?php echo $titel ?></h1>
                    <p class="lead"><?= page('wichtige_informationen/notfall')->text() ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>