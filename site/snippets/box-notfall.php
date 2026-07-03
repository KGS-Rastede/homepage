<?php
/*
    An besonderen Tagen (Schneefrei, Heizungsbruch, ...) soll ganz schnell
    ein Banner angezeigt werden, damit die Eltern schnell informiert werden können
*/
if (page('wichtige-informationen')->toggle()->bool() === true): ?>



    <!-- Alert nach Tailkit a-c-alerts-06 (Danger) -->
    <div class="mx-4 xl:mx-20 2xl:mx-40 my-4 flex items-start gap-4 rounded-xl border border-rose-200 bg-rose-50 p-4 md:p-6 dark:border-rose-900/50 dark:bg-rose-950/25 dark:text-slate-100">
        <div class="flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="inline-block size-8 text-rose-600 dark:text-rose-400" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <article class="grow text-lg leading-relaxed prose-a:text-kgs-blue dark:prose-a:text-kgs-lblue">
            <h1 class="text-xl font-semibold"><?php page(
              'wichtige-informationen',
            )->textTitel(); ?></h1>

            <?= page('wichtige-informationen')->text()->kt() ?>
        </article>
    </div>

<?php endif; ?>
