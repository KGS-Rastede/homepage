<?php snippet('header') ?>

<?php snippet('page-header') ?>


<!-- 
Homepages von Schulen sind impressumpflichtig 
i.S.d. § 55 Abs. 1 Rundfunkstaatsvertrag (RStV) 
oder sogar des § 5 Telemediengesetz (TMG).

Als Diensteanbieter i.S.d. § 55 Abs. 1 RStV 
bzw. § 2 Nr. 1 TMG ist der Schulleiter als Vertreter 
des Landes Niedersachsen mit der Adressangabe der Schule zu benennen. 
-->

<!-- Es wird aus Sicherheitsgründen empfohlen, die in § 5 TMG 
vorgeschriebenen Inhalte mit aufzuführen, denn dann muss nicht 
bei jeder Änderung der Inhalte bedacht werden, ob das Impressum 
zu erweitern ist. Zu diesen erweiterten Informationen zählt, 
dass das Land Niedersachsen eine juristische Person des 
öffentlichen Rechts ist und dass die – ohnehin üblichen – Angaben 
für eine schnelle elektronische Kontaktaufnahme (Telefon, Fax, 
Mailadresse) enthalten sind. -->


<div class="container">
    <div class="row">
        <div class="col-xl-8">
            <h3>Anschrift</h3>
            <?= $page->anschrift()->kirbytext() ?>
            Tel.: <?= $page->telefon()->tel() ?> </br>
            Fax: <?= $page->fax()->tel() ?> </br>
            E-Mail: <span style="text-decoration:underline;"><a href="mailto:<?= $page->email() ?>"><?= $page->email()->email() ?></a></span></br>
            Schulische Datenschutzbeauftragte: <a href="mailto:datenschutz@kgs-rastede.de">datenschutz@kgs-rastede.de</a>

            <h3 class="mt-5">Inhaltlich verantwortlich</h3>
            <p>
                <?= $page->rechtlichertext()->text()->kirbytext() ?>
            </p>

        </div>

        <div class="col-xl-4">
            <h3>Schulträger</h3>
            <p>
                <?= $page->schultrager()->text()->kirbytext() ?>
            </p>
        </div>
    </div>
</div>


<?php snippet('footer') ?>