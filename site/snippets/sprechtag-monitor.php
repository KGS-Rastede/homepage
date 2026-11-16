<?php
// Dieselben aufbereiteten Daten wie in der aktiven Ansicht, spaltenweise gelesen.
$spalten = $lehrkraefte ? array_chunk($lehrkraefte, (int)ceil(count($lehrkraefte) / 3)) : [];
?>
<!doctype html>
<html lang="de" class="scheme-light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sprechtag · Raumplan · KGS Rastede</title>
  <?php snippet('sprechtag-styles') ?>
</head>
<body class="flex h-dvh flex-col overflow-hidden bg-gray-50 px-[1.5vw] py-[1.2vh] font-sans text-gray-900 antialiased">
  <header class="mb-[1.2vh] flex shrink-0 items-baseline gap-[.65em] whitespace-nowrap text-kgs-blue">
    <h1 class="text-[clamp(16px,2.35vw,48px)] font-medium">Schüler:innen- und Elternsprechtag</h1>
    <p class="text-[clamp(12px,1.5vw,30px)] text-gray-600">· Raumplan<?php if ($page->sprechtagDatum()->isNotEmpty()): ?> · <?= esc($page->sprechtagDatum()->toDate('d.m.Y')) ?><?php endif ?></p>
  </header>
  <main class="grid min-h-0 flex-1 grid-cols-3 grid-rows-[minmax(0,1fr)] gap-[1.25vw]">
  <?php if ($fehler !== null || !$lehrkraefte): ?>
    <p class="col-span-full text-[2vw]" role="status"><?= esc($fehler ?? 'Aktuell sind keine Raumdaten hinterlegt.') ?></p>
  <?php else: ?>
    <?php foreach ($spalten as $index => $spalte): ?>
      <div class="min-h-0 min-w-0 overflow-hidden border-t-4 border-kgs-blue">
        <table class="w-full table-fixed border-collapse text-[length:inherit]">
          <caption class="sr-only">Raumplan · Spalte <?= $index + 1 ?> · Kürzel, Anrede, Nachname, Raum</caption>
          <colgroup><col class="w-[14%]"><col class="w-[16%]"><col class="w-[48%]"><col class="w-[22%]"></colgroup>
          <tbody>
          <?php foreach ($spalte as $person): ?>
            <tr class="border-b border-gray-400 odd:bg-kgs-lblue/15">
              <td class="px-[.3em] py-[.12em] leading-[1.12] whitespace-nowrap first:font-bold last:font-bold"><?= esc($person['kürzel']) ?></td>
              <td class="px-[.3em] py-[.12em] leading-[1.12] whitespace-nowrap first:font-bold last:font-bold"><?= esc($person['anrede']) ?></td>
              <td class="px-[.3em] py-[.12em] leading-[1.12] whitespace-nowrap first:font-bold last:font-bold"><?= esc($person['nachname']) ?></td>
              <td class="px-[.3em] py-[.12em] leading-[1.12] whitespace-nowrap first:font-bold last:font-bold"><?= esc($person['raum'] ?: '–') ?></td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </div>
    <?php endforeach ?>
  <?php endif ?>
  </main>
  <script>
    // Alle Einträge gleichzeitig zeigen; auch lange Namen vollständig einpassen.
    const main = document.querySelector('main');
    const header = document.querySelector('header');
    const tables = Array.from(document.querySelectorAll('table'));
    const cells = tables.flatMap(table => Array.from(table.querySelectorAll('td')));
    const range = document.createRange();
    function fit() {
      header.style.fontSize = '';
      header.style.zoom = '1';
      if (header.scrollWidth > header.clientWidth) {
        header.style.zoom = String(header.clientWidth / header.scrollWidth);
      }
      let low = 1;
      let high = 64;
      const availableHeight = main.getBoundingClientRect().height - 4;
      for (let step = 0; step < 12; step++) {
        const size = (low + high) / 2;
        // Direkt auf die Tabellen anwenden, unabhängig von geerbten Schriftgrößen.
        tables.forEach(table => { table.style.fontSize = size + 'px'; });
        const fits = tables.every(table => table.getBoundingClientRect().height <= availableHeight) &&
          cells.every(cell => {
            range.selectNodeContents(cell);
            const style = getComputedStyle(cell);
            const availableWidth = cell.getBoundingClientRect().width - parseFloat(style.paddingLeft) - parseFloat(style.paddingRight);
            return range.getBoundingClientRect().width <= availableWidth;
          });
        if (fits) low = size;
        else high = size;
      }
      tables.forEach(table => { table.style.fontSize = low + 'px'; });
    }
    fit();
    window.addEventListener('resize', fit);
    window.addEventListener('load', fit);
    if (document.fonts) document.fonts.ready.then(fit);
  </script>
</body>
</html>
