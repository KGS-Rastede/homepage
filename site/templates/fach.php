<?php snippet('default-page-layout', slots: true);
slot();
?>


<?php snippet('inhalt'); ?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Aktuelles aus dem Fach',
  'relatedBlogs' => collection('blogs-haupttag')->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
