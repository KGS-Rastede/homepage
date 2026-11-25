<?php

use Kirby\Toolkit\Escape;

/**
 * Detailseite einer AG. Die Seite ist virtuell und kommt aus der AG-Schnittstelle
 * (siehe site/models/ags.php). Angezeigt werden nur Felder, die die Schnittstelle liefert;
 * leere Felder werden ausgelassen.
 */

$ag = $page->content();

snippet('default-page-layout', slots: true);
slot();
?>

<p class="mt-2 mb-6 text-sm">
  <a href="<?= $page->parent()->url() ?>"
    class="font-semibold text-kgs-blue hover:text-kgs-blue/75 dark:text-kgs-lblue dark:hover:text-kgs-lblue/75">
    ← Alle Arbeitsgemeinschaften
  </a>
</p>

<div class="grid grid-cols-1 gap-8 md:grid-cols-3">

  <!-- Steckbrief: auf dem Handy oben, ab md rechts neben der Beschreibung -->
  <aside class="flex flex-col gap-6 md:order-last">
    <?php if ($image = $page->image()): ?>
      <?= $image->crop(800, 600, 'center')->html([
        'class' => 'aspect-4/3 w-full rounded-lg object-cover shadow-xs',
        'alt' => '',
      ]) ?>
    <?php endif; ?>

    <div class="rounded-lg bg-slate-50 p-6 shadow-sm dark:bg-slate-800">
      <h2 class="mb-4 text-lg font-semibold">Auf einen Blick</h2>
      <dl class="grid grid-cols-[auto_minmax(0,1fr)] gap-x-4 gap-y-2 text-gray-700 dark:text-gray-300">
        <?php if ($page->gradeList()): ?>
          <dt class="font-semibold">Jahrgänge</dt>
          <dd><?= Escape::html($page->gradesLabel()) ?></dd>
        <?php endif; ?>

        <?php if ($ag->date()->isNotEmpty()): ?>
          <dt class="font-semibold">Termin</dt>
          <dd><?= $ag->date() ?></dd>
        <?php endif; ?>

        <?php if ($ag->room()->isNotEmpty()): ?>
          <dt class="font-semibold">Raum</dt>
          <dd><?= Escape::html($ag->room()) ?></dd>
        <?php endif; ?>

        <?php if ($page->teacherList()): ?>
          <dt class="font-semibold">Leitung</dt>
          <dd><?= Escape::html(implode(', ', $page->teacherList())) ?></dd>
        <?php endif; ?>

        <?php if (
          option('kgs.ags.plaetzeAnzeigen', false) &&
          $ag->maximum_number_of_students()->isNotEmpty()
        ): ?>
          <dt class="font-semibold">Plätze</dt>
          <dd>höchstens <?= Escape::html(
            $ag->maximum_number_of_students(),
          ) ?> Schüler*innen</dd>
        <?php endif; ?>
      </dl>
    </div>
  </aside>

  <div class="md:col-span-2">
    <?php if ($ag->description()->isNotEmpty()): ?>
      <article class="prose max-w-none lg:prose-lg prose-a:text-kgs-blue dark:prose-invert dark:prose-a:text-kgs-lblue">
        <?= markdown($ag->description()) ?>
      </article>
    <?php else: ?>
      <p class="text-gray-700 dark:text-gray-300">
        Zu dieser AG gibt es noch keine Beschreibung.
      </p>
    <?php endif; ?>

    <?php snippet('knopf-klein', [
      'subpage' => $page->parent(),
      'knopftext' => '&#8592; Zurück zu allen Arbeitsgemeinschaften',
    ]); ?>
  </div>
</div>

<?php endslot(); ?>
<?php endsnippet(); ?>
