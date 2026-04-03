/**
 * Löscht alle durch npm install, composer install und npm run copy
 * erzeugten Verzeichnisse für einen sauberen Neustart.
 * Ausführen mit: npm run clean
 */

const fs = require('fs');

const dirs = ['node_modules', 'vendor', 'assets/vendor'];

for (const dir of dirs) {
  if (fs.existsSync(dir)) {
    fs.rmSync(dir, { recursive: true, force: true });
    console.log(`✓ ${dir} gelöscht`);
  } else {
    console.log(`– ${dir} existiert nicht, wird übersprungen`);
  }
}

console.log('\nFertig. Jetzt neu starten mit: composer install && npm install && npm run copy');
