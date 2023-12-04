<?php snippet('header') ?>
<?php snippet('headertw') ?>

<!-- Pages: Errors: 404 -->
<!-- Page Container -->
<div id="page-container" class="flex flex-col mx-auto w-full min-h-screen min-w-[320px] bg-gray-100 dark:text-gray-100 dark:bg-gray-900">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
        <div class="relative flex items-center min-h-screen bg-white overflow-hidden dark:bg-gray-800">
            <!-- Left/Right Background -->
            <div class="absolute left-0 top-0 bottom-0 w-48 bg-orange-50 transform md:skew-x-6 -ml-44 md:-ml-28 dark:bg-orange-500 dark:bg-opacity-10" aria-hidden="true"></div>
            <div class="absolute right-0 top-0 bottom-0 w-48 bg-orange-50 transform md:skew-x-6 -mr-44 md:-mr-28 dark:bg-orange-500 dark:bg-opacity-10" aria-hidden="true"></div>
            <!-- END Left/Right Background -->

            <!-- Error Content -->
            <div class="relative text-center space-y-16 container xl:max-w-7xl mx-auto px-8 py-16 lg:py-32">
                <div>
                    <div class="mb-5 text-orange-300 dark:text-orange-300/50">
                        <svg class="hi-outline hi-hand-raised inline-block w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                        </svg>
                    </div>
                    <div class="text-6xl md:text-7xl font-extrabold text-orange-600 dark:text-orange-500">
                        404
                    </div>
                    <div class="w-12 h-1.5 bg-gray-200 rounded-lg mx-auto my-6 md:my-10 dark:bg-gray-700" aria-hidden="true"></div>
                    <h1 class="text-2xl md:text-3xl font-extrabold mb-3">
                        Die Seite wurde nicht gefunden
                    </h1>
                    <form class="space-y-1 max-w-sm mx-auto" action="/search">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 w-12 my-px ml-px flex items-center justify-center pointer-events-none rounded-l-lg text-gray-500 dark:text-gray-400">
                                <svg class="hi-mini hi-magnifying-glass inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="q" placeholder="Suche.." class="w-full block border placeholder-gray-500 pl-12 pr-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-rose-500 focus:ring focus:ring-rose-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-rose-500 dark:placeholder-gray-400">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Error Content -->
        </div>
    </main>
    <!-- END Page Content -->
</div>
<!-- END Page Container -->
<!-- END Pages: Errors: 404 -->

<?php snippet('footer') ?>
