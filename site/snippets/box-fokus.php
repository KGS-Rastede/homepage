<div class="card mb-3 mt-5">
    <!-- Jetzt folgen die als 'Topartikel' getaggte Blogs -->
    <h2 class="ml-3 mt-2">Aktuell im Fokus</h2>
    <div class="card-body">
        <?php $count = 0;
            foreach (page('blogs')
            ->children()
            ->flip() as $subpage) : ?>
            <?php

            // Ist es ein Topartikel?
            if (
                // handelt es sich um einen Artikel,
                // auf der Startseite hervorzuheben ist?
                in_array("Topartikel", $subpage->tags()->split())

                // ist der Artikel noch aktuell?
                and ($subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s'))

            ) : ?>

                <?php if ($count == 1) : ?>
                    <hr class="mt-3 mb-3">
                <?php else :  $count = 1; endif ?>
                
                <a class="btn btn-danger btn-lg btn-block text-left" href="<?= $subpage->url() ?>" role="button">
                    <h3 class="font-weight-light">
                        <?= $subpage->title() ?>
                    </h3>
                    <p class="card-text font-weight-light">
                        <?= $subpage->Text()->blocks()->excerpt(150) ?>
                    </p>
                </a>

            <?php endif ?>

        <?php endforeach ?>
    </div>
</div>