<hr>

<!-- Footer container -->
<footer id="page-footer" class="bg-neutral-200 text-center dark:bg-neutral-600 lg:text-left">

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
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'kontakte/schulleitung',
                                                                                )->url() ?>">Schulleitung</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'kontakte/fbl',
                                                                                )->url() ?>">Fachbereichsleiter</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'kontakte/sekretariate',
                                                                                )->url() ?>">Sekretariate</a></li>

                </ul>
            </nav>

            <!--Third links section-->
            <nav class="flex flex-col space-y-3">
                <h5 class="mb-2.5 font-bold uppercase text-neutral-800 dark:text-neutral-200">
                    Wichtige Downloads
                </h5>

                <ul class="mb-0 list-none">

                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'allgemeines/schulbuchlisten',
                                                                                )->url() ?>">Schulbuchlisten</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'allgemeines/schulordnung',
                                                                                )->url() ?>">Schulordnung</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'allgemeines/wichtigelinks',
                                                                                )->url() ?>">Informationen und Formulare</a></li>

                </ul>
            </nav>

            <!--Fourth links section-->
            <nav class="flex flex-col space-y-3">
                <h5 class="mb-2.5 font-bold uppercase text-neutral-800 dark:text-neutral-200">
                    Über die KGS
                </h5>

                <ul class="mb-0 list-none">

                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'schule/geschichte',
                                                                                )->url() ?>">Unsere Geschichte</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'allgemeines/anfahrt',
                                                                                )->url() ?>">Anfahrt</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="<?= page(
                                                                                    'allgemeines/impressum',
                                                                                )->url() ?>">Impressum</a></li>
                    <li><a class="text-neutral-800 dark:text-neutral-200" href="https://kgs-rastede.l-e-o.eu" target="_blank" rel="noopener">Mensa</a></li>
                </ul>
            </nav>
        </div>

    </div>
    <hr class="my-4 border-dashed border-gray-200 dark:border-gray-700/75" />
    <div
        class="flex flex-col gap-6 text-center text-sm">
        <nav class="space-x-4">

            <a href="https://bsky.app/profile/kgs-rastede.bsky.social" class="fill-gray-400 hover:fill-[#1185fe]" referrerpolicy="no-referrer">
                <svg
                    class="inline-block size-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 -3.268 64 68.414">
                    <path d="M13.873 3.805C21.21 9.332 29.103 20.537 32 26.55v15.882c0-.338-.13.044-.41.867-1.512 4.456-7.418 21.847-20.923 7.944-7.111-7.32-3.819-14.64 9.125-16.85-7.405 1.264-15.73-.825-18.014-9.015C1.12 23.022 0 8.51 0 6.55 0-3.268 8.579-.182 13.873 3.805zm36.254 0C42.79 9.332 34.897 20.537 32 26.55v15.882c0-.338.13.044.41.867 1.512 4.456 7.418 21.847 20.923 7.944 7.111-7.32 3.819-14.64-9.125-16.85 7.405 1.264 15.73-.825 18.014-9.015C62.88 23.022 64 8.51 64 6.55c0-9.818-8.578-6.732-13.873-2.745z"></path>
                </svg>

            </a>
            <a href="https://www.tiktok.com/@kgsrastede_offiziell" class="fill-gray-400 hover:fill-[#1185fe]" referrerpolicy="no-referrer">
                <svg class="inline-block size-5" width="48px" height="48px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Tiktok</title>

                    <g id="Icon/Social/tiktok-black" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <path d="M38.0766847,15.8542954 C36.0693906,15.7935177 34.2504839,14.8341149 32.8791434,13.5466056 C32.1316475,12.8317108 31.540171,11.9694126 31.1415066,11.0151329 C30.7426093,10.0603874 30.5453728,9.03391952 30.5619062,8 L24.9731521,8 L24.9731521,28.8295196 C24.9731521,32.3434487 22.8773693,34.4182737 20.2765028,34.4182737 C19.6505623,34.4320127 19.0283477,34.3209362 18.4461858,34.0908659 C17.8640239,33.8612612 17.3337909,33.5175528 16.8862248,33.0797671 C16.4386588,32.6422142 16.0833071,32.1196657 15.8404292,31.5426268 C15.5977841,30.9658208 15.4727358,30.3459348 15.4727358,29.7202272 C15.4727358,29.0940539 15.5977841,28.4746337 15.8404292,27.8978277 C16.0833071,27.3207888 16.4386588,26.7980074 16.8862248,26.3604545 C17.3337909,25.9229017 17.8640239,25.5791933 18.4461858,25.3491229 C19.0283477,25.1192854 19.6505623,25.0084418 20.2765028,25.0219479 C20.7939283,25.0263724 21.3069293,25.1167239 21.794781,25.2902081 L21.794781,19.5985278 C21.2957518,19.4900128 20.7869423,19.436221 20.2765028,19.4380839 C18.2431278,19.4392483 16.2560928,20.0426009 14.5659604,21.1729264 C12.875828,22.303019 11.5587449,23.9090873 10.7814424,25.7878401 C10.003907,27.666593 9.80084889,29.7339663 10.1981162,31.7275214 C10.5953834,33.7217752 11.5748126,35.5530237 13.0129853,36.9904978 C14.4509252,38.4277391 16.2828722,39.4064696 18.277126,39.8028054 C20.2711469,40.1991413 22.3382874,39.9951517 24.2163416,39.2169177 C26.0948616,38.4384508 27.7002312,37.1209021 28.8296253,35.4300711 C29.9592522,33.7397058 30.5619062,31.7522051 30.5619062,29.7188301 L30.5619062,18.8324027 C32.7275484,20.3418321 35.3149087,21.0404263 38.0766847,21.0867664 L38.0766847,15.8542954 Z" id="Fill-1" fill="#000000"></path>
                    </g>
                </svg>

            </a>
            <a href="https://www.instagram.com/kgsrastede_offiziell/" class="fill-gray-400 hover:fill-[#E1306C]" referrerpolicy="no-referrer">
                <svg
                    class="icon-instagram inline-block size-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path>
                </svg>
            </a>


        </nav>
        <div class="text-gray-500 dark:text-gray-300/80">
            <span class="font-medium">
                <div class="col" id="copyrightText">
                    <script>
                        document.getElementById("copyrightText").innerHTML = `Copyright &#xA9; ${new Date().getFullYear()} KGS Rastede ; All Rights Reserved.`;
                    </script>
                </div>
            </span>
        </div>
    </div>
</footer>

<?php snippet('skripte-im-footer'); ?>


</body>

</html>