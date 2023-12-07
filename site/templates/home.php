<?php snippet('header') ?>
<?php snippet('home-page-header') ?>

<?php snippet('box-notfall') ?>

<div class="mx-4 flex flex-wrap">
  <!-- Major Column (2/3 width) -->
  <div class="lg:w-2/3 mb-8 lg:mb-0 pr-4"> <!-- Added pr-4 for right margin -->
    <?php snippet('box-fokus') ?>
    <?php snippet('box-blogs') ?>
  </div>

  <!-- Sidebar Column (1/3 width) -->
  <div class="lg:w-1/3">
    <?php snippet('box-kalender') ?>
    <?php snippet('box-presse') ?>
  </div>
</div>

<?php snippet('box-links') ?>




<?php snippet('footertw') ?>