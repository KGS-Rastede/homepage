<?php

use Kirby\Toolkit\Escape;
use Kirby\Toolkit\Str;

/**
 * Übersicht aller AGs. Die AGs kommen als virtuelle Seiten aus der AG-Schnittstelle
 * (siehe site/models/ags.php). Angezeigt werden nur Felder, die die Schnittstelle liefert.
 *
 * Filter nach Jahrgang und Suche laufen mit AlpineJS. Ohne JavaScript bleiben
 * Filterleiste ausgeblendet und alle AGs sichtbar.
 */

$arbeitsgemeinschaften = $page->children();

// Alle Jahrgänge, die im aktuellen Angebot vorkommen, für die Filterknöpfe
$alleJahrgaenge = [];
foreach ($arbeitsgemeinschaften as $arbeitsgemeinschaft) {
  foreach ($arbeitsgemeinschaft->gradeList() as $jahrgang) {
    $alleJahrgaenge[$jahrgang] = $jahrgang;
  }
}
sort($alleJahrgaenge, SORT_NATURAL);

snippet('default-page-layout', slots: true);
slot();
?>

<?php if ($page->text()->isNotEmpty()): ?>
  <div class="mt-4 mb-6">
    <?= $page->text()->toBlocks() ?>
  </div>
<?php endif; ?>

<section id="angebot" class="mt-4" x-data="{
  jahrgang: '',
  suche: '',
  passt(el) {
    const jahrgaenge = el.dataset.jahrgaenge.split(',');
    const suche = this.suche.trim().toLowerCase();
    return (this.jahrgang === '' || jahrgaenge.includes(this.jahrgang))
      && (suche === '' || el.dataset.suche.includes(suche));
  },
  anzahl() {
    return [...this.$root.querySelectorAll('[data-jahrgaenge]')].filter(el => this.passt(el)).length;
  },
}">

  <?php if ($page->termYear() !== ''): ?>
    <h2 class="mb-4 text-2xl font-semibold">
      AG-Angebot im Schuljahr <?= Escape::html($page->termYear()) ?>
    </h2>
  <?php endif; ?>

  <?php if ($arbeitsgemeinschaften->isEmpty()): ?>
    <p class="rounded-lg bg-slate-50 p-6 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
      Das AG-Angebot wird gerade aktualisiert. Bitte schaut später noch einmal vorbei.
    </p>
  <?php else: ?>

    <!-- Filter: nur mit JavaScript sichtbar. Felder im Stil der Suchseite (templates/search.php) -->
    <div x-cloak class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
      <div class="relative flex-1">
        <svg class="pointer-events-none absolute start-3 top-1/2 size-4 -translate-y-1/2 text-slate-500 dark:text-slate-400"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd"
            d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
            clip-rule="evenodd" />
        </svg>
        <input type="search" x-model="suche" placeholder="AG suchen, z. B. Theater, Robo, Bienen" aria-label="AG suchen"
          class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-3 ps-9 text-sm text-slate-900 focus:border-kgs-blue focus:ring-kgs-blue dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 dark:focus:border-kgs-lblue dark:focus:ring-kgs-lblue">
      </div>
      <select x-model="jahrgang" aria-label="Nach Jahrgang filtern"
        class="block rounded-lg border border-slate-300 bg-slate-50 p-3 text-sm text-slate-900 focus:border-kgs-blue focus:ring-kgs-blue sm:w-52 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:focus:border-kgs-lblue dark:focus:ring-kgs-lblue">
        <option value="">Alle Jahrgänge</option>
        <?php foreach ($alleJahrgaenge as $jahrgang): ?>
          <option value="<?= Escape::attr(
            $jahrgang,
          ) ?>">Jahrgang <?= Escape::html($jahrgang) ?></option>
        <?php endforeach; ?>
      </select>
      <p class="text-sm whitespace-nowrap text-slate-600 tabular-nums dark:text-slate-400" aria-live="polite">
        <span x-text="anzahl()"><?= $arbeitsgemeinschaften->count() ?></span>
        von <?= $arbeitsgemeinschaften->count() ?> AGs
      </p>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($arbeitsgemeinschaften as $arbeitsgemeinschaft):
        $suchtext = Str::lower(
          $arbeitsgemeinschaft->title() .
            ' ' .
            strip_tags(
              markdown($arbeitsgemeinschaft->content()->description()),
            ) .
            ' ' .
            implode(' ', $arbeitsgemeinschaft->teacherList()),
        ); ?>
        <!-- Karte wie snippets/blogkarte-bild.php, ergänzt um die Angaben aus der AG-Schnittstelle -->
        <div x-show="passt($el)"
          data-jahrgaenge="<?= Escape::attr(
            implode(',', $arbeitsgemeinschaft->gradeList()),
          ) ?>"
          data-suche="<?= Escape::attr($suchtext) ?>"
          class="flex h-full flex-col overflow-hidden rounded-lg bg-white shadow-xs dark:bg-slate-800 dark:text-slate-100">

          <?php if ($image = $arbeitsgemeinschaft->image()): ?>
            <a href="<?= $arbeitsgemeinschaft->url() ?>" class="group relative block" tabindex="-1" aria-hidden="true">
              <div class="absolute inset-0 flex items-center justify-center bg-kgs-blue/75 opacity-0 transition duration-150 ease-out group-hover:opacity-100">
                <svg class="inline-block size-10 -rotate-45 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                  fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <?= $image->crop(650, 488, 'center')->html([
                'class' => 'aspect-4/3 w-full object-cover',
                'alt' => '',
                'loading' => 'lazy',
              ]) ?>
            </a>
          <?php endif; ?>

          <div class="flex grow flex-col p-6">
            <h3 class="mb-3 text-lg font-bold sm:text-xl">
              <a href="<?= $arbeitsgemeinschaft->url() ?>"
                class="leading-7 text-kgs-blue hover:text-kgs-blue/75 dark:text-kgs-lblue dark:hover:text-kgs-lblue/75">
                <?= Escape::html($arbeitsgemeinschaft->title()) ?>
              </a>
            </h3>

            <dl class="grid grow grid-cols-[auto_minmax(0,1fr)] content-start gap-x-3 gap-y-1 text-sm text-gray-700 dark:text-gray-300">
              <?php if ($arbeitsgemeinschaft->gradeList()): ?>
                <dt class="font-semibold">Jahrgänge</dt>
                <dd><?= Escape::html(
                  $arbeitsgemeinschaft->gradesLabel(),
                ) ?></dd>
              <?php endif; ?>

              <?php if (
                $arbeitsgemeinschaft->content()->date()->isNotEmpty()
              ): ?>
                <dt class="font-semibold">Termin</dt>
                <dd class="line-clamp-2"><?= $arbeitsgemeinschaft
                  ->content()
                  ->date() ?></dd>
              <?php endif; ?>

              <?php if (
                $arbeitsgemeinschaft->content()->room()->isNotEmpty()
              ): ?>
                <dt class="font-semibold">Raum</dt>
                <dd class="line-clamp-1"><?= Escape::html(
                  $arbeitsgemeinschaft->content()->room(),
                ) ?></dd>
              <?php endif; ?>

              <?php if ($arbeitsgemeinschaft->teacherList()): ?>
                <dt class="font-semibold">Leitung</dt>
                <dd class="line-clamp-1"><?= Escape::html(
                  implode(', ', $arbeitsgemeinschaft->teacherList()),
                ) ?></dd>
              <?php endif; ?>
            </dl>

            <div class="text-right">
              <?php snippet('knopf-klein', [
                'subpage' => $arbeitsgemeinschaft,
                'knopftext' => 'mehr erfahren',
              ]); ?>
            </div>
          </div>
        </div>
      <?php
      endforeach; ?>
    </div>

    <p x-cloak x-show="anzahl() === 0"
      class="rounded-lg bg-slate-50 p-6 text-center text-slate-600 dark:bg-slate-800 dark:text-slate-400">
      Keine AG passt zu dieser Auswahl. Wählt einen anderen Jahrgang oder ändert die Suche.
    </p>

  <?php endif; ?>
