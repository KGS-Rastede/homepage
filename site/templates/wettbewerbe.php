<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Berichte aus Wettbewerben',
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'Wettbewerb', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
