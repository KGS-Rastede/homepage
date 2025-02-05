<?php
/*
In diesem Snippet wird zum einen der normale Inhalt einer Seite (blog Inhalt) generiert als auch bis zu drei Blöcke mit zusätzlichen Informationen.
Da je nach Seite 1, 2 oder 3 Blöcke angezeigt werden können, ist eine schöne Gestaltung leicht aufwendiger. Ürpsrünglich waren die Blöcke
rechts neben dem normalen Inhalt, daher der Name "sidebar". Mittlerweile befinden diese sich unter dem normalen Inhalt.
*/

// Hier werden drei Variablen festgelegt, für die einzelnen Sidebarblöcke
$sidebar = $page->sidebar(); // "Weiterführende Links" externe Links
$related = $page->related(); // "Weitere Informationen" Unterseiten / Interne Seiten
$downloads = $page->downloads(); // "Zugehörige Downloads" Dateien

$anzahlVorhandenerBloecke = count(
  // zähle die Anzahl
  // Filtere ein Array der drei Variablen;        Filterfunktion, die prüft, ob der Wert nicht leer ist
  array_filter(
    [$sidebar, $related, $downloads],
    fn($var) => $var->isNotEmpty(),
  ),
);

// === Hier den normalen Inhalt der Seite anzeigen ===
?>
<div class="container">
    <?= $page->text()->toBlocks() ?>


    <?php // === Ab hier kommen die Sidebar Blöcke ===

if ($anzahlVorhandenerBloecke >= 1): ?>
        <hr class="mt-4 mb-4">
        <div class="grid gap-x-5 gap-y-3 lg:grid-flow-col auto-cols-fr items-start text-center mx-auto mb-5
        <?= $anzahlVorhandenerBloecke == 1
          ? 'lg:max-w-2xl xl:max-w-3xl'
          : '' ?>">


            <?php
      /* -- Die tatsächlichen Blöcke -- */
      ?>
            <?php if ($sidebar->isNotEmpty()): ?>
               <?php
              // "Weiterführende Links" ist vorhanden
              ?>
                <div class="flex flex-col text-slate-800 bg-slate-50 shadow-md rounded-lg">
                    <h5 class="block mb-2 mr-2 ml-2 mt-3 antialiased leading-7 font-semibold">
                        <?= $page->sidetitel()->or('Weitere Informationen') ?>
                        <i class="bi bi-box-arrow-up-right ml-2"></i>
                    </h5>
                    <div class="flex flex-col gap-2 p-3 leading-relaxed text-gray-600">
                        <?php foreach (
                          $sidebar->toStructure()
                          as $sidebarItem
                        ): ?>
                            <a href="<?= $sidebarItem->link() ?>" target="_blank" rel="noopener">
                                <div role="button" class="flex justify-center p-1 transition-all rounded-lg hover:bg-gray-300 hover:bg-opacity-80 hover:text-gray-700">
                                    <?= $sidebarItem
                                      ->name()
                                      ->or($sidebarItem->link()) ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (
              $related->isNotEmpty()
            ):// "Weitere Informationen" ist vorhanden
               ?>
                <div class="flex flex-col text-slate-800 bg-slate-50 shadow-md rounded-lg">
                    <h5 class="block mb-2 mr-2 ml-2 mt-3 antialiased leading-7 font-semibold">
                        <?= $page
                          ->relatedtitel()
                          ->or('Weitere Informationen') ?>
                        <i class="bi bi-arrow-right ml-2"></i>
                    </h5>
                    <div class="flex flex-col gap-2 p-3 leading-relaxed text-gray-600">
                        <?php foreach ($related->toPages() as $relatedPage): ?>
                            <a href="<?= $relatedPage->url() ?>">
                                <div role="button" class="flex justify-center p-1 transition-all rounded-lg hover:bg-gray-300 hover:bg-opacity-80 hover:text-gray-700">
                                    <?= $relatedPage->title() ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (
              $downloads->isNotEmpty()
            ):// "Zugehörige Downloads" ist vorhanden
               ?>
                <div class="flex flex-col text-slate-800 bg-slate-50 shadow-md rounded-lg">
                    <h5 class="block mb-2 mr-2 ml-2 mt-3 antialiased leading-7 font-semibold">
                        <?= $page
                          ->downloadtitel()
                          ->or('Zugehörige Downloads') ?>
                        <i class="bi bi-download ml-2"></i>
                    </h5>
                    <div class="flex flex-col gap-2 p-3 leading-relaxed text-gray-600">
                        <?php foreach ($downloads->toFiles() as $file): ?>

                            <a a href="<?= $file->url() ?>" class="flex flex-row items-center p-1 transition-all rounded-lg hover:bg-gray-300 hover:bg-opacity-80 hover:text-gray-700">
                                <span class="flex rounded p-2 mr-2 text-white leading-none text-base font-semibold uppercase bg-kgsblue-dark">
                                    <?= $file->extension() ?>
                                </span>
                                <p class="flex flex-grow justify-center">
                                    <?= $file
                                      ->anzeigename()
                                      ->or($file->name()) ?>
                                </p>
                            </a>

                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>


        </div>
</div>
<?php endif; ?>
