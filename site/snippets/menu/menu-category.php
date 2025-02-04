<?php 
/* Diese Datei erstellt das Layout einer aufklappbaren Kategorie im Menü. Dabei wird nicht der 
Inhalt, welcher im aufgeklappten Menü angezeigt wird, festgelegt. Dieser wird mit Kirby Slots übergeben.
Siehe: https://getkirby.com/docs/guide/templates/snippets#passing-slots-to-snippets */
?>

<li
    class="group [&:focus-within>div]:visible [&:focus-within>div>div]:scale-100 [&:focus-within>div>div]:opacity-100 [&:focus-within>div>div>div]:scale-100 [&:focus-within>div>div>div]:opacity-100">
    <!-- Sichtbarer Titel -->
    <a
        href="javascript:void(0)"
        class="inline-flex h-8 items-center gap-1 px-2.5 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 dark:text-gray-100 dark:group-hover:text-indigo-400">
        <span><?= $title ?></span>
        <svg
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
            class="hi-solid hi-chevron-down inline-block size-4 opacity-50">
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </a>
    <!-- END Sichtbarer Titel -->

    <!-- Das tatsächliche Menü -->
    <div
        class="invisible absolute top-16 right-8 left-8 z-1 pt-4 group-hover:visible">
        <div
            class="origin-top scale-90 overflow-hidden rounded-lg bg-white opacity-0 ring-1 shadow-xl ring-black/5 transition duration-300 ease-out group-hover:scale-100 group-hover:opacity-100 dark:bg-gray-800 dark:ring-white/10">
            <?= $slots->menuContent() ?>
        </div>
    </div>
    <!-- END Das tatsächliche Menü -->
</li>