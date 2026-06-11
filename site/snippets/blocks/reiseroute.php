<?php

$stationen = $block
  ->reise()
  ->toBlocks()
  // Stationen chronologisch sortieren, damit die Route in der
  // richtigen Reihenfolge gezeichnet wird.
  ->sortBy(fn($station) => $station->datum()->value(), 'asc');

$stationenDaten = [];

foreach ($stationen as $station) {
  $stationenDaten[] = [
    'name' => $station->name()->value(),
    'datum' => $station->datum()->toDate('d.m.Y'),
    'bild' => ($image = $station->bild()->toFile()) ? $image->url() : '',
    // Leaflet erwartet Koordinaten als [Breitengrad, Längengrad]
    'koordinaten' => [
      (float) $station->breitengrad()->value(),
      (float) $station->laengengrad()->value(),
    ],
  ];
}

// Eindeutige ID, damit mehrere Reiserouten auf einer Seite funktionieren
$mapId = 'reiseroute-' . $block->id();
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
  .reiseroute-map {
    height: 400px;
  }

  .reiseroute-marker-bild {
    border-radius: 50%;
    object-fit: cover;
  }
</style>

<div id="<?= $mapId ?>" class="reiseroute-map"></div>
<button class="px-4 py-1 mt-2 text-slate-900 font-semibold rounded-full border border-slate-300 hover:text-white
    hover:bg-slate-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2
    text-center" id="<?= $mapId ?>-fit">Auf Route zoomen</button>

<script>
  (() => {
    const stationen = <?= json_encode($stationenDaten, JSON_PRETTY_PRINT) ?>;

    const map = L.map('<?= $mapId ?>');

    // Kostenlose Kartenkacheln von OpenStreetMap, kein API-Token nötig.
    // Nutzungsbedingungen: https://operations.osmfoundation.org/policies/tiles/
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>-Mitwirkende'
    }).addTo(map);

    // Route als Linie einzeichnen
    const route = L.polyline(stationen.map(s => s.koordinaten), {
      color: '#16a34a',
      weight: 4
    }).addTo(map);

    // Marker mit Popup (Ort, Datum, optional Bild) für jede Station
    for (const station of stationen) {
      const marker = L.marker(station.koordinaten).addTo(map);

      let popupHtml = `<strong>${station.name}</strong>`;
      if (station.datum) {
        popupHtml += `<br>${station.datum}`;
      }
      if (station.bild) {
        popupHtml += `<br><img src="${station.bild}" alt="" width="150" loading="lazy">`;
      }

      marker.bindPopup(popupHtml);
    }

    // So zoomen, dass die komplette Route sichtbar ist
    function fitToRoute() {
      if (stationen.length === 0) {
        // Fallback: Rastede
        map.setView([53.25, 8.2], 10);
        return;
      }

      map.fitBounds(route.getBounds(), {
        padding: [50, 50]
      });
    }

    fitToRoute();

    document.getElementById('<?= $mapId ?>-fit').addEventListener('click', fitToRoute);
  })();
</script>
