<?php snippet('default-page-layout', slots: true);
slot();
?>


<?= $page->text()->toBlocks() ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Aktuelles aus dem Fach',
  'relatedBlogs' => collection('blogs-haupttag')->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
