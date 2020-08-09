<?php snippet('header-devblog') ?>




<main role="main">

    <div class="flex mb-4">
        <div class="w-3/4 bg-gray-300">

            <h1 class="mt-6 mb-6 text-4xl font-bold text-gray-900 leading-tight">
                Der Entwicklerblog der KGS Rastede
            </h1>

            <h3 class="mt-6 mb-6 text-2xl text-gray-600">
                Die Technik hinter dieser Homepage
            </h3>

            <hr class="border-b-2 border-gray-400 mb-8 mx-4">


            <div class="grid grid-flow-row sm:grid-flow-row md:grid-flow-col">

                <?php foreach ($articles->filterBy('featured', true) as $a) : ?>
                    <div class="max-w-lg mx-2 rounded overflow-hidden shadow-lg bg-gray-500">

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
                    </div>

                <?php endforeach ?>
            </div>

            <hr class="border-b-2 mt-6 border-gray-400 mb-8 mx-4">


            <div class="grid grid-flow-row sm:grid-flow-row md:grid-flow-col">
                <?php foreach ($articles as $a) : ?>

                    <div class="pt-5">

                        <div class="max-w-lg mx-2 rounded overflow-hidden shadow-lg bg-gray-300">
                            <div class="col p-4 d-flex flex-column position-static">
                                <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                                    <?= $a->title() ?>
                                </h1>

                                <h3 class="mt-6 font-bold text-gray-600 leading-tight">
                                    <?= $a->heading() ?>
                                </h3>




                                <?= $a->date() ?>
                                <div class="px-6 py-4">
                                    <svg class="bi" width="24" height="24">
                                        <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                                    </svg>

                                    <?php foreach ($a->tags()->split() as $tag) : ?>
                                        <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
                                            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow">
                                                <?= $tag ?>
                                            </button>


                                        </a>

                                    <?php endforeach ?>
                                </div>


                                <p class="card-text mb-auto">
                                    <?= $a->Text()->blocks()->excerpt(250) ?>
                                </p>
                                <a href="<?= $a->url() ?>" class="inline-block px-5 py-3 rounded-lg shadow-lg bg-indigo-500 hover:bg-indigo-400 text-sm text-white uppercase tracking-wider font-semibold">Weiterlesen</a>


                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>

        </div>
        <div class="w-1/4 bg-gray-400">

            <h3 class="mt-6 mb-6 text-2xl text-gray-600">
                Tagcloud
            </h3>

            <?php

            $alletags = new ArrayObject(array());

            foreach ($articles as $article) :
                foreach ($article->tags()->split() as $tag) :
                    $alletags->append($tag);
                endforeach;
            endforeach;

            $tags_gezaehlt = array_count_values($alletags->getArrayCopy());

            ?>

            <div class="px-6 py-4">

                <?php foreach ($tags_gezaehlt as $tagkey => $tagvalue) : ?>
                    <a href="<?= url('devblog', ['params' => ['tag' => $tagkey]]) ?>">



                        <button class='relative bg-blue-500 text-white p-6 rounded font-bold overflow-visible mt-6 mr-6'><?= $tagkey ?>
                            <div class="absolute top-0 right-0 -mt-2 -mr-2 px-4 py-1 bg-red-500 rounded-full"><?= $tagvalue ?></div>
                        </button>

                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>







</main>

<?php snippet('footer-tailwind') ?>