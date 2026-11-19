<!-- Footer nach Tailkit m-s-footers-08 (With Links, Info and Newsletter), kompaktes Padding -->
<footer id="page-footer"
    class="border-t border-slate-200 bg-slate-100 text-center dark:border-slate-700/75 dark:bg-slate-900 dark:text-slate-100 lg:text-left">

    <div class="container mx-auto px-4 py-6 lg:px-8 lg:py-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-4 md:gap-6 lg:gap-10">

            <!-- Logo der Schule -->
            <div>
                <a href="<?= $site->url() ?>" class="inline-block" aria-label="KGS Rastede – Zur Startseite">
                    <?= asset('assets/bilder/logo.svg')->read() ?>
                </a>
            </div>

            <!-- Kontakte -->
            <div class="space-y-4">
                <h4 class="text-xs font-semibold tracking-wider text-slate-500 uppercase dark:text-slate-400/75">
                    Kontakte
                </h4>
                <nav class="flex flex-col gap-3 text-sm">
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a>
                </nav>
            </div>

            <!-- Wichtige Downloads -->
            <div class="space-y-4">
                <h4 class="text-xs font-semibold tracking-wider text-slate-500 uppercase dark:text-slate-400/75">
                    Wichtige Downloads
                </h4>
                <nav class="flex flex-col gap-3 text-sm">
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('allgemeines/schulbuchlisten')->url() ?>">Schulbuchlisten</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('allgemeines/schulordnung')->url() ?>">Schulordnung</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('allgemeines/wichtigelinks')->url() ?>">Informationen und Formulare</a>
                </nav>
            </div>

            <!-- Über die KGS -->
            <div class="space-y-4">
                <h4 class="text-xs font-semibold tracking-wider text-slate-500 uppercase dark:text-slate-400/75">
                    Über die KGS
                </h4>
                <nav class="flex flex-col gap-3 text-sm">
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('schule/geschichte')->url() ?>">Unsere Geschichte</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a>
                    <a class="font-medium text-slate-700 hover:text-slate-950 dark:text-slate-400 dark:hover:text-slate-50"
                        href="https://kgs-rastede.l-e-o.eu" target="_blank" rel="noopener">Mensa</a>
                </nav>
            </div>
        </div>

        <hr class="my-6 border-dashed border-slate-300 dark:border-slate-700/75" />

        <div class="flex flex-col gap-6 text-center text-sm md:flex-row-reverse md:items-center md:justify-between md:gap-0 md:text-left">
            <nav class="space-x-4">
                <a href="https://bsky.app/profile/kgs-rastede.bsky.social"
                    class="text-slate-400 hover:text-[#1185fe]" referrerpolicy="no-referrer"
                    aria-label="KGS Rastede auf Bluesky">
                    <svg class="inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 -3.268 64 68.414" aria-hidden="true">
                        <path d="M13.873 3.805C21.21 9.332 29.103 20.537 32 26.55v15.882c0-.338-.13.044-.41.867-1.512 4.456-7.418 21.847-20.923 7.944-7.111-7.32-3.819-14.64 9.125-16.85-7.405 1.264-15.73-.825-18.014-9.015C1.12 23.022 0 8.51 0 6.55 0-3.268 8.579-.182 13.873 3.805zm36.254 0C42.79 9.332 34.897 20.537 32 26.55v15.882c0-.338.13.044.41.867 1.512 4.456 7.418 21.847 20.923 7.944 7.111-7.32 3.819-14.64-9.125-16.85 7.405 1.264 15.73-.825 18.014-9.015C62.88 23.022 64 8.51 64 6.55c0-9.818-8.578-6.732-13.873-2.745z"></path>
                    </svg>
                </a>
                <a href="https://www.tiktok.com/@kgsrastede_offiziell"
                    class="text-slate-400 hover:text-slate-950 dark:hover:text-white" referrerpolicy="no-referrer"
                    aria-label="KGS Rastede auf TikTok">
                    <svg class="inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"></path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/kgsrastede_offiziell/"
                    class="text-slate-400 hover:text-[#E1306C]" referrerpolicy="no-referrer"
                    aria-label="KGS Rastede auf Instagram">
                    <svg class="inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path>
                    </svg>
                </a>
            </nav>
            <div class="text-slate-500 dark:text-slate-400/80">
                Copyright &copy; <?= date('Y') ?> KGS Rastede &middot; All Rights Reserved.
            </div>
        </div>
    </div>
</footer>


</body>

</html>
