<?php
//
// Only a Page during development, in Production it will be a Snippet
//
?>

<div class="feed">
    <?php foreach ($page->children()->sortBy('date', 'desc') as $item): ?>
      <article>
        <header class="article-header">
          <h2><a><?= $item->title() ?></a></h2>
        </header>
        <div class="article-body">
          <?= $item->description()->kirbytext() ?>
        </div>
      </article>
    <?php endforeach ?>
</div>
