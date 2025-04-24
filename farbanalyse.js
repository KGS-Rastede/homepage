// farbanalyse.js
// This script scans all HTML, JS, PHP, and Vue files in the current directory and its subdirectories for Tailwind CSS color classes.
// It counts the occurrences of each color class and prints the results to the console.
// Usage: node farbanalyse.js
const fg = require('fast-glob');
const fs = require('fs');

(async () => {
  const files = await fg(['**/*.{html,js,php,vue}'], {
    ignore: ['node_modules'],
  });
  const regex = /\b(?:bg|text|border|from|to|via)-[a-z]+-\d{3}\b/g;
  const colorCounts = {};

  for (const file of files) {
    const content = fs.readFileSync(file, 'utf8');
    const matches = content.match(regex) || [];
    matches.forEach((cls) => {
      colorCounts[cls] = (colorCounts[cls] || 0) + 1;
    });
  }

  const sorted = Object.entries(colorCounts).sort((a, b) => b[1] - a[1]);
  console.log('Verwendete Farben:');
  sorted.forEach(([cls, count]) => {
    console.log(`${count}x ${cls}`);
  });
})();
