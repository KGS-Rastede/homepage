<?php
// Dieselben aufbereiteten Daten wie in der aktiven Ansicht, spaltenweise gelesen.
$spalten = $lehrkraefte ? array_chunk($lehrkraefte, (int)ceil(count($lehrkraefte) / 3)) : [];
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sprechtag · Raumplan · KGS Rastede</title>
  <style>
    :root { color-scheme: light; font-family: Arial, Helvetica, sans-serif; color: #222; background: #f5f5f3; }
    * { box-sizing: border-box; }
    body { margin: 0; height: 100vh; height: 100dvh; padding: 1.2vh 1.5vw; display: flex; flex-direction: column; overflow: hidden; }
    header { flex: none; display: flex; align-items: baseline; gap: .65em; white-space: nowrap; margin-bottom: 1.2vh; color: #606060; }
    h1 { margin: 0; font-size: clamp(16px, 2.35vw, 48px); font-weight: 500; }
    .subtitle { margin: 0; font-size: clamp(12px, 1.5vw, 30px); }
    main { flex: 1; min-height: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25vw; }
    table { width: 100%; border-collapse: collapse; table-layout: fixed; font-size: inherit; }
    .column { min-width: 0; border-top: 4px solid #777; }
    col.code { width: 14%; } col.salutation { width: 16%; } col.name { width: 48%; } col.room { width: 22%; }
    tr { border-bottom: 1px solid #aaa; }
    tr:nth-child(odd) { background: #e9e9e7; }
    td { padding: .12em .3em; line-height: 1.12; white-space: nowrap; }
    td:first-child, td:last-child { font-weight: 700; }
    .message { font-size: 2vw; grid-column: 1 / -1; }
    caption { position: absolute; width: 1px; height: 1px; overflow: hidden; clip-path: inset(50%); }
  </style>
</head>
<body>
  <header>
    <h1>Schüler:innen- und Elternsprechtag</h1>
    <p class="subtitle">· Raumplan<?php if ($page->sprechtagDatum()->isNotEmpty()): ?> · <?= esc($page->sprechtagDatum()->toDate('d.m.Y')) ?><?php endif ?></p>
  </header>
  <main>
  <?php if ($fehler !== null || !$lehrkraefte): ?>
    <p class="message" role="status"><?= esc($fehler ?? 'Aktuell sind keine Raumdaten hinterlegt.') ?></p>
  <?php else: ?>
    <?php foreach ($spalten as $index => $spalte): ?>
      <div class="column">
        <table>
          <caption>Raumplan · Spalte <?= $index + 1 ?> · Kürzel, Anrede, Nachname, Raum</caption>
          <colgroup><col class="code"><col class="salutation"><col class="name"><col class="room"></colgroup>
          <tbody>
          <?php foreach ($spalte as $person): ?>
            <tr>
              <td><?= esc($person['kürzel']) ?></td>
              <td><?= esc($person['anrede']) ?></td>
              <td><?= esc($person['nachname']) ?></td>
              <td><?= esc($person['raum'] ?: '–') ?></td>
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
    function fit() {
      header.style.fontSize = '';
      header.style.zoom = '1';
      if (header.scrollWidth > header.clientWidth) {
        header.style.zoom = String(header.clientWidth / header.scrollWidth);
      }
      let low = 1;
      let high = 64;
      for (let step = 0; step < 12; step++) {
        const size = (low + high) / 2;
        main.style.fontSize = size + 'px';
        const fits = tables.every(table =>
          table.getBoundingClientRect().height <= table.parentElement.clientHeight &&
          Array.from(table.querySelectorAll('td')).every(cell => cell.scrollWidth <= cell.clientWidth)
        );
        if (fits) low = size;
        else high = size;
      }
      main.style.fontSize = low + 'px';
    }
    fit();
    window.addEventListener('resize', fit);
    if (document.fonts) document.fonts.ready.then(fit);
  </script>
</body>
</html>
