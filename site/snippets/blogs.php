<?= $page->text()->kirbytext() ?>

  <?php foreach(page('blogs')->children()->listed()->flip()->limit($limit) as $article): ?>

  <article>
    <h1><?= $article->title()->html() ?></h1>
    <p><?= $article->text()->excerpt(200) ?></p>
    <a href="<?= $article->url() ?>">Mehr lesen…</a>
  </article>

  <?php endforeach ?>