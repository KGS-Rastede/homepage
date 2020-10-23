<?php if (!$submitted): ?>
<?php snippet('header') ?>
<?php snippet('page-header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="container">
                <?= $page->text()->blocks() ?>
            </div>

            <div class="container">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">Vorname</label>
                            <input type="text" class="form-control" name="firstName" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastName">Nachname</label>
                            <input type="text" class="form-control" name="lastName" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="postalCode">PLZ</label>
                            <input type="text" class="form-control" name="postalCode" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">Wohnort</label>
                            <input type="text" class="form-control" name="city" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Straße</label>
                            <input type="text" class="form-control" name="street" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">E-Mail-Adresse</label>
                            <input type="email" class="form-control" name="email" required="required" />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        Zahlungsweise
                        <div class="form-check">
                            <input type="radio" name="payment" value="direct_debit" class="form-check-input" checked="checked" />
                            <label for="payment">
                                Der fällige Betrag von mindestens 18€ pro Jahr soll durch Bankeinzug abgebucht werden.
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accountOwner">Kontoinhaber*in (falls abweichend vom Mitglied)</label>
                            <input type="text" class="form-control" name="accountOwner" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="iban">IBAN</label>
                            <input type="text" class="form-control" name="iban" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bic">BIC</label>
                            <input type="text" class="form-control" name="bic" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Name der Bank</label>
                            <input type="text" class="form-control" name="bank" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fee">Mitgliedsbeitrag (min. 18 EUR)</label>
                            <input type="number" class="form-control" name="fee" min=18 value=18 required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Beitrittserklärung anzeigen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col">
            <?php if ($page->sidebar()->isNotEmpty()) : ?>

            <div class="card mb-3">
                <h5 class="card-title text-center">
                <?php if ($page->sidetitel()->isNotEmpty()) : ?>
                    <?= $page->sidetitel()->kirbytext() ?>
                <?php else : ?>
                    <?= "Weitere Informationen" ?>
                <?php endif ?>
                </h5>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php foreach ($page->sidebar()->toStructure() as $sidebar) : ?>
                        <li class="list-group-item">
                            <a href="<?= $sidebar->link() ?>"><?= $sidebar->name() ?></a>
                        </li>
                    <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <?php endif ?>
        </div>
    </div>
</div>

<?php snippet('footer') ?>
<?php else: ?>
<!doctype html>
<html lang="de">
<head>
    <title>Beitrittserklärung Förderverein der KGS Rastede e.V.</title>
    <style>
        html {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            font: 12pt/1.5 "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        section {
            display: block;
        }

        h1 {
            font-size: 100%;
        }
        h2 {
            font-size: 200%;
        }

        h1, h2 {
            border-bottom: 2px solid red;
        }

        .signature-line {
            margin-top: 2em;
        }
        .signature-line .above {
            font-family: "Courier New", monospace;
            padding: 0.3em 0.8em;
        }

        .signature-line .below {
            border-top: 1px solid black;
        }
        .signature-line .below .signature {
            margin-left: 15em;
        }

        section.page {
            margin: 2em;
            max-width: 960px;
        }

        section.actions {
            margin: 3em;
        }

        @media print {
            section.page {
                padding: 16mm 20mm 20mm 20mm;
                width: 210mm;
                height: 296mm
            }

            section.actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <section class="page">
        <h1>Förderverein der KGS Rastede e.V.</h1>
        <h2>Beitrittserklärung</h2>

        <p>
            Hiermit erkläre ich,<br>
            <strong><?= Escape::html($data['firstName']) ?> <?= Escape::html($data['lastName']) ?></strong>
            (<?= Escape::html($data['street']) ?>, <?= Escape::html($data['postalCode']) ?>
            <?= Escape::html($data['city']) ?>, <?= Escape::html($data['email']) ?>),<br>
            meinen Beitritt zum Förderverein der Kooperativen Gesamtschule Rastede&nbsp;e.V. (26180&nbsp;Rastede,
            Wilhelmstr.&nbsp;5).
        </p>

        <p>
            Der Jahresmitgliedsbeitrag in Höhe von <?= Escape::html($data['fee']) ?>&nbsp;€ soll durch Bankeinzug
            abgebucht werden.
        </p>

        <div class="signature-line">
            <div class="above"><span class="location-date"><?= Escape::html($data['city']) ?>, <?= date('d.m.Y') ?></span></div>
            <div class="below"><span class="location-date">(Ort / Datum)</span> <span class="signature">(Unterschrift)</span></div>
        </div>

        <h2>Einzugsermächtigung</h2>

        <p>
            Hiermit ermächtige ich,<br>
            <strong><?= Escape::html($data['firstName']) ?> <?= Escape::html($data['lastName']) ?></strong>,<br>
            den Förderverein der Kooperativen Gesamtschule Rastede e.V.
            (IBAN:&nbsp;DE&nbsp;70&nbsp;28050100&nbsp;0043155159, BIC:&nbsp;SLZODE22,
            Gläubiger-Identifikationsnummer:&nbsp;DE38FOE00000403193) den jeweils fälligen Jahresbeitrag in Höhe von
            <?= Escape::html($data['fee']) ?>&nbsp;€ zum 15.05. eines jeden Jahres mittels Lastschrift von meinem Konto bei der
            <?= Escape::html($data['bank']) ?> (IBAN&nbsp;<?= Escape::html($data['iban']) ?>,
            BIC:&nbsp;<?= Escape::html($data['bic']) ?>) einzuziehen. Zugleich weise ich mein Kreditinstitut an, die vom
            Förderverein der Kooperativen Gesamtschule Rastede e.V. auf mein Konto gezogenen Lastschriften einzulösen.
        <p>

        <p>
            Hinweis: Ich kann innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten
            Betrags verlangen. Es gelten dabei die mit meinem Kreditinstitut vereinbarten Bedingungen.
        </p>

        <p>Diese Ermächtigung gilt bis auf Wiederruf bzw. erlischt dem Austritt aus dem Förderverein.</p>

        <div class="signature-line">
            <div class="above"><span class="location-date"><?= Escape::html($data['city']) ?>, <?= date('d.m.Y') ?></span></div>
            <div class="below"><span class="location-date">(Ort / Datum)</span> <span class="signature">(Unterschrift)</span></div>
        </div>
    </section>
    <section class="actions">
        <button id="print-button">Ausdrucken</button>
        <button id="back-button">zurück</button>
    </section>
    <script>
        document.getElementById('print-button').addEventListener('click', function() { window.print(); });
        document.getElementById('back-button').addEventListener('click', function() { history.back(); });
    </script>
</body>
</html>
<?php endif; ?>
