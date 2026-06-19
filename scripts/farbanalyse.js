/**
 * Durchsucht alle HTML-, JS-, PHP- und Vue-Dateien nach Tailwind-Farbklassen,
 * zählt sie und gruppiert sie nach Basisfarbe. So sieht man schnell, ob sich
 * zu viele Varianten einer Farbe eingeschlichen haben (z. B. 10 Stufen Slate).
 *
 * Ausführen mit: npm run farben
 */

const fg = require('fast-glob');
const fs = require('fs');

// Utilities, die eine Farbe annehmen koennen (inkl. Tailwind v4)
const UTILITIES =
  'bg|text|border|from|via|to|ring|ring-offset|divide|outline|decoration|fill|stroke|placeholder|accent|caret|shadow';

// Erlaubte Stufen sind 50, 100 … 950 -> zwei- ODER dreistellig.
// Optionaler Opacity-Modifier (/50) und Varianten-Praefixe (hover:) werden
// vom \b bzw. der Klassengrenze automatisch korrekt behandelt.
const regex = new RegExp(`\\b(?:${UTILITIES})-([a-z]+)-(\\d{2,3})\\b`, 'g');

(async () => {
  const files = await fg(['**/*.{html,js,php,vue}'], {
    ignore: ['node_modules', 'vendor', 'kirby', 'assets/vendor'],
  });

  // farbe -> { total, stufen: { stufe -> count } }
  const colors = {};
  let totalMatches = 0;

  for (const file of files) {
    const content = fs.readFileSync(file, 'utf8');
    let m;
    while ((m = regex.exec(content)) !== null) {
      const [, name, shade] = m;
      colors[name] ??= { total: 0, stufen: {} };
      colors[name].total++;
      colors[name].stufen[shade] = (colors[name].stufen[shade] || 0) + 1;
      totalMatches++;
    }
  }

  const sorted = Object.entries(colors).sort((a, b) => b[1].total - a[1].total);

  console.log(`Farb-Analyse (${files.length} Dateien, ${totalMatches} Treffer)\n`);
  console.log('Farbe        Stufen  Verteilung');
  console.log('---------------------------------------------------------------');
  for (const [name, data] of sorted) {
    const stufen = Object.keys(data.stufen)
      .map(Number)
      .sort((a, b) => a - b);
    const verteilung = stufen.map((s) => `${s} (${data.stufen[s]}×)`).join(', ');
    const anzahl = String(stufen.length).padStart(2);
    console.log(`${name.padEnd(12)} ${anzahl}      ${verteilung}`);
  }
})();
