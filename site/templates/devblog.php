<?php snippet('header') ?>

<?php foreach ($articles->filterBy('featured', true) as $a) : ?>

<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic"><?= $a->title() ?></h1>
        <p class="lead my-3"><?= $a->Text()->blocks()->excerpt(250) ?></p>
        <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Weiterlesen...</a></p>
    </div>
</div>

<?php endforeach ?>


<div class="row mb-2">

    <?php foreach ($articles as $a) : ?>


        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary">World</strong>
                    <h3 class="mb-0"><?= $a->title() ?></h3>
                    <h4 class="mb-0"><?= $a->heading() ?></h4>

                    <div class="mb-1 text-muted"><?= $a->date() ?></div>

                    <div class="mb-1"> <svg class="bi" width="24" height="24">
                            <use xlink:href="<?= $kirby->url('assets') ?>/icons/bootstrap-icons.svg#tags" />
                        </svg> Tags:
                        <?php foreach ($a->tags()->split() as $tag) : ?>
                            <a href="<?= url('blogs', ['params' => ['tag' => $tag]]) ?>">
                                <span class="badge rounded-pill bg-info"><?= $tag ?></span>
                            </a>
                        <?php endforeach ?>
                    </div>

                    <p class="card-text mb-auto">
                        <?= $a->Text()->blocks()->excerpt(250) ?>
                    </p>
                    <a href="<?= $a->url() ?>" class="stretched-link">Continue reading &#8594;</a>


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





<?php snippet('footer') ?>