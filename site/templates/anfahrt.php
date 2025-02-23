<?php snippet('default-page-layout', slots: true);
slot();
?>

<div class="mt-16 sm:mt-20 md:mt-24">
  <p>
    <?= $page->main_text() ?>
  </p>
  <p>
    <?= $page->anfahrt_text() ?>
  </p>

  <dl
    class="mt-4 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base leading-7 text-gray-300 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:gap-x-8 lg:gap-y-16">
    <div class="relative pl-9">
      <dt class="inline font-semibold text-white">

        <?= $page->adresse_s1()->toBlocks() ?>


      </dt>
      <dt class="mt-4">

        <?= $page->anfahrt_text_s1()->toBlocks() ?>

      </dt>
    </div>
    <div class="relative pl-9">
      <dt class="inline font-semibold text-white">

        <?= $page->adresse_s2()->toBlocks() ?>
      </dt>
      <dt class="mt-4">

        <?= $page->anfahrt_text_s2()->toBlocks() ?>

      </dt>

    </div>

  </dl>
</div>
<div class="relative overflow-hidden pt-16 lg:pt-20">
  <div class="px-6 lg:px-8">
    <?= $page->karte()->toBlocks() ?>
  </div>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
