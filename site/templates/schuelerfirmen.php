<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>


<div class="grid grid-cols-1 p-4 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

  <?php foreach ($page->children() as $sf): ?>
    <div class="group bg-slate-100 p-4">
      <div>
        <?php if ($image = $sf->bild()->toFile()): ?>
          <img src="<?= $image->url() ?>" class="aspect-[3/2] w-full rounded-2xl object-cover">
        <?php endif; ?>

        <div>
          <h3 class="mt-3 text-lg font-semibold text-gray-900 group-hover:text-gray-600">
            <?= $sf->Title() ?>
          </h3>
          <p class="mt-1 text-gray-600">
            <?= $sf->Heading() ?>
          </p>
          <p class="mt-3 leading-2 text-gray-600">
            <?= $sf->text()->toBlocks()->excerpt(300) ?>
          </p>

        </div>
      </div>

      <div class="mt-4">
        <?php snippet('knopf-klein', [
          'subpage' => $sf,
          'knopftext' => 'weiterlesen...',
        ]); ?>
      </div>

    </div>
  <?php endforeach; ?>

</div>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Aktuelles aus den Schülerfirmen',
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Schülerfirmen', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
