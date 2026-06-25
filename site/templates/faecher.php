<?php

use Kirby\Toolkit\Escape;

snippet('default-page-layout', slots: true);
slot();

$fachbereiche = $page->children();
?>

<div>
  <section class="mb-8">
    <nav aria-label="Fachbereiche" class="flex flex-wrap gap-2">
      <?php foreach ($fachbereiche as $fachbereich): ?>
        <a
          href="#<?= Escape::attr($fachbereich->slug()) ?>"
          class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-800 transition hover:border-slate-600 hover:text-kgs-blue focus:outline-none focus:ring-4 focus:ring-slate-300/25 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100"
        >
          <?= Escape::html($fachbereich->title()) ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </section>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <?php foreach ($fachbereiche as $fachbereich): ?>
      <?php
      $faecher = $fachbereich->pages()->toPages();
      $bild = $fachbereich->symbolbild()->toFile() ?? $fachbereich->image();
      ?>

      <article
        id="<?= Escape::attr($fachbereich->slug()) ?>"
        class="group min-w-0 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:shadow-md dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
      >
        <a href="<?= $fachbereich->url() ?>" class="block focus:outline-none focus:ring-4 focus:ring-slate-300/25">
          <div class="relative overflow-hidden bg-slate-200 dark:bg-slate-700" style="height: 11rem;">
            <?php if ($bild): ?>
              <?= $bild->crop(900, 420, 'center')->html([
                'class' =>
                  'h-full w-full object-cover transition duration-300 group-hover:scale-105',
                'loading' => 'lazy',
                'alt' => $bild->alt()->or($fachbereich->title()),
              ]) ?>
              <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/30 to-transparent"></div>
            <?php else: ?>
              <div class="flex h-full items-center justify-center bg-slate-100 text-6xl font-semibold text-slate-300 dark:bg-slate-700 dark:text-slate-500">
                <?= Escape::html(mb_substr($fachbereich->title(), 0, 1)) ?>
              </div>
              <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/30 to-transparent"></div>
            <?php endif; ?>

            <div class="absolute right-0 bottom-0 left-0 p-4 text-white">
              <p class="mb-1 text-sm font-medium text-white">
                <?= $faecher->count() === 1
                  ? '1 Fach'
                  : $faecher->count() . ' Fächer' ?>
              </p>
              <h3 class="text-2xl font-semibold">
                <?= Escape::html($fachbereich->title()) ?>
              </h3>
            </div>
          </div>
        </a>

        <div class="p-4">
          <div class="mb-4 flex flex-col gap-3 text-sm">
            <div>
              <?php if ($fachbereich->bezeichnung()->isNotEmpty()): ?>
                <p class="font-medium text-slate-500 dark:text-slate-400">
                  <?= Escape::html($fachbereich->bezeichnung()) ?>
                </p>
              <?php endif; ?>

              <?php if ($fachbereich->namefbl()->isNotEmpty()): ?>
                <p class="mt-1 text-base font-semibold text-slate-900 dark:text-white">
                  <?= Escape::html($fachbereich->namefbl()) ?>
                </p>
              <?php endif; ?>
            </div>

            <?php if ($fachbereich->email()->isNotEmpty()): ?>
              <a
                href="mailto:<?= Escape::attr($fachbereich->email()) ?>"
                class="inline-flex max-w-full items-center gap-2 text-sm font-semibold text-kgs-blue hover:underline dark:text-slate-100"
                style="overflow-wrap: anywhere;"
              >
                <i class="bi bi-envelope"></i>
                <?= Escape::html($fachbereich->email()) ?>
              </a>
            <?php endif; ?>
          </div>

          <div class="border-t border-slate-200 pt-4 dark:border-slate-700">
            <p class="mb-3 text-sm font-semibold text-slate-900 dark:text-white">
              Zugeordnete Fächer
            </p>

            <?php if ($faecher->count() > 0): ?>
              <div class="flex flex-wrap gap-2">
                <?php foreach ($faecher as $fach): ?>
                  <a
                    href="<?= $fach->url() ?>"
                    class="inline-flex items-center gap-1 rounded-md border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm font-medium text-slate-800 transition hover:border-slate-600 hover:bg-slate-100 hover:text-kgs-blue focus:outline-none focus:ring-4 focus:ring-slate-300/25 dark:border-slate-600 dark:bg-slate-900/80 dark:text-slate-100 dark:hover:bg-slate-900/50"
                  >
                    <?= Escape::html($fach->title()) ?>
                    <i class="bi bi-arrow-right-short text-base"></i>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <p class="text-sm text-slate-500 dark:text-slate-400">
                Noch keine Fächer hinterlegt.
              </p>
            <?php endif; ?>
          </div>

          <a
            href="<?= $fachbereich->url() ?>"
            class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-kgs-blue hover:underline dark:text-slate-100"
          >
            Fachbereich öffnen
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
