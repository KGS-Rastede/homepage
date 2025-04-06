<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Projekte:',
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Projektwoche', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
