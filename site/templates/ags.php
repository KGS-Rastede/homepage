<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Berichte aus den Arbeitsgemeinschaften',
    'relatedBlogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'AGs', ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<div class="mb-4 mt-4">
  <h3 class="mb-3">Arbeitsgemeinschaften im Schuljahr
    <?= Escape::html($page->termYear()) ?>
  </h3>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($page->children() as $arbeitsgemeinschaft): ?>
      <div class="col-span-1">
        <div class="bg-white shadow-md rounded-md overflow-hidden">
          <div class="p-4">
            <h4 class="text-lg font-bold">
              <?= Escape::html($arbeitsgemeinschaft->title()) ?>
            </h4>
          </div>

          <?php if ($image = $arbeitsgemeinschaft->image()): ?>
            <a href="<?= $arbeitsgemeinschaft->url() ?>" class="block">
              <?= $image
                ->crop(650, 488, 'center')
                ->html(['class' => 'w-full object-cover max-h-96']) ?>
            </a>
          <?php else: ?>
            <div class="p-4">
              <a href="<?= $arbeitsgemeinschaft->url() ?>" class="text-blue-500 hover:underline">mehr...</a>
            </div>
          <?php endif; ?>
        </div>

      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="mb-4 mt-5">
  <?= $page->more_text()->toBlocks() ?>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
