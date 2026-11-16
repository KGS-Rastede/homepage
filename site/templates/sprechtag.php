<?php
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
if (get('ansicht') === 'monitor') {
    snippet('sprechtag-monitor', compact('lehrkraefte', 'fehler', 'page'));
    return;
}
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elternsprechtag · KGS Rastede</title>
  <style>
    :root { color-scheme: light; font-family: system-ui, -apple-system, sans-serif; color: #172b3a; background: #f0f4f5; }
    * { box-sizing: border-box; }
    body { margin: 0; }
    header { padding: clamp(1.5rem, 4vw, 3.5rem) max(1.25rem, calc((100vw - 1600px) / 2)); color: white; background: #18394b; border-bottom: 6px solid #5ccbb4; }
    .school { margin: 0 0 .75rem; color: #a9e3d7; font-size: .85rem; font-weight: 750; letter-spacing: .13em; text-transform: uppercase; }
    h1 { margin: 0; font-size: clamp(2rem, 4vw, 3.5rem); letter-spacing: -.04em; }
    .intro { margin: .65rem 0 0; color: #dce8ed; font-size: 1.1rem; }
    main { max-width: 1640px; margin: auto; padding: 1.5rem 1.25rem 3rem; }
    .toolbar { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .count { color: #526976; margin: 0; }
    .search { width: min(100%, 30rem); }
    .search label { display: block; font-size: .85rem; font-weight: 650; margin-bottom: .4rem; }
    input { width: 100%; font: inherit; padding: .8rem 1rem; background: white; border: 1px solid #a9bdc7; border-radius: .6rem; }
    input:focus-visible { outline: 3px solid #258a78; outline-offset: 2px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 290px), 1fr)); gap: .75rem; }
    article { display: flex; align-items: center; justify-content: space-between; gap: .75rem; padding: 1rem 1.1rem; background: white; border: 1px solid #dde5e9; border-radius: .7rem; box-shadow: 0 2px 4px #18394b05; }
    .name { min-width: 0; }
    h2 { margin: .2rem 0; font-size: 1.15rem; overflow-wrap: anywhere; }
    .salutation { font-size: .8rem; color: #526976; }
    .code { font-size: .75rem; color: #526976; }
    .room { flex-shrink: 0; min-width: 5rem; text-align: center; padding: .55rem .65rem; border-radius: .5rem; background: #e7f5ef; color: #155746; }
    .room span { display: block; font-size: .65rem; letter-spacing: .08em; text-transform: uppercase; }
    .room strong { display: block; font-size: 1.25rem; }
    .message { background: white; border-radius: .7rem; padding: 1.5rem; }
    footer { margin-top: 2rem; color: #526976; font-size: .85rem; }
    [hidden] { display: none !important; }
    @media print { header { color: #172b3a; background: white; padding: 0 0 1rem; } .school, .intro { color: inherit; } .search, footer { display: none; } main { padding: 1rem 0; } .grid { grid-template-columns: repeat(3, 1fr); } article { break-inside: avoid; padding: .5rem; } }
  </style>
</head>
<body>
<header>
  <p class="school">KGS Rastede</p>
  <h1>Elternsprechtag</h1>
  <p class="intro">Herzlich willkommen! Hier finden Sie die Räume unserer Lehrkräfte.</p>
</header>
<main>
<?php if ($fehler !== null): ?>
  <p class="message" role="status"><?= esc($fehler) ?></p>
<?php else: ?>
  <div class="toolbar">
    <p class="count" id="count" aria-live="polite"><?= count($lehrkraefte) ?> Lehrkräfte · alphabetisch nach Nachnamen</p>
    <div class="search" hidden id="search-container">
      <label for="search">Lehrkraft oder Raum finden</label>
      <input id="search" type="search" placeholder="Name, Kürzel oder Raum …" autocomplete="off" aria-controls="rooms">
    </div>
  </div>
  <div class="grid" id="rooms">
  <?php foreach ($lehrkraefte as $person): ?>
    <article>
      <div class="name">
        <span class="salutation"><?= esc($person['anrede']) ?></span>
        <h2><?= esc($person['nachname']) ?></h2>
        <span class="code">Kürzel: <?= esc($person['kürzel']) ?></span>
      </div>
      <div class="room"><span>Raum</span><strong><?= esc($person['raum'] ?: '–') ?></strong></div>
    </article>
  <?php endforeach ?>
  </div>
  <p class="message" id="empty" <?= $lehrkraefte ? 'hidden' : '' ?>>Keine passenden Lehrkräfte gefunden.</p>
<?php endif ?>
  <footer>Elternsprechtag · KGS Rastede</footer>
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
