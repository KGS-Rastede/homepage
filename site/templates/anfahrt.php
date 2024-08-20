<head>
    <style>
    
.outer-box {
    border: 3px solid #bbb;  /* Stärkerer Rahmen für die große Box */
    padding: 5px;           /* Mehr Innenabstand für die große Box */
    margin: 20px 0;          /* Außenabstand um die große Box */
    background-color: #efefef; /* Hellere Hintergrundfarbe für die große Box e0e0e0*/
    border-radius: 15px;     /* Abgerundete Ecken für die große Box */
}


.inner-box {
    border: 2px solid #ccc;  /* Rahmen für die kleinen Boxen */
    padding: 10px;           /* Innenabstand für die kleinen Boxen */
    margin: 10px 0;          /* Außenabstand zwischen den kleinen Boxen */
    background-color: #f9f9f9; /* Hintergrundfarbe für die kleinen Boxen */
    border-radius: 10px;     /* Abgerundete Ecken für die kleinen Boxen */
}
</style>
</head>


<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
    <div class="outer-box"> <!-- Große äußere Box -->
    <div class="col-md-8 ms-auto me-auto text-center">
        <h2 class="title" style="margin-bottom: 40px;font-size: 25px;"> <?= $page->main_text() ?> </h2>
    </div>

        <div class="content">
            <div class="row">
                <div class="col-md-auto ms-auto me-auto text-auto inner-box"> <!-- Innere Box -->
                    <h6> <?= $page->adresse_s1()->toBlocks() ?> </h6>
                </div>

                <div class="col-md-auto ms-auto me-auto text-auto inner-box"> <!-- Innere Box -->
                    <h6> <?= $page->adresse_s2()->toBlocks() ?> </h6>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-md-5 ms-auto me-auto text-start inner-box"> <!-- Innere Box -->
                    <h10 class="description" style="font-size: 15px;"> <?= $page->anfahrt_text_s1()->toBlocks() ?> </h5>
                </div>
                <div class="col-md-5 ms-auto me-auto text-auto inner-box"> <!-- Innere Box -->
                    <h10 class="description" style="font-size: 15px;"> <?= $page->anfahrt_text_s2()->toBlocks() ?> </h5>
                </div>
            </div>
        </div>
    </div> <!-- Ende der großen äußeren Box -->

    <div class="box">
        <?= $page->karte()->toBlocks(); ?>
    </div>
</div>
<?php snippet('footer') ?>
