<?php
$countdowns = $page->countdowns()->toStructure()->filter(fn($c) => $c->aktiv()->toBool());
$now = new DateTime('today');
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Countdown | <?= $site->title() ?></title>
  <meta name="robots" content="noindex, nofollow">
  <?php if (option('debug', false) === true): ?>
    <?= css('assets/css/twkgs_shrinked.css') ?>
  <?php else: ?>
    <?= css('assets/css/twkgs_shrinked.min.css') ?>
  <?php endif; ?>
</head>
<body class="antialiased bg-slate-100 dark:bg-slate-900 min-h-screen flex items-center justify-center p-8">

  <div class="w-full max-w-2xl space-y-8">

    <?php if ($countdowns->count() === 0): ?>
      <p class="text-center text-slate-500 dark:text-slate-400">Keine aktiven Countdowns konfiguriert.</p>
    <?php endif; ?>

    <?php foreach ($countdowns as $countdown):
      $zieldatum = new DateTime($countdown->datum()->value());
      $diff = $now->diff($zieldatum);
      $tage = (int) $diff->format('%r%a');
    ?>
      <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-10 text-center">
        <p class="text-lg font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-4">
          <?= html($countdown->titel()) ?>
        </p>

        <?php if ($tage > 0): ?>
          <p class="text-8xl font-black text-slate-800 dark:text-white leading-none">
            <?= $tage ?>
          </p>
          <p class="mt-4 text-xl text-slate-500 dark:text-slate-400">
            <?= $tage === 1 ? 'Tag noch' : 'Tage noch' ?>
          </p>
          <p class="mt-2 text-sm text-slate-400 dark:text-slate-500">
            (<?= $zieldatum->format('d.m.Y') ?>)
          </p>

        <?php elseif ($tage === 0): ?>
          <p class="text-5xl font-black text-green-600 dark:text-green-400">Heute!</p>

        <?php else: ?>
          <p class="text-3xl font-bold text-slate-400 dark:text-slate-500">
            vor <?= abs($tage) ?> <?= abs($tage) === 1 ? 'Tag' : 'Tagen' ?>
          </p>
          <p class="mt-2 text-sm text-slate-400 dark:text-slate-500">
            (<?= $zieldatum->format('d.m.Y') ?>)
          </p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <p class="text-center text-xs text-slate-400 dark:text-slate-500">
      Diese Seite ist nicht verlinkt – nur für interne Nutzung und Info-Monitore.
    </p>
  </div>

</body>
</html>
