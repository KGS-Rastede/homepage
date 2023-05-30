<?php snippet('header') ?>

<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>

<?php $articlesQuery = page('blogs')->children()->listed()->filterBy('tags', 'SCHULRADELN', ','); ?>
<?php if ($articlesQuery->isNotEmpty()) : ?>
<div class="container">
  <h2>Berichte über das SCHULRADELN</h2>

  <?php foreach ($articlesQuery->flip() as $subpage): ?>
  <?= snippet('blogkarte', ['subpage' => $subpage]) ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<?php snippet('footer') ?>
