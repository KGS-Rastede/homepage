<div class="feed">
    <?php $rssFeedPage = site()->page('rssfeed'); ?>
    <?php foreach ($rssFeedPage->children()->sortBy('date', 'desc') as $item): ?>
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

