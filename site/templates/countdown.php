<?php
$countdowns = $page->countdowns()->toStructure()->filter(fn($c) => $c->aktiv()->toBool());
$now = new DateTime('today');
$dayNames = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
$datumLang = $dayNames[(int)$now->format('w')] . ', ' . $now->format('j.n.y');

// Wetterdaten von Open-Meteo (kostenlos, kein API-Key nötig)
// Koordinaten für Rastede (26180)
$temperature = null;
$weatherEmoji = '🌡️';
$weatherDesc  = '';
try {
    $ctx  = stream_context_create(['http' => ['timeout' => 3]]);
    $json = @file_get_contents(
        'https://api.open-meteo.com/v1/forecast?latitude=53.25&longitude=8.20&current=temperature_2m,weather_code&timezone=Europe%2FBerlin',
        false,
        $ctx
    );
    if ($json) {
        $data = json_decode($json, true);
        if ($data && isset($data['current']['temperature_2m'], $data['current']['weather_code'])) {
            $temperature = (int) round($data['current']['temperature_2m']);
            $code        = (int) $data['current']['weather_code'];
            [$weatherEmoji, $weatherDesc] = match(true) {
                $code === 0                           => ['☀️',  'Klar'],
                $code === 1                           => ['🌤️', 'Überwiegend klar'],
                $code === 2                           => ['⛅',  'Teilweise bewölkt'],
                $code === 3                           => ['☁️',  'Bedeckt'],
                in_array($code, [45, 48])             => ['🌫️', 'Nebel'],
                in_array($code, [51, 53, 55, 56, 57]) => ['🌦️', 'Nieselregen'],
                in_array($code, [61, 63, 65, 66, 67]) => ['🌧️', 'Regen'],
                in_array($code, [71, 73, 75, 77])     => ['❄️',  'Schnee'],
                in_array($code, [80, 81, 82])         => ['🌧️', 'Regenschauer'],
                in_array($code, [85, 86])             => ['🌨️', 'Schneeschauer'],
                in_array($code, [95, 96, 99])         => ['⛈️',  'Gewitter'],
                default                               => ['🌡️', ''],
            };
        }
    }
} catch (Throwable $e) {
    // Wetter nicht verfügbar – stillschweigend ignorieren
}
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
  <style>
    @font-face {
      font-family: 'NotoColorEmoji';
      src: url('<?= url('assets/fonts/NotoColorEmoji.ttf') ?>') format('truetype');
      font-display: swap;
    }
    .weather-emoji { font-family: 'NotoColorEmoji', 'Segoe UI Emoji', 'Apple Color Emoji', sans-serif; }
  </style>
</head>
<body class="antialiased bg-slate-100 dark:bg-slate-900 min-h-screen flex flex-col items-center justify-center gap-6 p-8">

  <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg flex w-full max-w-4xl overflow-hidden">

    <!-- Countdowns (linke zwei Drittel) -->
    <div class="flex-[2] p-10 divide-y divide-slate-100 dark:divide-slate-700">

      <?php if ($countdowns->count() === 0): ?>
        <p class="text-center text-slate-500 dark:text-slate-400 py-8">Keine aktiven Countdowns konfiguriert.</p>
      <?php endif; ?>

      <?php foreach ($countdowns as $countdown):
        $zieldatum = new DateTime($countdown->datum()->value());
        $diff = $now->diff($zieldatum);
        $tage = (int) $diff->format('%r%a');
      ?>
        <div class="py-8 text-center first:pt-0 last:pb-0">
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

    </div>

    <!-- Wetter (rechtes Drittel) -->
    <div class="flex-[1] border-l border-slate-100 dark:border-slate-700 p-10 flex flex-col items-center justify-center">
      <?php if ($temperature !== null): ?>
        <div class="text-center select-none">
          <div class="weather-emoji text-8xl mb-6 leading-none"><?= $weatherEmoji ?></div>
          <div class="text-7xl font-black text-slate-800 dark:text-white leading-none">
            <?= $temperature ?>°C
          </div>
          <?php if ($weatherDesc !== ''): ?>
            <div class="mt-4 text-xl text-slate-500 dark:text-slate-400"><?= html($weatherDesc) ?></div>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <p class="text-slate-400 dark:text-slate-500 text-sm">Wetter nicht verfügbar</p>
      <?php endif; ?>
    </div>

  </div>

  <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg w-full max-w-4xl px-10 py-6 text-center text-lg text-slate-500 dark:text-slate-400">
    <?= $datumLang ?>
  </div>

</body>
</html>
