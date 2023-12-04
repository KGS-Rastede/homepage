<hr>

<!-- Footer container -->
<footer id="page-footer" class="bg-neutral-100 text-center dark:bg-neutral-600 lg:text-left">

    <div class="container xl:max-w-7xl mx-auto px-4 py-4 lg:px-8 lg:py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!--Logo der Schule -->
            <nav class="flex flex-col space-y-2">

                <a href="<?= $site->url() ?>" aria-label="logo-bottom">
                    <?= asset('assets/bilder/logo.svg')->read() ?>
                </a>

            </nav>

            <nav class="flex flex-col space-y-3">

                <!--Second links section-->
                <h5 class="mb-2.5 font-bold uppercase text-neutral-800 dark:text-neutral-200">
                    Kontakte
                </h5>

                <ul class="mb-0 list-none">
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a></li>

                </ul>
            </nav>

            <!--Third links section-->
            <nav class="flex flex-col space-y-3">
                <h5 class="mb-2.5 font-bold uppercase text-neutral-800 dark:text-neutral-200">
                    Wichtige Downloads
                </h5>

                <ul class="mb-0 list-none">

                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('allgemeines/schulbuchlisten')->url() ?>">Schulbuchlisten</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('allgemeines/schulordnung')->url() ?>">Schulordnung</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('allgemeines/wichtigelinks')->url() ?>">Informationen und Formulare</a></li>

                </ul>
            </nav>

            <!--Fourth links section-->
            <nav class="flex flex-col space-y-3">
                <h5 class="mb-2.5 font-bold uppercase text-neutral-800 dark:text-neutral-200">
                    Über die KGS
                </h5>

                <ul class="mb-0 list-none">

                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('schule/geschichte')->url() ?>">Unsere Geschichte</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="https://kgs-rastede.l-e-o.eu" target="_blank" rel="noopener">Mensa</a></li>
                </ul>
            </nav>
        </div>

        <!--Copyright section-->
        <div class="bg-neutral-200 py-2 text-center text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200">

            <div class="col" id="copyrightText">
            </div>

            <script>
                document.getElementById("copyrightText").innerHTML = `Copyright &#xA9; ${new Date().getFullYear()} KGS Rastede ; All Rights Reserved.`;
            </script>

        </div>
    </div>
</footer>

<?php snippet('skripte-im-footer') ?>


</body>

</html>