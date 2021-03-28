<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="container">
    <?php foreach($articles as $article): ?>
    <div class="container">
        <h2><?= $article->title() ?></h2>
        <div class="blockqoute">
            <div class="mt-3 blockquote-footer h5">
                Datum: <?= $article->date()->toDate("d.m.Y") ?>
                geschrieben von: <?= $article->author() ?>
            </div>
        </div>

        <?= $article->text()->toBlocks() ?>
    </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-center">
  <?php
    $pagination = $articles->pagination();

    snippet('pagination', [
      'pagination' => $pagination
    ])
  ?>
</div>

<?php snippet('sidebar') ?>


<?php snippet('footer') ?>
