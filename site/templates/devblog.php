<?php snippet('header-devblog') ?>




<main role="main">

    <div class="flex mb-4">
    <div class="w-3/2 bg-gray-300">

            <h1 class="mt-6 ml-8 mb-6 text-4xl font-bold text-gray-900 leading-tight">
                Der Entwicklerblog der KGS Rastede
            </h1>

            <h3 class="mt-6 ml-12 mb-6 text-2xl text-gray-600">
                Die Technik hinter dieser Homepage
            </h3>

            <hr class="border-b-2 border-gray-400 mb-8 mx-4">

            <!-- Durch alle hervorgehobenen Artikel durchgehen -->
            <div class="grid grid-flow-row sm:grid-flow-row md:grid-flow-col">

                <?php foreach ($articles->filterBy('featured', true) as $a) : ?>
                    <div class="max-w-lg mx-2 rounded overflow-hidden shadow-lg bg-gray-400">

                    <div class="px-2 py-4">
                            <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                                <?= $a->title() ?>
                            </h1>
                            <p class="mt-3 text-gray-600">
                                <?= $a->Text()->blocks()->excerpt(250) ?>
                            </p>
                            <div class="mt-5 mt-">
                                <a href="<?= $a->url() ?>" class="inline-block px-2 py-2 rounded-lg shadow-lg bg-indigo-400 hover:bg-indigo-400 text-sm text-white uppercase tracking-wider font-semibold">Weiterlesen</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>

            <!-- kleine Trennlinie -->
            <hr class="border-b-4 mt-10 border-gray-400 mb-10 mx-8">

            <div class="max-w-screen-xl mx-auto px-2">
                <!-- Grid wrapper -->
                <div class="-mx-2 flex flex-wrap">
                    <?php foreach ($articles as $a) : ?>

                        <!-- Grid column -->
                        <div class="w-full flex flex-col p-2 sm:w-1/2 lg:w-1/3">
                            <!-- Column contents -->
                            <div class="flex-1 px-4 py-12 bg-gray-300 rounded-lg shadow-lg">
                                <!-- Card contents -->
                                <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                                    <?= $a->title() ?>
                                </h1>

                                <div class="flex items-baseline justify-between">
                                    <h3 class="mt-6 font-bold text-gray-600 leading-tight">
                                        <?= $a->heading() ?>
                                    </h3>

                                    <?= $a->date() ?>

                                </div>
                                

                                <div class="p-2">
                                    <div class="px-1 py-1">
                                        <?php foreach ($a->tags()->split() as $tag) : ?>
                                            <a href="<?= url('devblog', ['params' => ['tag' => $tag]]) ?>">
                                                <span class="inline-block bg-blue-200 text-blue-800 text-sm px-2 rounded-full uppercase font-semibold tracking-wide"><?= $tag ?></span>
                                            </a>
                                        <?php endforeach ?>
                                    </div>
                                </div>


                                <p class="card-text mb-auto">
                                    <?= $a->Text()->blocks()->excerpt(250) ?>
                                </p>
                                <div class="mt-10">
                                    <a href="<?= $a->url() ?>" class="inline-block px-5 py-3 rounded-lg shadow-lg bg-indigo-500 hover:bg-indigo-400 text-sm text-white uppercase tracking-wider font-semibold">Weiterlesen</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>


        </div>
        <div class="w-1/5 bg-gray-400">

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

            <div class="px-1 py-1">

                <?php foreach ($tags_gezaehlt as $tagkey => $tagvalue) : ?>
                    <a href="<?= url('devblog', ['params' => ['tag' => $tagkey]]) ?>">

                        <span class="inline-block bg-blue-200 text-blue-800 text-lg p-2 m-2 rounded-full uppercase font-semibold tracking-wide"><?= $tagkey ?>
                        <span class="bg-red-200 text-red-800 text-lg px-1 rounded"><?= $tagvalue ?>
                            </span>
                        </span>


                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>







</main>

<?php snippet('footer-tailwind') ?>