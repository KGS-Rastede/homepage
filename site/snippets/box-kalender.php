<?php

/**
 * Box auf der Startseite: Termine der nächsten zwei Wochen aus dem
 * IServ-Kalender (site/plugins/kalender), ohne JavaScript gerendert.
 */

use Kgs\Kalender\Kalender;

$zone    = Kalender::zone();
$heute   = new DateTimeImmutable('today', $zone);
$bis     = $heute->modify('+14 days');
$termine = Kalender::termine($heute, $bis);
$tage    = $termine === null ? null : Kalender::nachWerktagen($termine, $heute, $bis);

$wochentage = ['', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'];
$datum      = fn (DateTimeInterface $d) => $wochentage[$d->format('N')] . ', ' . $d->format('j.n.');
$uhrzeit    = function (array $t, bool $mehrtaegig) {
  if ($t['ganztaegig']) {
    return 'ganztägig';
  }
  $von = $t['start']->format('G:i');
  if ($mehrtaegig) {
    return 'ab ' . $von;
  }
  return $t['ende'] > $t['start'] ? $von . '–' . $t['ende']->format('G:i') : $von;
};
?>
<div class="flex flex-col overflow-hidden mt-5 my-4 rounded-lg bg-white shadow-sm dark:bg-slate-800 dark:text-slate-100">
  <div class="bg-slate-50 px-5 py-4 dark:bg-slate-800/50">
    <h3 class="mb-1 font-semibold text-2xl">Termine</h3>
    <p class="text-sm text-slate-500 dark:text-slate-400">
      <?= $datum($heute) ?> bis <?= $datum($bis->modify('-1 day')) ?>
    </p>
  </div>

  <?php if ($tage === null): ?>
    <p class="px-5 py-4 text-slate-500">Der Kalender ist gerade nicht verfügbar.</p>
  <?php elseif ($tage === []): ?>
    <p class="px-5 py-4 text-slate-500">In den nächsten zwei Wochen sind keine Termine eingetragen.</p>
  <?php else: ?>
    <ul class="divide-y divide-slate-200 dark:divide-slate-700">
      <?php foreach ($tage as $tag => $termineDesTages):
        $tagDatum = new DateTimeImmutable($tag, $zone); ?>
        <li class="px-5 py-3">
          <h4 class="mb-1 text-sm font-semibold text-kgs-blue dark:text-kgs-lblue">
            <?= $tag === $heute->format('Y-m-d') ? 'Heute' : $datum($tagDatum) ?>
          </h4>
          <ul class="space-y-1">
            <?php foreach ($termineDesTages as $t):
              // Letzter Tag mehrtägiger Termine (Ende ist exklusiv)
              $letzterTag = $t['ganztaegig'] ? $t['ende']->modify('-1 day') : $t['ende'];
              $mehrtaegig = $letzterTag->format('Y-m-d') > $tag; ?>
              <li class="flex gap-3 text-sm">
                <span class="w-24 shrink-0 text-slate-500 dark:text-slate-400"><?= $uhrzeit($t, $mehrtaegig) ?></span>
                <span>
                  <?= esc($t['titel'] !== '' ? $t['titel'] : '(ohne Titel)') ?>
                  <?php if ($mehrtaegig): ?>
                    <span class="text-slate-500 dark:text-slate-400">(bis <?= $datum($letzterTag) ?>)</span>
                  <?php endif ?>
                </span>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>

  <a href="<?= url('allgemeines/kalender') ?>"
    class="border-t border-slate-200 px-5 py-3 text-sm font-semibold text-kgs-blue hover:bg-slate-50 dark:border-slate-700 dark:text-kgs-lblue dark:hover:bg-slate-700/50">
    Zum Kalender →
  </a>
</div>
