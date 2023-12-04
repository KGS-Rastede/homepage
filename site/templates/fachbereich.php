<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<div class="container">

  <?php foreach (collection('blogs')->filterBy('tags', 'in', $page->tags()->split(','), ',' )->flip() as $subpage) :
    snippet('blogkarte', ['subpage' => $subpage]); ?>
  <?php endforeach ?>

    <h2>Der Fachbereich besteht aus folgenden Fächern</h2>
  <?php
  $relatedPages =  $page->pages()->toPages();
  foreach ($relatedPages as $relatedPage) : ?>
    <a href="<?= $relatedPage->url() ?>"><?= $relatedPage->title() ?></a>
  <?php endforeach ?>
</div>

<?php snippet('footer') ?>