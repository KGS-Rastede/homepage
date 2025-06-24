<?php snippet('default-page-layout', slots: true);
slot();
?>

<h2>Der Fachbereich besteht aus folgenden Fächern</h2>
<?php
$relatedPages = $page->pages()->toPages();
foreach ($relatedPages as $relatedPage): ?>
  <a href="<?= $relatedPage->url() ?>"><?= $relatedPage->title() ?></a>
<?php endforeach;
?>

<?php snippet('sidebar'); ?>
<?php snippet('related-blogs', [
  'relatedBlogsTitle' => 'Aktuelles aus dem Fachbereich',
  'relatedBlogs' => collection('blogs')
    ->filterBy('tags', 'in', $page->tags()->split(','), ',')
    ->flip(),
]); ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
