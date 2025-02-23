<head>
    <style>
        .outer-box {
            border: 3px solid #bbb;
            padding: 20px;
            margin: 20px auto;
            background-color: #efefef;
            border-radius: 15px;
            max-width: 70%;
        }

        /* Gemeinsame Stile für alle inneren Boxen */
        .inner-box {
            border: 2px solid #ccc;
            padding: 5px;
            background-color: #f9f9f9;
            border-radius: 10px;
            flex: 1;
            min-width: 280px;
        }

        /* Spezifische Anpassung für die oberen Boxen */
        .upper-box {
            font-size: 12px; /* Kleinere Schrift für die oberen Boxen */
            padding: 10px; /* Weniger Padding für die oberen Boxen */
            text-align: center;
        }

        /* Zweite Reihe - Anfahrtstexte (größere Schrift) */
        .description {
            font-size: 14px;
            padding: 5px; /* Etwas mehr Padding für die unteren Boxen */
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container">
    <div class="outer-box">
        <div class="col-md-8 ms-auto me-auto text-center">
            <h2 class="title" style="margin-bottom: 15px; font-size: 25px;">
                <?= $page->main_text() ?>
            </h2>
        </div>

        <!-- Erste Reihe: Adressen (kleiner in Schriftgröße und Padding) -->
        <div class="row">
            <div class="inner-box upper-box">
                <h6><?= $page->adresse_s2()->toBlocks() ?></h6>
            </div>
            <div class="inner-box upper-box">
                <h6><?= $page->adresse_s1()->toBlocks() ?></h6>
            </div>
        </div>

        <!-- Zweite Reihe: Anfahrtstexte (größere Schrift und mehr Padding) -->
        <div class="row">
            <div class="inner-box">
                <p class="description"><?= $page->anfahrt_text_s2()->toBlocks() ?></p>
            </div>
            <div class="inner-box">
                <p class="description"><?= $page->anfahrt_text_s1()->toBlocks() ?></p>
            </div>
        </div>
    </div>

    <div class="box">
        <?= $page->karte()->toBlocks(); ?>
    </div>
</div>

<?php snippet('footer') ?>
