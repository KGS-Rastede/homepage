<!-- Main Header Section: With Mega Menu -->
<div
    class="z-50 relative bg-white dark:bg-gray-900 dark:text-gray-100">
    <!-- Header -->
    <header
        x-data="{ mobileNavOpen: false, searchOpen: false }"
        id="page-header"
        class="relative flex flex-none items-center py-8">
        <!-- Main Header Content -->
        <div
            class="relative container mx-auto flex items-center justify-between px-4 lg:px-8 xl:max-w-7xl">
            <!-- Left Section -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <a
                    href="<?= $site->url() ?>"
                    class="group inline-flex items-center gap-2 text-xl font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                    <?= asset('assets/bilder/logo_square.svg')->read() ?>

                    <span>KGS Rastede</span>
                </a>
                <!-- END Logo -->

                <!-- Mega Menu visible on large screens -->
                <ul x-show="!searchOpen" class="mt-0.5 hidden items-center lg:flex">
                    <!-- Kontakt Kategorie -->
                    <?php snippet(
                      'menu/menu-category',
                      ['title' => 'Über die Schule'],
                      slots: true,
                    ); ?>
                    <?php slot('menuContent'); ?>
                    <div
                        class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">

                        <?php
                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/allgemeines/anfahrt", 'name' => "Anfahrt"],
                            ['pfad' => "/kontakte/schulleitung", 'name' => "Schulleitung"],
                            ['pfad' => "/kontakte/fbl", 'name' => "Fachbereichsleiter"],
                            ['pfad' => "/kontakte/sekretariate", 'name' => "Sekretariate"],
                            ['pfad' => "/kontakte/sekretariate", 'name' => "Hausmeister"],
                            ['pfad' => "/sv", 'name' => "Schüler:innen Vertretung (SV)"],
                            ['pfad' => "/kontakte/spr", 'name' => "Schulpersonalrat (SPR)"],
                            ['pfad' => "/kontakte/gleichstellung", 'name' => "Gleichstellungsbeauftragte"],
                            ['pfad' => "https://www.ser-kgs.de", 'name' => "Schulelternrat (SER)"],
                            ['pfad' => "https://foerderverein.kgsraste.de", 'name' => "Förderverein"]
                        ];
                        snippet('menu/menu-category-column', [
                          'title' => 'Kontakt',
                          'menuItems' => $menuItems,
                        ]);

                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/schule/leitbild", 'name' => "Leitbild"],
                            ['pfad' => "/schule/schulprogramm", 'name' => "Schulprogramm"],
                            ['pfad' => "/unterricht/schulvorstand", 'name' => "Schulvorstand"],
                            ['pfad' => "/schule/geschichte", 'name' => "Unsere Geschichte"],
                            ['pfad' => "/schule/grundschule", 'name' => "Übergang Grundschule / KGS"],
                            ['pfad' => "/schule/zweige", 'name' => "Die drei Schulzweige"],
                            ['pfad' => "/schule/oberstufe", 'name' => "Oberstufe"],
                            ['pfad' => "/schule/abschluesse", 'name' => "Abschlüsse an der KGS"],
                            ['pfad' => "/schule/wahlen", 'name' => "Profile und Wahlen"],
                            ['pfad' => "/schule/organigramm", 'name' => "Zuständigkeiten / Organigram"],

                            ['pfad' => "/schule/ausbildungsschule", 'name' => "Ausbildungsschule"],
                            ['pfad' => "/schule/presse", 'name' => "Unsere Schule in der Presse"]
                        ];
                        snippet('menu/menu-category-column', [
                          'title' => 'Die KGS',
                          'menuItems' => $menuItems,
                        ]);
                        ?>
                        <div
                            class="col-span-2 space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                            <h4
                                class="font-semibold tracking-wider text-kgs-blue uppercase dark:text-kgs-lblue">
                                Aktuelles
                            </h4>
                            <div class="grid grid-cols-2 gap-4 xl:gap-8">
                                <a
                                    href="https://kgs-rastede.de/blogs/anmeldung-5"
                                    class="block space-y-3 text-sm font-semibold transition-opacity hover:text-kgs-blue hover:opacity-90 dark:hover:text-kgs-lblue">
                                    <img
                                        src="https://cdn.tailkit.com/media/placeholders/photo-8pb7Hq539Zw-300x180.jpg"
                                        class="rounded-lg"
                                        alt="Preview Image" />
                                    <h5>
                                        Anmeldung JG 5
                                    </h5>
                                </a>
                                <a
                                    href="https://kgs-rastede.de/blogs/wpk-wahl-jahrgang-5-im-realschulzweig"
                                    class="block space-y-3 text-sm font-semibold transition-opacity hover:text-kgs-blue hover:opacity-90 dark:hover:text-kgs-lblue">
                                    <img
                                        src="https://cdn.tailkit.com/media/placeholders/photo-TxXuh_hAFd8-300x180.jpg"
                                        class="rounded-lg"
                                        alt="Preview Image" />
                                    <h5>
                                        Wahlen WPK JG 5
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endslot(); ?>
                    <?php endsnippet(); ?>
                    <!-- END Kontakt Kategorie -->

                    <!-- Ueber die Schule Kategorie -->
                    <?php snippet(
                      'menu/menu-category',
                      ['title' => 'Unterricht & Schulleben'],
                      slots: true,
                    ); ?>
                    <?php slot('menuContent'); ?>
                    <div
                        class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">

                        <?php
                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/unterricht/ag-frieden", 'name' => "AG 'Für den Frieden'"],
                            ['pfad' => "/unterricht/streitschlichter", 'name' => "Streitschlichter"],
                            ['pfad' => "/unterricht/schulhund", 'name' => "Schulhund"],
                            ['pfad' => "/unterricht/schulradeln", 'name' => "Schulradeln"],
                            ['pfad' => "/unterricht/ssd", 'name' => "Schulsanitätsdienst"]
                        ];
                        snippet('menu/menu-category-column', [
                          'title' => '',
                          'menuItems' => $menuItems,
                        ]);

                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/unterricht/schulsport", 'name' => "Schulsport"],
                            ['pfad' => "/unterricht/bo-coaches", 'name' => "BO-Coaches. Hilfe bei der Berufsorientierung"],
                            ['pfad' => "/unterricht/wettbewerbe", 'name' => "Wettbewerbe"],
                            ['pfad' => "/unterricht/ag-angebot", 'name' => "Arbeitsgemeinschaften"],
                            ['pfad' => "/unterricht/online-schueler-innenzeitung", 'name' => "Schüler:innenzeitschrift IRREGULäR"],
                            ['pfad' => "/unterricht/herausforderungsprojekt/herausforderungsprojekt-2025", 'name' => "Herausforderungsprojekt 2025"]

                        ];
                        snippet('menu/menu-category-column', [
                          'title' => '',
                          'menuItems' => $menuItems,
                        ]);

                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/unterricht/erasmus", 'name' => "Erasmus"],
                            ['pfad' => "/unterricht/schule-ohne-rassismus-schule-mit-courage", 'name' => "Schule ohne Rassismus - Schule mit Courage"],
                            ['pfad' => "/beratungskonzept", 'name' => "Unterstützung und Beratung"],
                            ['pfad' => "/unterricht/inklusion", 'name' => "Inklusion"],
                            ['pfad' => "/unterricht/berufsorientierung", 'name' => "Berufliche Orientierung"],
                            ['pfad' => "/unterricht/schuelerfirmen", 'name' => "Schülerfirmen"],
                            ['pfad' => "/Faecher", 'name' => "Fächer"]
                        ];
                        snippet('menu/menu-category-column', [
                          'title' => '',
                          'menuItems' => $menuItems,
                        ]);
                        ?>

                        <div class="space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                            <h4
                                class="font-semibold tracking-wider text-kgs-blue uppercase dark:text-kgs-lblue">
                                Aktuell im Fokus
                            </h4>
                            <a
                                href="/unterricht/herausforderungsprojekt/herausforderungsprojekt-2025"
                                class="block space-y-3 text-sm font-semibold transition-opacity hover:text-kgs-blue hover:opacity-90 dark:hover:text-kgs-lblue">
                                <div
                                    class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-kgs-blue dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-kgs-lblue">
                                    <svg
                                        class="hi-mini hi-document-text inline-block size-10"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            fill-rule="evenodd"
                                            d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm2.25 8.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm0 3a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h5>Herausforderungsprojekt 2025</h5>
                            </a>
                        </div>
                    </div>
                    <?php endslot(); ?>
                    <?php endsnippet(); ?>
                    <!-- END Ueber die Schule Kategorie -->

                    <!-- Unterricht und Schulleben Kategorie -->
                    <?php snippet(
                      'menu/menu-category',
                      ['title' => 'Informationen'],
                      slots: true,
                    ); ?>
                    <?php slot('menuContent'); ?>
                    <div
                        class="grid scale-95 grid-cols-4 opacity-0 transition duration-500 ease-out group-hover:scale-100 group-hover:opacity-100">

                        <?php
                        // prettier-ignore
                        $menuItems = [
                            ['pfad' => "/allgemeines/wichtigelinks", 'name' => "Informationen und Formular"],
                            ['pfad' => "/allgemeines/schulbuchlisten", 'name' => "Schulbuchlisten"],
                            ['pfad' => "/allgemeines/bus", 'name' => "Buszeiten"],
                            ['pfad' => "/allgemeines/zeitraster", 'name' => "Zeitraster"],
                            ['pfad' => "https://wiki.kgs-rastede.de/de/eltern/elterninfos_kompakt", 'name' => "Eltern-Wiki"]
                        ];
                        snippet('menu/menu-category-column', [
                          'title' => 'Informationen',
                          'menuItems' => $menuItems,
                        ]);
                        ?>

                        <div
                            class="col-span-3 space-y-6 bg-gray-50 p-8 dark:bg-gray-700/25">
                            <h4
                                class="font-semibold tracking-wider text-kgs-blue uppercase dark:text-kgs-lblue">
                                <?= page('navbar')->Linkmenue2_1()->toUrl() ?>
                            </h4>
                            <div class="grid grid-cols-3 gap-4 xl:gap-8">
                                <a
                                    href="<?= page('navbar')
                                      ->Linkmenue2_1()
                                      ->toUrl() ?>"
                                    class="block space-y-3 text-sm font-semibold transition-opacity hover:text-kgs-blue hover:opacity-90 dark:hover:text-kgs-lblue">
                                    <div
                                        class="flex h-32 items-center justify-center rounded-lg border border-gray-200 bg-white text-emerald-500 dark:border-gray-700/75 dark:bg-gray-900/50 dark:text-emerald-400">
                                        <svg
                                            class="hi-mini hi-users inline-block size-10"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
                                        </svg>
                                    </div>
                                    <h5>
                                        Elterninformationen
                                    </h5>
                                </a>

                            </div>
                        </div>
                    </div>
                    <?php endslot(); ?>
                    <?php endsnippet(); ?>
                    <!-- END Unterricht und Schulleben Kategorie -->

                    <li class="group">
                        <a
                            href="/allgemeines/kalender "
                            class="inline-flex h-8 items-center gap-1 px-2.5 text-lg font-semibold text-gray-900 group-hover:text-kgs-blue dark:text-gray-100 dark:group-hover:text-kgs-lblue">
                            <span>Kalender</span>
                        </a>
                    </li>
                </ul>
                <!-- END Mega Menu visible on large screens -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="flex items-center">
                <!-- Icon mit aufklappbarer Suche zeigen -->
                <i x-show="!searchOpen" @click="searchOpen = true; $nextTick(() => $refs.searchInput.focus())" class="bi bi-search hidden rounded-full py-1 px-2 lg:block hover:sclae-105 hover:bg-gray-200"></i>
                <form
                    x-show="searchOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-50 translate-x-20"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    @click.outside="searchOpen = false"

                    action="/search">
                    <div class="hidden items-center space-x-2 w-md rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-900 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-gray-300 focus-within:outline-opacity-25 active:border-gray-200 active:shadow-none lg:inline-flex dark:transparent dark:text-gray-300 dark:hover:border-gray-600 dark:focus-within:outline-opacity-40 dark:active:border-gray-700">
                        <input type="text"
                            x-ref="searchInput"
                            class="grow focus:outline-none"
                            id="search" name="q" placeholder="Suche..." />
                        <button type="button"
                            @click="searchOpen = false"
                            class="text-gray-500 bg-white rounded-full px-1 hover:text-gray-700 hover:bg-gray-200">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>

                </form>

                <!-- Open Mobile Navigation -->
                <div class="ml-3 lg:hidden">
                    <button
                        x-on:click="mobileNavOpen = true"
                        type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-900 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-transparent dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
                        aria-controls="tkMobileNav">
                        <svg
                            class="hi-mini hi-bars-3 inline-block size-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <!-- END Open Mobile Navigation -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Main Header Content -->
        <?= snippet('menu/menu-mobile') ?>

    </header>
    <!-- END Header -->


</div>
<!-- END Main Header Section: With Mega Menu -->