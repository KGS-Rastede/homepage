<?php snippet('default-page-layout', slots: true);
slot();
?>

<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogs' => page('blogs')
    ->children()
    ->listed()
    ->filterBy('tags', 'SV', ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
