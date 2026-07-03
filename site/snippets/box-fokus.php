<?php
// wenn aktuelle Topartikel vorhanden sind
if (collection('blogs-topartikel')->isNotEmpty()): ?>

    <h2 class="font-semibold p-2 mt-4 text-4xl dark:text-slate-100">Aktuell im Fokus</h2>

    <?php $artikelCount = collection('blogs-topartikel')->count(); ?>
    <div class="grid gap-4 my-4 <?= $artikelCount === 1
      ? 'grid-cols-1'
      : 'grid-cols-1 md:grid-cols-2' ?>">
        <?php foreach (collection('blogs-topartikel') as $subpage): ?>
            <a href="<?= $subpage->url() ?>"
               class="group flex flex-col overflow-hidden rounded-lg bg-white shadow-xs hover:shadow-md dark:bg-slate-800 dark:text-slate-100 transition-shadow duration-200">
                <div class="p-6 flex flex-col grow">
                    <h3 class="text-lg sm:text-xl font-bold text-kgs-blue group-hover:text-kgs-blue/75 dark:text-kgs-lblue dark:group-hover:text-kgs-lblue/75 mb-2">
                        <?= $subpage->title() ?>
                    </h3>
                    <p class="leading-relaxed text-slate-600 dark:text-slate-400 grow">
                        <?= $subpage->Text()->toBlocks()->excerpt(150) ?>
                    </p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>


<?php endif; ?>
