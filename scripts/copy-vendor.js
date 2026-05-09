/**
 * Kopiert benötigte Vendor-Dateien aus node_modules nach assets/vendor/.
 * Ausführen mit: npm run copy
 */

const fs = require('fs');
const path = require('path');

function copyFile(src, dest) {
  fs.mkdirSync(path.dirname(dest), { recursive: true });
  fs.copyFileSync(src, dest);
  console.log(`✓ ${dest}`);
}

function copyDir(src, dest) {
  fs.mkdirSync(dest, { recursive: true });
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);
    if (entry.isDirectory()) copyDir(srcPath, destPath);
    else copyFile(srcPath, destPath);
  }
}

// Alpine JS
copyFile(
  'node_modules/alpinejs/dist/cdn.min.js',
  'assets/vendor/js/alpine.min.js'
);

// FullCalendar 7 (Alles in einem Bundle)
copyFile(
  'node_modules/fullcalendar/all.global.js',
  'assets/vendor/js/fullcalendar-all.global.js'
);
copyFile(
  'node_modules/fullcalendar/locales/de.global.js',
  'assets/vendor/js/fullcalendar-de.global.js'
);

// FullCalendar 7 Classic-Theme-Plugin (registriert das Theme in globalPlugins)
copyFile(
  'node_modules/fullcalendar/themes/classic/global.js',
  'assets/vendor/js/fullcalendar-classic-theme.global.js'
);

// FullCalendar 7 CSS (wird nicht mehr automatisch per JS eingefügt)
copyFile(
  'node_modules/fullcalendar/skeleton.css',
  'assets/vendor/css/fullcalendar-skeleton.css'
);
copyFile(
  'node_modules/fullcalendar/themes/classic/palette.css',
  'assets/vendor/css/fullcalendar-classic-palette.css'
);
copyFile(
  'node_modules/fullcalendar/themes/classic/theme.css',
  'assets/vendor/css/fullcalendar-classic-theme.css'
);

// Temporal Polyfill (Pflichtabhängigkeit von FullCalendar 7)
copyFile(
  'node_modules/temporal-polyfill/global.min.js',
  'assets/vendor/js/temporal-polyfill.min.js'
);

// iCal + FullCalendar iCal-Plugin
copyFile(
  'node_modules/ical.js/dist/ical.min.js',
  'assets/vendor/js/ical.min.js'
);
copyFile(
  'node_modules/@fullcalendar/icalendar/global.js',
  'assets/vendor/js/fullcalendar-icalendar.global.js'
);

// Bootstrap Icons (CSS + Schriftdateien, Pfade müssen relativ zueinander bleiben)
copyDir(
  'node_modules/bootstrap-icons/font',
  'assets/vendor/bootstrap-icons/font'
);

console.log('\nFertig. Alle Vendor-Dateien liegen in assets/vendor/');
