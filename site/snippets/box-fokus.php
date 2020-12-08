<?php if(collection('blogs-topartikel')->isNotEmpty()) : //wenn aktuelle Topartikel vorhanden sind?>

    <h2 class="mt-5 mb-3">Aktuell im Fokus</h2>
    <div class="card mb-3">
        <div class="card-body">

            <?php foreach (collection('blogs-topartikel') as $subpage) : ?>

                <?php if ( !$subpage->isFirst(collection('blogs-topartikel')) ) : ?>
                    <hr class="mt-3 mb-3">
                <?php endif //Trennstrich komm nur wenn es keine Artikel vor diesem Element gibt ?>
                
                <a class="btn btn-lg btn-block text-start p-1" href="<?= $subpage->url() ?>" role="button">
                    <h3 class="font-weight-light text-info ">
                        <?= $subpage->title() ?>
                    </h3>
                    <p class="card-text font-weight-light text-black">
                        <?= $subpage->Text()->blocks()->excerpt(150) ?>
                    </p>
                </a>

            <?php endforeach ?>

        </div>
    </div>

<?php endif ?>