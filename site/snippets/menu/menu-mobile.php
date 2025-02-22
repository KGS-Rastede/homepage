<? 
/* Der Knopf zum öffnen und schließen der mobilen Ansicht befindet sich im Snippet für
* die Desktop-Ansicht des Menüs.
*/
?>

<!-- Mobile Navigation -->
<nav
    x-cloak
    x-show="mobileNavOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-50 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-50 translate-x-full"
    id="tkMobileNav"
    class="fixed top-0 right-0 bottom-0 z-50 min-w-80 w-10/12 overflow-auto bg-white/95 shadow-lg md:w-3/5 lg:hidden dark:bg-gray-800/95"
    tabindex="-1"
    aria-labelledby="tkMobileNavLabel"
    x-bind:aria-modal="mobileNavOpen ? 'true' : null"
    x-bind:role="mobileNavOpen ? 'dialog' : null">

    <div class="flex items-center justify-between p-6">
        <!-- Logo -->
        <a
            id="tkMobileNavLabel"
            href="<?= $site->url() ?>"
            class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
            <?= asset('assets/bilder/logo.svg')->read() ?>

            <span>KGS Rastede</span>
        </a>
        <!-- END Logo -->

        <!-- Close Mobile Navigation -->
        <button
            x-on:click="mobileNavOpen = false"
            type="button"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
            <svg
                class="hi-mini hi-x-mark -mx-0.5 inline-block size-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true">
                <path
                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
        </button>
        <!-- END Close Mobile Navigation -->
    </div>
    <div class="h-px bg-gray-200/75 dark:bg-gray-700/75"></div>
    <div class="flex flex-col gap-8 px-6 py-6">
        <div class="grid grid-cols-2 gap-6">
            <?php snippet(
              'menu/menu-mobile-category',
              ['title' => 'Kontakt'],
              slots: true,
            ); ?>
                <?php slot('menuContent'); ?>
                <?php
                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Kontakt linke Spalte',
                  'menuItems' => $menuItems,
                ]);

                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Kontakt rechte Spalte',
                  'menuItems' => $menuItems,
                ]);
                ?>
                <?php endslot(); ?>
            <?php endsnippet(); ?>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <?php snippet(
              'menu/menu-mobile-category',
              ['title' => 'Über die Schule'],
              slots: true,
            ); ?>
                <?php slot('menuContent'); ?>
                <?php
                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Links',
                  'menuItems' => $menuItems,
                ]);

                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "Leitbild"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulprogramm"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Schulvorstand"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Unsere Geschichte"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Schulvorstand"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Übergang Grundschule / KGS"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Die drei Schulzweige"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Oberstufe"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Abschlüsse an der KGS"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Profile und Wahlen"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Zuständigkeiten / Organigram"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Ausbildungsschule"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Unsere Schule in der Presse"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Mitte',
                  'menuItems' => $menuItems,
                ]);

                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "Anfahrt"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulleitung"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Fachbereichsleiter"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Sekretariate"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Hausmeister"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Schüler:innen Vertretung (SV)"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Schulpersonalrat (SPR)"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Gleichstellungsbeauftragte"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Schulelternrat (SER)"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Förderverein"]
                    ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Rechts',
                  'menuItems' => $menuItems,
                ]);
                ?>
                <?php endslot(); ?>
            <?php endsnippet(); ?>
        </div>  
        <div class="grid grid-cols-2 gap-6">
            <?php snippet(
              'menu/menu-mobile-category',
              ['title' => 'Service und Downloads'],
              slots: true,
            ); ?>
                <?php slot('menuContent'); ?>
                <?php
                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Learn',
                  'menuItems' => $menuItems,
                ]);

                // prettier-ignore
                $menuItems = [
                    ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"],
                    ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                    ['pfad' => "/unterricht/sanitaetsdienst", 'name' => "Schulsanitätsdienst"]
                ];
                snippet('menu/menu-mobile-category-column', [
                  'title' => 'Downloads',
                  'menuItems' => $menuItems,
                ]);
                ?>
                <?php endslot(); ?>
            <?php endsnippet(); ?>
        </div>
    </div>

</nav>
<!-- END Mobile Navigation -->

<!-- Mobile Navigation Backdrop -->
<div
    x-cloak
    x-show="mobileNavOpen"
    x-on:click="mobileNavOpen = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-gray-900/20 backdrop-blur-xs will-change-auto lg:hidden dark:bg-gray-900/80"></div>
<!-- END Mobile Navigation Backdrop -->