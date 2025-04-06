<?php
snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Blogeinträge für das Tag: ' . $page->blogtag(),
  'relatedBlogs' => $page->blogtag()->isNotEmpty()
    ? page('blogs')
      ->children()
      ->listed()
      ->filterBy('tags', $page->blogtag(), ',')
      ->flip()
    : null,
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