</section>

<?php
// Infos zur AG-Wahl aus dem Panel. Steht vorne eine Überschrift, wird sie wie die
// anderen Abschnittsüberschriften dieser Seite gesetzt.
$mehrText = $page->more_text()->toBlocks();
$mehrTextTitel = null;
if ($mehrText->first()?->type() === 'heading') {
  $mehrTextTitel = $mehrText->first()->text();
  $mehrText = $mehrText->not($mehrText->first()->id());
}
?>
<?php if ($mehrText->isNotEmpty()): ?>
  <section id="ag-wahl" class="mt-12">
    <?php if ($mehrTextTitel): ?>
      <h2 class="mb-4 text-2xl font-semibold"><?= $mehrTextTitel ?></h2>
    <?php endif; ?>
    <?= $mehrText ?>
  </section>
<?php endif; ?>

<?php snippet('sidebar'); ?>

<?php // Nur die neuesten Berichte; alle weiteren über die Tag-Ansicht im Blog

$berichte = page('blogs')
  ->children()
  ->listed()
  ->filterBy('tags', 'AGs', ',')
  ->flip(); ?>
<?php if ($berichte->isNotEmpty()): ?>
  <section id="berichte" class="mt-12">
    <h2 class="mb-4 text-2xl font-semibold">Berichte aus den Arbeitsgemeinschaften</h2>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($berichte->limit(3) as $bericht) {
        snippet('blogkarte-bild', ['subpage' => $bericht]);
      } ?>
    </div>
    <?php if ($berichte->count() > 3): ?>
      <?php snippet('knopf-klein', [
        'url' => url('blogs') . '?tag=' . urlencode('AGs'),
        'knopftext' =>
          'Alle ' . $berichte->count() . ' Berichte aus den AGs &#8594;',
      ]); ?>
    <?php endif; ?>
  </section>
<?php endif; ?>

<?php endslot(); ?>
<?php endsnippet(); ?>
