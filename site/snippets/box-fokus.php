<?php if (collection('blogs-topartikel')->isNotEmpty()) : //wenn aktuelle Topartikel vorhanden sind
?>

    <h2 class="font-semibold p-2 mt-4 text-2xl">Aktuell im Fokus</h2>

    <div class="flex flex-col my-4 bg-slate-50 overflow-hidden dark:text-gray-100 dark:bg-gray-800">

        <?php foreach (collection('blogs-topartikel') as $subpage) : ?>

            <?php if (!$subpage->isFirst(collection('blogs-topartikel'))) : ?>
                <h3 class="flex items-center py-2 my-4">
                    <span aria-hidden="true" class="grow bg-gray-200 rounded h-0.5 dark:bg-gray-700/75"></span>
                </h3>
            <?php endif //Trennstrich kommt nur, wenn es keine Artikel vor diesem Element gibt 
            ?>

            <div class="hover:bg-slate-100">

                <a href="<?= $subpage->url() ?>" role="button">

                    <!-- Card Header -->
                    <div class="py-2 px-3 text-semibold text-3xl text-blue-700">
                        <?= $subpage->title() ?>
                    </div>
                    <!-- END Card Header -->

                    <!-- Card Body -->
                    <div class="p-2 text-xl grow">
                        <?= $subpage->Text()->toBlocks()->excerpt(150) ?>
                    </div>
                    <!-- END Card Body -->

                    <!-- END Card Footer -->

                </a>
            </div>
        <?php endforeach ?>
    </div>


<?php endif ?>