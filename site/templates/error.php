<?php snippet('header'); ?>

<!-- Pages: Errors: 404 -->
<!-- Page Container -->
<div
    id="page-container"
    class="mx-auto flex min-h-dvh w-full min-w-80 flex-col bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex max-w-full flex-auto flex-col">
        <div
            class="relative flex min-h-dvh items-center overflow-hidden bg-white dark:bg-gray-800">
            <!-- Left/Right Background -->
            <div
                class="absolute top-0 bottom-0 left-0 -ml-44 w-48 bg-gray-50 md:-ml-28 md:skew-x-6 dark:bg-gray-500/10"
                aria-hidden="true"></div>
            <div
                class="absolute top-0 right-0 bottom-0 -mr-44 w-48 bg-gray-50 md:-mr-28 md:skew-x-6 dark:bg-gray-500/10"
                aria-hidden="true"></div>
            <!-- END Left/Right Background -->

            <!-- Error Content -->
            <div
                class="relative container mx-auto space-y-16 px-8 py-16 text-center lg:py-32 xl:max-w-7xl">
                <div>
                    <div class="mb-5 text-gray-300 dark:text-gray-300/50">
                        <svg
                            class="hi-outline hi-document-magnifying-glass inline-block size-12"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div
                        class="text-6xl font-extrabold text-gray-600 md:text-7xl dark:text-gray-500">
                        404
                    </div>
                    <div
                        class="mx-auto my-6 h-1.5 w-12 rounded-lg bg-gray-200 md:my-10 dark:bg-gray-700"
                        aria-hidden="true"></div>
                    <h1 class="mb-3 text-2xl font-extrabold md:text-3xl">
                        Die Seite wurde nicht gefunden
                    </h1>
                    <h2
                        class="mx-auto mb-5 font-medium text-gray-500 md:leading-relaxed lg:w-3/5 dark:text-gray-300">
                        Scheinbar wurde die Seite nicht gefunden. Vielleicht wurde sie gelöscht oder umbenannt. Benutzten Sie gerne die Suche.
                    </h2>
                    <form class="mx-auto max-w-sm space-y-1" onsubmit="return false;">
                        <div class="relative">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 my-px ml-px flex w-12 items-center justify-center rounded-l-lg text-gray-500 dark:text-gray-300">
                                <svg
                                    class="hi-mini hi-magnifying-glass inline-block size-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true">
                                    <path
                                        fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                placeholder="Suchen..."
                                class="block w-full rounded-lg border border-gray-200 py-3 pr-5 pl-12 leading-6 placeholder-gray-500 focus:border-gray-500 focus:ring-3 focus:ring-gray-500/50 dark:border-gray-600 dark:bg-gray-800 dark:placeholder-gray-400 dark:focus:border-gray-500" />
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


<?php snippet('footertw'); ?>
