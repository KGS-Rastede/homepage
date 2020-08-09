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


            <div class="grid grid-flow-row sm:grid-flow-row md:grid-flow-col">
                <?php foreach ($articles as $a) : ?>

                    <div class="pt-5">

                        <div class="max-w-lg mx-2 rounded overflow-hidden shadow-lg bg-white">
                            <div class="col p-4 d-flex flex-column position-static">
                                <h1 class="mt-6 text-2xl font-bold text-gray-900 leading-tight">
                                    <?= $a->title() ?>
                                </h1>

                                <h3 class="mt-6 font-bold text-gray-600 leading-tight">
                                    <?= $a->heading() ?>
                                </h3>

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
                    </div>

                <?php endforeach ?>

            </div>

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
    <div class="flex">
        <div class="w-2/5">
            <a href="<?= $site->url() ?>">
                <?php snippet('logo-als-svg') ?>
            </a>
        </div>
        <div class="w-1/5">
            <h5 class="font-bold">Kontakt</h5>
            <ul>
                <li><a class="text-muted" href="<?= page('kontakte/schulleitung')->url() ?>">Schulleitung</a></li>
                <li><a class="text-muted" href="<?= page('kontakte/fbl')->url() ?>">Fachbereichsleiter</a></li>
                <li><a class="text-muted" href="<?= page('kontakte/sekretariate')->url() ?>">Sekretariate</a></li>
                <!-- Funktioniert noch nicht
          <li><a class="text-muted" href="<?= page('allgemeines/krankmeldung')->url() ?>">Krankmeldung</a></li> 
        -->
            </ul>
        </div>
        <div class="w-1/5">
            <h5 class="font-bold">Über die KGS</h5>
            <ul>
                <li><a class="text-muted" href="<?= page('allgemeines/geschichte')->url() ?>">Unsere Geschichte</a></li>
                <li><a class="text-muted" href="<?= page('allgemeines/anfahrt')->url() ?>">Anfahrt</a></li>
                <li><a class="text-muted" href="<?= page('allgemeines/impressum')->url() ?>">Impressum</a></li>
                <li><a class="text-muted" href="<?= page('allgemeines/mensa')->url() ?>">Mensa</a></li>
            </ul>
        </div>
        <div class="w-1/5">
            <h5 class="font-bold">Wichtige Downloads</h5>
            <ul class="list-unstyled">
                <li><a class="text-muted" href="<?= page('allgemeines/downloads')->url() ?>#schulbuchlisten-1">Schulbuchlisten</a></li>
                <li><a class="text-muted" href="#">Schulordnung</a></li>
                <li><a class="text-muted" href="<?= page('allgemeines/wichtigelinks')->url() ?>">Wichtige Links</a></li>
            </ul>
        </div>
    </div>

</footer>
</body>

</html>