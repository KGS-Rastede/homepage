<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Blogeinträge für das Tag: ' . $page->blogtag(),
    'relatedBlogs' => $page->blogtag()->isNotEmpty()
      ? page('blogs')
        ->children()
        ->listed()
        ->filterBy('tags', $page->blogtag(), ',')
        ->flip()
      : null,
  ],
  slots: true,
);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
