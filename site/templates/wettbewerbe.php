<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Berichte aus Wettbewerben',
    'relatedBlogs' => page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', 'Wettbewerb', ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
