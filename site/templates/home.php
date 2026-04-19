<?php snippet('header'); ?>
<?php snippet('home-page-header'); ?>


<?php if (
  page('wichtige-informationen')->togglenotfall()->toggle()->bool() === true
): ?>
  <div class="rounded-lg border-8 border-dashed border-slate-800">
    <article class="bg-red-400 py-8 px-8 text-2xl leading-10 prose-h1:text-lg dark:bg-slate-700/25 prose-a:text-blue-600">
      <?= page('wichtige-informationen')->notfalltext()->kirbytext() ?>
    </article>
  </div>

<?php else: ?>
  <?php snippet('box-notfall'); ?>

  <?php snippet('box-schnellverweise'); ?>

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