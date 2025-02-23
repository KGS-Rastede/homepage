<?php snippet(
  'default-page-layout',
  [
    'sidebarEnabled' => true,
    'relatedBlogsTitle' => 'Aktuelles aus dem Fachbereich',
    'relatedBlogs' => collection('blogs')
      ->filterBy('tags', 'in', $page->tags()->split(','), ',')
      ->flip(),
  ],
  slots: true,
);
slot();
?>

<h2>Der Fachbereich besteht aus folgenden Fächern</h2>
<?php
$relatedPages = $page->pages()->toPages();
foreach ($relatedPages as $relatedPage): ?>
  <a href="<?= $relatedPage->url() ?>"><?= $relatedPage->title() ?></a>
<?php endforeach;
?>

<?php endslot(); ?>
<?php endsnippet(); ?>
