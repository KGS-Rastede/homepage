<?php
/**
 * Event-Widget für die Startseite (Jubiläum, Projektwoche, ...).
 * Die Inhalte (Badge, Überschrift, Text, Links, Fotos) werden im Panel
 * auf der Seite „eventwidget“ gepflegt und sind dort an- und abschaltbar.
 * Design nach Tailkit m-s-hero-23 (Multiple Images Alt), Foto-Collage mit
 * versetzten Spalten.
 */

$widget = page('eventwidget');

if (!$widget || $widget->active()->toBool() === false) {
  return;
}

$fotos = $widget->fotos()->toFiles();
?>

<section class="mx-4 xl:mx-20 2xl:mx-40 mt-6" aria-label="<?= $widget->heading()->html() ?>">
  <div class="relative overflow-hidden rounded-lg bg-white shadow-xs dark:bg-slate-800 dark:text-slate-100">
    <div class="relative container mx-auto grid grid-cols-1 gap-10 px-6 py-10 lg:grid-cols-2 lg:items-center lg:gap-16 lg:px-12 lg:py-14">

      <!-- Text und Links -->
      <div class="mx-auto max-w-4xl text-center lg:text-left">

        <?php if ($widget->badge()->isNotEmpty()): ?>
          <div class="mb-5 flex items-center justify-center lg:justify-start">
            <div class="inline-flex items-center rounded-full bg-kgs-blue/10 px-4 py-1.5 text-sm font-medium text-kgs-blue dark:bg-kgs-lblue/15 dark:text-kgs-lblue">
              <?= $widget->badge()->html() ?>
            </div>
          </div>
        <?php endif; ?>

        <h2 class="mb-4 text-3xl font-black text-slate-900 lg:text-4xl dark:text-white">
          <?= $widget->heading()->html() ?>
        </h2>

        <div class="space-y-4 leading-relaxed text-slate-700 dark:text-slate-400">
          <?= $widget->text()->toBlocks() ?>
        </div>

        <?php if ($widget->buttons()->toStructure()->isNotEmpty()): ?>
          <div class="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
            <?php $erster = true; ?>
            <?php foreach ($widget->buttons()->toStructure() as $button): ?>
              <?php if ($erster): $erster = false; ?>
                <a href="<?= $button->link()->toUrl() ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-kgs-blue bg-kgs-blue px-4 py-2 text-sm leading-5 font-semibold text-white hover:border-kgs-blue/90 hover:bg-kgs-blue/90 hover:text-white focus:ring-3 focus:ring-kgs-blue/25 active:border-kgs-blue active:bg-kgs-blue dark:focus:ring-kgs-lblue/40">
                  <?= $button->text()->html() ?>
                </a>
              <?php else: ?>
                <a href="<?= $button->link()->toUrl() ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm leading-5 font-semibold text-slate-900 hover:border-slate-300 hover:text-slate-900 hover:shadow-xs focus:ring-3 focus:ring-slate-300/25 active:border-slate-200 active:shadow-none dark:border-slate-700 dark:bg-transparent dark:text-slate-300 dark:hover:border-slate-600 dark:hover:text-slate-200 dark:focus:ring-slate-600/40 dark:active:border-slate-700">
                  <?= $button->text()->html() ?>
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- END Text und Links -->

      <?php if ($fotos->isNotEmpty()): ?>
        <!-- Foto-Collage -->
        <div class="mx-auto flex w-full max-w-md items-center">

          <?php if ($fotos->count() === 1): ?>
            <?php $foto = $fotos->first(); ?>
            <div class="relative w-full">
              <div class="absolute -inset-3 rounded-3xl bg-linear-to-b from-kgs-blue via-slate-500 to-kgs-red opacity-15 blur-2xl"></div>
              <div class="relative rounded-2xl bg-white/50 p-0.5 ring-1 ring-slate-200/75 backdrop-blur-xs sm:p-2 dark:bg-slate-500/20 dark:ring-slate-700/60">
                <img src="<?= $foto->crop(800, 600)->url() ?>"
                  class="aspect-4/3 w-full rounded-xl border border-slate-200/60 object-cover dark:border-slate-400/25"
                  alt="<?= $foto->alt()->or($widget->heading())->html() ?>">
              </div>
            </div>
          <?php else: ?>
            <div class="grid grid-cols-2 gap-4 pb-5 sm:pb-10">
              <?php $position = 0; ?>
              <?php foreach ($fotos as $foto): ?>
                <div class="relative <?= $position % 2 === 1 ? 'top-5 sm:top-10' : '' ?>">
                  <div class="absolute -inset-3 rounded-3xl bg-linear-to-b from-kgs-blue via-slate-500 to-kgs-red opacity-15 blur-2xl"></div>
                  <div class="relative rounded-2xl bg-white/50 p-0.5 ring-1 ring-slate-200/75 backdrop-blur-xs sm:p-2 dark:bg-slate-500/20 dark:ring-slate-700/60">
                    <img src="<?= $foto->crop(480, 640)->url() ?>"
                      class="aspect-3/4 w-full rounded-xl border border-slate-200/60 object-cover dark:border-slate-400/25"
                      alt="<?= $foto->alt()->or($widget->heading())->html() ?>">
                  </div>
                </div>
                <?php $position++; ?>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
        <!-- END Foto-Collage -->
      <?php endif; ?>

    </div>
  </div>
</section>
