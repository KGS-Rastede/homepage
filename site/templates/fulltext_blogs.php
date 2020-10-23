<?php snippet('header') ?>

<?php snippet('page-header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <?php foreach($articles as $article): ?>
            <div class="container">
                <h2><?= $article->title() ?></h2>
                <div class="blockqoute">
                    <div class="mt-3 blockquote-footer h5">
                        Datum: <?= $article->date()->toDate("d.m.Y") ?>
                        Autor: <?= $article->author() ?>
                    </div>
                </div>

                <?= $article->text()->blocks() ?>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="col">
            <?php if ($page->sidebar()->isNotEmpty()) : ?>
            <div class="card mb-3">
                <h5 class="card-title text-center">
                    <?php if ($page->sidetitel()->isNotEmpty()) : ?>
                        <?= $page->sidetitel()->kirbytext() ?>
                    <?php else : ?>
                        <?= "Weitere Informationen" ?>
                    <?php endif ?>
                </h5>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($page->sidebar()->toStructure() as $sidebar) : ?>
                        <li class="list-group-item">
                            <a href="<?= $sidebar->link() ?>"><?= $sidebar->name() ?></a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
  <?php
    $pagination = $articles->pagination();

    snippet('pagination', [
      'pagination' => $pagination
    ])
  ?>
</div>


<?php snippet('footer') ?>
