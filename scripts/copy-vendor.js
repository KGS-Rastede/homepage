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

// FullCalendar
copyFile(
  'node_modules/@fullcalendar/core/index.global.min.js',
  'assets/vendor/js/fullcalendar-core.min.js'
);
copyFile(
  'node_modules/@fullcalendar/daygrid/index.global.min.js',
  'assets/vendor/js/fullcalendar-daygrid.min.js'
);
copyFile(
  'node_modules/@fullcalendar/timegrid/index.global.min.js',
  'assets/vendor/js/fullcalendar-timegrid.min.js'
);
copyFile(
  'node_modules/@fullcalendar/list/index.global.min.js',
  'assets/vendor/js/fullcalendar-list.min.js'
);

// iCal + FullCalendar iCal-Plugin
copyFile(
  'node_modules/ical.js/build/ical.min.js',
  'assets/vendor/js/ical.min.js'
);
copyFile(
  'node_modules/@fullcalendar/icalendar/index.global.min.js',
  'assets/vendor/js/fullcalendar-icalendar.min.js'
);

// Bootstrap Icons (CSS + Schriftdateien, Pfade müssen relativ zueinander bleiben)
copyDir(
  'node_modules/bootstrap-icons/font',
  'assets/vendor/bootstrap-icons/font'
);

console.log('\nFertig. Alle Vendor-Dateien liegen in assets/vendor/');
