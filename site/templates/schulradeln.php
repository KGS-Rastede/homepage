<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Berichte über das SCHULRADELN',
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'SCHULRADELN', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
