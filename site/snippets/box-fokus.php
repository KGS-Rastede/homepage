<?php if (
  collection('blogs-topartikel')->isNotEmpty()
)://wenn aktuelle Topartikel vorhanden sind
   ?>

    <h2 class="font-semibold p-2 mt-4 text-4xl dark:text-slate-100">Aktuell im Fokus</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4">
        <?php foreach (collection('blogs-topartikel') as $subpage): ?>
            <a href="<?= $subpage->url() ?>"
               class="group flex flex-col rounded-lg bg-slate-50 shadow-sm hover:shadow-md overflow-hidden dark:bg-slate-800 dark:text-slate-100 transition-shadow duration-200">
                <div class="p-4 flex flex-col grow">
                    <h3 class="text-xl font-semibold text-blue-600 group-hover:text-blue-500 mb-2">
                        <?= $subpage->title() ?>
                    </h3>
                    <p class="text-base text-slate-600 dark:text-slate-300 grow">
                        <?= $subpage->Text()->toBlocks()->excerpt(150) ?>
                    </p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>


<?php endif; ?>
