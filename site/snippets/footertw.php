</main>

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
    <hr class="my-10 border-dashed border-gray-200 dark:border-gray-700/75" />
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

            <a href="https://www.instagram.com/kgsrastede_offiziell/" class="fill-gray-400 hover:fill-[#E1306C]" referrerpolicy="no-referrer">
                <svg
                    class="icon-instagram inline-block size-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path>
                </svg>
            </a>


        </nav>
        <div class="text-gray-500 dark:text-gray-400/80">
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