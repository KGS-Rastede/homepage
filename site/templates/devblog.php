<?php snippet('header-devblog') ?>

<main role="main">

    <div class="flex mb-4">
        <div class="w-3/4 bg-gray-300">
            <?php foreach ($articles->filterBy('featured', true) as $a) : ?>

                <div class="px-8 py-12">
                    <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                        <?= $a->title() ?>
                    </h1>
                    <p class="mt-2 text-gray-600">
                        <?= $a->Text()->blocks()->excerpt(250) ?>
                    </p>
                    <div class="mt-4">
                        <a href="<?= $a->url() ?>" class="inline-block px-5 py-3 rounded-lg shadow-lg bg-indigo-500 hover:bg-indigo-400 text-sm text-white uppercase tracking-wider font-semibold">Weiterlesen</a>
                    </div>
                </div>

            <?php endforeach ?>


            <?php foreach ($articles as $a) : ?>

                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                            <?= $a->title() ?>
                        </h1>

                        <h3 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                            <?= $a->heading() ?>
                        </h3>


                        <h4 class="mb-4"><?= $a->heading() ?></h4>
                        <div class="mb-1"><?= $a->date() ?> <svg class="bi" width="24" height="24">
                                <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                            </svg> Tags:
                            <?php foreach ($a->tags()->split() as $tag) : ?>
                                <div class="px-6 py-4">
                                    <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2"><?= $tag ?></span>
                                    </a>
                                </div>

                            <?php endforeach ?>
                        </div>

                        <p class="card-text mb-auto">
                            <?= $a->Text()->blocks()->excerpt(250) ?>
                        </p>
                        <a href="<?= $a->url() ?>">Weiterlesen &#8594;</a>


                    </div>

                </div>

            <?php endforeach ?>


        </div>
        <div class="w-1/4 bg-gray-400">

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







</main>

<footer class='w-full text-center border-t border-grey p-4'>
    Der Entwicklerblog dieser Homepage
</footer>
</body>

</html>