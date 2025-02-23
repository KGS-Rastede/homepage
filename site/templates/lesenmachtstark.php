<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Berichte vom Projekt "Lesen macht stark"',
    'relatedBlogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Lesen macht stark', ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
