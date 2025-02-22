<?php snippet('header'); ?>
<?php snippet('home-page-header'); ?>


<?php if (
  page('wichtige-informationen')->togglenotfall()->toggle()->bool() === true
): ?>
  <div class="rounded-lg border-8 border-dashed border-gray-800">
    <article class="bg-red-400 py-8 px-8 text-2xl leading-10 prose-h1:text-lg dark:bg-gray-700/25 prose-a:text-blue-600">
      <?= page('wichtige-informationen')->notfalltext()->kirbytext() ?>
    </article>
  </div>

<?php else: ?>
  <?php snippet('box-notfall'); ?>

  <div class="m-4 flex flex-wrap xl:mx-20 2xl:mx-40">
    <!-- Major Column (2/3 width) -->
    <div class="lg:w-2/3 mb-8 lg:mb-0 pr-4"> <!-- Added pr-4 for right margin -->
      <?php snippet('box-fokus'); ?>
      <?php snippet('box-blogs'); ?>
    </div>

    <!-- Sidebar Column (1/3 width) -->
    <div class="lg:w-1/3">
      <?php snippet('box-kalender'); ?>
      <?php snippet('box-presse'); ?>
    </div>
  </div>

  <?php snippet('box-links'); ?>


<?php endif; ?>


<?php snippet('footertw'); ?>
