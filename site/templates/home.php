<?php snippet('header'); ?>
<?php snippet('home-page-header'); ?>


<?php if (
  page('wichtige-informationen')->togglenotfall()->toggle()->bool() === true
): ?>
  <!-- Alert nach Tailkit a-c-alerts-06 (Danger) -->
  <div class="mx-4 xl:mx-20 2xl:mx-40 my-6 flex items-start gap-4 rounded-xl border border-rose-200 bg-rose-50 p-6 md:p-8 dark:border-rose-900/50 dark:bg-rose-950/25 dark:text-slate-100">
    <div class="flex-none">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
        class="inline-block size-10 text-rose-600 dark:text-rose-400" aria-hidden="true">
        <path fill-rule="evenodd"
          d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
          clip-rule="evenodd" />
      </svg>
    </div>
    <article class="grow text-xl leading-relaxed prose-h1:text-2xl prose-h1:font-semibold prose-a:text-kgs-blue dark:prose-a:text-kgs-lblue">
      <?= page('wichtige-informationen')->notfalltext()->kirbytext() ?>
    </article>
  </div>

<?php else: ?>
  <?php snippet('box-notfall'); ?>

  <?php snippet('box-schnellverweise'); ?>

  <?php snippet('box-eventwidget'); ?>

  <div class="mx-4 xl:mx-20 2xl:mx-40 mt-6">
    <div class="flex flex-wrap">
      <div class="w-full lg:w-2/3 mb-8 lg:mb-0 lg:pr-6">
        <?php snippet('box-fokus'); ?>
        <?php snippet('box-blogs'); ?>
      </div>
      <div class="w-full lg:w-1/3">
        <?php snippet('box-kalender'); ?>
        <?php snippet('box-presse'); ?>
      </div>
    </div>
    <div class="mt-8">
      <?php snippet('box-links'); ?>
    </div>
  </div>


<?php endif; ?>


<?php snippet('footertw'); ?>