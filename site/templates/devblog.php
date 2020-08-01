<?php snippet('header') ?>

<main role="main">




    <!-- Titelfeld -->
    <div class="titelfeld">
        <div class="container p-5 mt-5 text-center">
            <h1>
                <?= $page->title() ?>
            </h1>
            <small class="text-muted"><?= $page->subtitle() ?></small>

            <p class="lead">
                <?= $page->heading() ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">


            <!-- Ab hier der richtige Inhalt, der auf jeder Seite individuell sein kann -->
            <div class="container">

                <?php foreach ($articles->filterBy('featured', true) as $a) : ?>

                    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
                        <div class="col-md-6 px-0">
                            <h1 class="display-4 font-italic"><?= $a->title() ?></h1>
                            <p class="lead my-3"><?= $a->Text()->blocks()->excerpt(250) ?></p>
                            <p class="lead mb-0"><a href="<?= $a->url() ?>" class="text-white font-weight-bold">Weiterlesen...</a></p>
                        </div>
                    </div>

                <?php endforeach ?>


                <div class="row mb-2">

                    <?php foreach ($articles as $a) : ?>


                        <div class="col-md-6">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">World</strong>
                                    <h3 class="mb-2"><?= $a->title() ?></h3>
                                    <h4 class="mb-4"><?= $a->heading() ?></h4>
                                    <div class="mb-1"><?= $a->date() ?> <svg class="bi" width="24" height="24">
                                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                                        </svg> Tags:
                                        <?php foreach ($a->tags()->split() as $tag) : ?>
                                            <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
                                                <span class="badge rounded-pill bg-info"><?= $tag ?></span>
                                            </a>
                                        <?php endforeach ?>
                                    </div>

                                    <p class="card-text mb-auto">
                                        <?= $a->Text()->blocks()->excerpt(250) ?>
                                    </p>
                                    <a href="<?= $a->url() ?>">Weiterlesen &#8594;</a>


                                </div>
                                <div class="col-auto d-none d-lg-block">
                                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                    </svg>

                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>


                </div>



            </div>



        </div>
        <div class="col-md-4">
            <div class="card mb-1 mt-5 mr-2">
                <div class="card-body ">
                    <h1>Tagcloud</h1>

                    <?php

                    $alletags = new ArrayObject(array());

                        foreach ($articles as $article) :
                            foreach ($article->tags()->split() as $tag) :
                                $alletags->append($tag);
                            endforeach;
                        endforeach;

                        $tags_gezaehlt = array_count_values($alletags->getArrayCopy());

                    ?>

                    <?php foreach ($tags_gezaehlt as $tagkey => $tagvalue) : ?>
                        <a href="<?= url('devblog', ['params' => ['tag' => $tagkey]]) ?>">

                            <button type="button" class="btn btn-primary m-2">
                                <?= $tagkey ?> <span class="badge bg-secondary"><?= $tagvalue ?></span>
                            </button>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <?php snippet('footer') ?>