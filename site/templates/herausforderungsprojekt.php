<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Berichte aus dem Herausforderungsprojekt',
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Herausforderungsprojekt', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
