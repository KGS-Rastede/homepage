<?php
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
if (get('ansicht') === 'monitor') {
    snippet('sprechtag-monitor', compact('lehrkraefte', 'fehler', 'page'));
    return;
}
?>
<!doctype html>
<html lang="de" class="scheme-light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elternsprechtag · KGS Rastede</title>
  <?php snippet('sprechtag-styles') ?>
</head>
<body class="bg-gray-100 font-sans text-gray-900 antialiased">
<header class="border-b-6 border-kgs-lblue bg-kgs-blue px-5 py-8 text-white sm:px-10 sm:py-14 print:bg-white print:px-0 print:py-4 print:text-gray-900">
  <p class="mb-3 text-sm font-bold tracking-widest text-white/85 uppercase print:text-gray-700">KGS Rastede</p>
  <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">Elternsprechtag</h1>
  <p class="mt-3 text-lg text-white/90 print:text-gray-700">Herzlich willkommen! Hier finden Sie die Räume unserer Lehrkräfte.</p>
</header>
<main class="mx-auto max-w-[1640px] px-5 pt-6 pb-12 print:px-0">
<?php if ($fehler !== null): ?>
  <p class="rounded-xl bg-white p-6" role="status"><?= esc($fehler) ?></p>
<?php else: ?>
  <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
    <p class="text-gray-600" id="count" aria-live="polite"><?= count($lehrkraefte) ?> Lehrkräfte · alphabetisch nach Nachnamen</p>
    <div class="w-full max-w-lg print:hidden" hidden id="search-container">
      <label for="search" class="mb-2 block text-sm font-semibold">Lehrkraft oder Raum finden</label>
      <input class="w-full rounded-lg border border-gray-400 bg-white px-4 py-3 focus-visible:outline-3 focus-visible:outline-offset-2 focus-visible:outline-kgs-blue" id="search" type="search" placeholder="Name, Kürzel oder Raum …" autocomplete="off" aria-controls="rooms">
    </div>
  </div>
  <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,290px),1fr))] gap-3 print:grid-cols-3" id="rooms">
  <?php foreach ($lehrkraefte as $person): ?>
    <article class="flex items-center justify-between gap-3 rounded-xl border border-gray-200 bg-white px-4 py-4 shadow-sm print:break-inside-avoid print:p-2">
      <div class="min-w-0">
        <span class="text-sm text-gray-600"><?= esc($person['anrede']) ?></span>
        <h2 class="my-1 text-lg font-semibold wrap-anywhere"><?= esc($person['nachname']) ?></h2>
        <span class="text-xs text-gray-600">Kürzel: <?= esc($person['kürzel']) ?></span>
      </div>
      <div class="min-w-20 shrink-0 rounded-lg bg-kgs-blue/10 px-3 py-2 text-center text-kgs-blue"><span class="block text-xs tracking-wider uppercase">Raum</span><strong class="block text-xl font-bold"><?= esc($person['raum'] ?: '–') ?></strong></div>
    </article>
  <?php endforeach ?>
  </div>
  <p class="rounded-xl bg-white p-6" id="empty" <?= $lehrkraefte ? 'hidden' : '' ?>>Keine passenden Lehrkräfte gefunden.</p>
<?php endif ?>
  <footer class="mt-8 text-sm text-gray-600 print:hidden">Elternsprechtag · KGS Rastede</footer>
</main>
<script>
  const search = document.getElementById('search');
  if (search) {
    document.getElementById('search-container').hidden = false;
    const normalize = value => value.toLocaleLowerCase('de').normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/ß/g, 'ss');
    const cards = Array.from(document.querySelectorAll('#rooms article'), element => ({ element, text: normalize(element.textContent) }));
    search.addEventListener('input', () => {
      const terms = normalize(search.value).trim().split(/\s+/);
      let visible = 0;
      for (const card of cards) {
        card.element.hidden = !terms.every(term => card.text.includes(term));
        if (!card.element.hidden) visible++;
      }
      document.getElementById('count').textContent = visible + ' von ' + cards.length + ' Lehrkräften';
      document.getElementById('empty').hidden = visible !== 0;
    });
  }
</script>
</body>
</html>
