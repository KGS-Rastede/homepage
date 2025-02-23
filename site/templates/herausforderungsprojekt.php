<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Berichte aus dem Herausforderungsprojekt',
    'relatedBlogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Herausforderungsprojekt', ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
