<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Projekte:',
    'relatedBlogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Projektwoche', ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
