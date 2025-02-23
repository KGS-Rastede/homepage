<!-- ========================================================= -->
<!-- Hole Koordinaten aus speicher-->
<!-- ========================================================= -->
<?php 
  $features = [];
  $koordinaten = [];

$features = snippet(
  'koordinaten-extrahieren',
  [
    'koordinaten' => $koordinaten,
    'features' => $features,
    'block' => $block
  ]
);

print_r($features);
gettype($features);

echo ($features);
?>

<!-- Gebäudeplan selber bearbeiten unter: https://osminedit.pavie.info/#18/53.24411/8.19696/0-->

<!-- Gebäudeplan selber exportieren unter: https://overpass-turbo.eu/#-->
<!-- Einfach die KGS-Rastede Suchen > Kartenausschnitt manuell wählen > Gebäude makieren > exportieren > geojson downloaden > Datei bei /content/allgemeines/anfahrt/ einfügen -->

<!-- ========================================================= -->
<!-- Karte holen -->
<!-- ========================================================= -->
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>

<!-- ========================================================= -->
<!-- Definiere HTML-Elemente (Knöpfe, Marker, Kartencontainer, etc.)-->
<!-- ========================================================= -->
<style>
    body {
      margin: 0;
      padding: 0;
      overflow: auto;
    }
    #map-container {
      position: relative;
      width: 100%;
      height: 60vh;
      overflow: hidden; 
    }
    #map {
    width: 100%; /* Breite auf 100% des Containers setzen */
    height: 87%; /* Höhe auf 100% des Containers setzen */
}
    /*==========Knöpfe für die 2D und 3D Ansicht==========*/
    #perspective-buttons {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
        display: flex; /* Flexbox für einfache Ausrichtung */
        gap: 10px; /* Abstand zwischen den Knöpfen */
        background-color: #f5f5f5; /* Hintergrund für den Container */
        padding: 6px; /* Kompaktes Padding für den Container */
        border-radius: 8px; /* Abgerundete Ecken für modernen Look */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Leichter Schatten für Tiefe */
    }

    #perspective-buttons button {
        background-color: #ffffff; /* Weißer Hintergrund für die Buttons */
        color: #333333; /* Dunkelgrauer Text */
        border: none; /* Kein Rahmen für einen sauberen Look */
        border-radius: 6px; /* Leicht abgerundete Ecken */
        padding: 6px 12px; /* Kompaktes Padding für kleinere Buttons */
        cursor: pointer; /* Zeiger-Cursor für Interaktivität */
        font-family: Arial, sans-serif; /* Moderne, serifenlose Schriftart */
        font-size: 12px; /* Kleinere Schriftgröße für einen schlankeren Look */
        transition: background-color 0.3s, transform 0.3s; /* Sanfte Übergänge bei Hover */
    }

    #perspective-buttons button:hover {
        background-color: #e0e0e0; /* Hellgrauer Hintergrund bei Hover */
        transform: translateY(-2px); /* Leichter Hover-Effekt */
    }

    #perspective-buttons button:active {
        background-color: #d0d0d0; /* Dunkleres Grau bei Aktivierung */
        transform: translateY(0); /* Rückstellung des Hover-Effekts */
    }

    /*==========Knöpfe für die Etagenauswahl==========*/
    #floor-buttons {
        position: absolute;
        top: 75px;
        right: 10px;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        background-color: #f5f5f5;
        padding: 6px; /* Reduziertes Padding für den Container */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    #floor-buttons button {
        background-color: #ffffff;
        color: #333333;
        border: none;
        border-radius: 6px;
        padding: 6px 12px; /* Reduziertes Padding für kleinere Buttons */
        margin-bottom: 6px; /* Weniger Abstand zwischen den Buttons */
        cursor: pointer;
        font-family: Arial, sans-serif;
        font-size: 12px; /* Kleinere Schriftgröße */
        transition: background-color 0.3s, transform 0.3s;
    }
    #floor-buttons button:hover {
        background-color: #e0e0e0;
        transform: translateY(-2px);
    }
    #floor-buttons button:active {
        background-color: #d0d0d0;
        transform: translateY(0);
    }
    /*==========Suchleiste==========*/
    .search-container {
        display: flex;
        align-items: center;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 400px; /* Maximale Breite der Suchleiste */
        margin: 20px auto; /* Zentriert die Suchleiste auf der Seite */
    }
    .search-input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #cccccc;
        border-radius: 8px 0 0 8px;
        font-size: 16px;
        outline: none; /* Entfernt den Standard-Fokus-Rand */
        transition: border-color 0.3s;
    }
    .search-input:focus {
        border-color: #999999; /* Farbe bei Fokussierung */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Sanfte Schatten bei Fokussierung */
    }
    .search-button {
        padding: 10px 15px;
        background-color: #f0f0f0; /* Sehr heller Grauton für einen modernen Look */
        color: #333333; /* Dunkelgrauer Text für Kontrast */
        border: 1px solid #dddddd; /* Heller Graufarbener Rand */
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
    }
    .search-button:hover {
        background-color: #e0e0e0; /* Etwas dunklerer Grauton beim Hover */
        border-color: #cccccc; /* Dunklerer Rand beim Hover */
    }
    .search-button:active {
        background-color: #d0d0d0; /* Noch dunklerer Grauton beim Klicken */
        border-color: #bbbbbb; /* Noch dunklerer Rand beim Klicken */
        transform: translateY(1px); /* Leichter Klick-Effekt */
    }
        
    .marker {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60px;              /* Größe des Markers */
        height: 60px;
        background-color: #FFFFFF; /* Weißer Hintergrund für den Marker */
        border: 5px solid #eee; /* Grauer Rand um den Marker */
        border-radius: 50%;       /* Macht den Marker rund */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Schatten für Tiefe */
        overflow: hidden;         /* Verhindert Überlauf des Bildes */
        cursor: pointer
    }

    .marker div {
        width: 30px;             /* Größe des Bildes innerhalb des Markers */
        height: 30px;
        background-size: contain; /* Bild wird vollständig angezeigt */
        background-repeat: no-repeat; /* Verhindert Wiederholung des Bildes */
        background-position: center; /* Zentriert das Bild */
    }





  </style>

<!-- ========================================================= -->
<!-- Knöpfe(mit Text) in der Karte erstellen  -->
<!-- ========================================================= -->
<div id="map-container">
  <div id="perspective-buttons">
    <button id="toggle-2d" >2D</button>
    <button id="toggle-3d">3D</button>
  </div>
  <div id="map"></div>
  <div id="floor-buttons">
    <button id="floor_2" class="circle">2</button>
    <button id="floor_1" class="circle">1</button>
    <button id="floor_0" class="circle">0</button>
    <button id="floor_-1" class="circle">-1</button>
  </div>
  <div class="search-container">
        <input type="text" class="search-input" id="searchInput" placeholder="Raum suchen...">
        <button class="search-button" id="searchButton">Suchen</button>
    </div>

<!-- ========================================================= -->
<!-- Skripte -->
<!-- ========================================================= -->


<script>
    // ---------------------------------------------------------
    //  Variablen setzen
    // ---------------------------------------------------------
	mapboxgl.accessToken = 'pk.eyJ1Ijoia2dzcmFzdGVkZSIsImEiOiJja3hnZ2dnaXczb293MnBvNWxhdWxkdnYxIn0.kHEpdxzycw6ZVg719GpdLA';

    /*
    const geojson = {
    'type': 'FeatureCollection',
    'features': <?= json_encode($features, JSON_PRETTY_PRINT) ?>
    };

    */
     
      
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [8.1964, 53.2442],//Diesen Teil nutzen, um Keine Animation zu haben
        zoom: 18.5, //Diesen Teil nutzen, um Keine Animation zu haben
        //center: [8.1964, 53.2442], //Diesen Teil nutzen, um eine Schöne Animation zu haben
        //zoom: 19, //Diesen Teil nutzen, um eine Schöne Animation zu haben
        pitch: 50,
        bearing: 20,
        antialias: true,
        projection: 'globe'
    });
    const levels = ['-1','0', '1', '2'];
    let twoD = false;
    let etage = '0';
    var searchTerm;

    map.setStyle('mapbox://styles/mapbox/outdoors-v12');
    
    // ---------------------------------------------------------
    //  Karte Laden
    // ---------------------------------------------------------
    map.on('load', () => {
        // Die KGS-Rastede (Hauptgebäude dynamisch heranzoomen)
           map.fitBounds([
            [8.1960, 53.2435], // [lng, lat] - southwestern corner of the bounds
            [8.1968, 53.2446]  // [lng, lat] - northeastern corner of the bounds
        ], {
            padding: { top: 10, bottom: 25, left: 15, right: 5 }, // Optional padding
            pitch: 50, // Behalte den aktuellen pitch
            bearing: 20, // Behalte den aktuellen bearing
            maxZoom: 18.5, // Optional: Begrenze den Zoom, damit er nicht zu weit herauszoomt
            duration: 1000
        });

        setTimeout(() => {
            setTwoD();
        }, 1000); // Verzögerung zum Starten der zweiten Phase 
        
        
        /*
        ACHTUNG: Damit das funktioniert muss noch eine geeignete Quelle für die Wetterdaten gefunden werden
        Hier ist das genutzte Beispiel nur ein Bild. Siehe: https://docs.mapbox.com/mapbox-gl-js/example/image-on-a-map/

        //=====Wetter Radar=====
        map.addSource('radar', {
            'type': 'image',
            'url': 'https://docs.mapbox.com/mapbox-gl-js/assets/radar.gif',
            'coordinates': [
                [8.1900, 53.2400],
                [8.1900, 53.24500],
                [8.2000, 53.2400],
                [8.2000, 53.2500]
            ]
        });
        map.addLayer({
            id: 'radar-layer',
            'type': 'raster',
            'source': 'radar',
            'paint': {
                'raster-fade-duration': 0
            }
        });
        */
        //=====Wetter Radar zuende=====

        map.addSource('floorplan', {
            'type': 'geojson',
            'data': '/content/allgemeines/anfahrt/bereinigte_geojson_datei.geojson'
        });


        twoD = true;

        // Zoom- und Rotationssteuerelemente hinzufügem
        var nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'bottom-right'); // Platziere sie unten rechts

        // Skala hinzufügen
        map.addControl(new mapboxgl.ScaleControl(), 'bottom-left');

        //Vollbild Knopf hinzufügen
        map.addControl(new mapboxgl.FullscreenControl(), 'top-right');
        
        function addLayerForFloor(level) {
            map.addLayer({
                'id': `floor_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['==', 'indoor', 'level'],
                    ['==', 'level', level], 
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            });
        }
        // /*
        addLayerForFloor('-1');
        addLayerForFloor('0');
        addLayerForFloor('1');
        addLayerForFloor('2');
        map.setLayoutProperty(`floor_extrusion_${etage}`, 'visibility', 'none');
        // */

        function addLayerForHalls(level) {
            map.addLayer({
                'id': `hall_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['!=', 'indoor', 'level'],
                    ['==', 'level', level]
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'base_height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            });
        }
        addLayerForHalls('-1');
        addLayerForHalls('0');
        addLayerForHalls('1');
        addLayerForHalls('2');

        function addLayerForStairs(level) {
            var filter = stair_filter(level);
            map.addLayer({
                'id': `stair_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['==', 'room', 'stairs'],
                    ['!=', 'indoor', 'level'],
                    filter
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            });
        }
        addLayerForStairs('-1');
        addLayerForStairs('0');
        addLayerForStairs('1');
        addLayerForStairs('2');

        function addLayerForRooms(level) {
            var filter = stair_filter(level);
            map.addLayer({
                'id': `room_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['!=', 'indoor', 'level'],
                    ['!=', 'room', 'lobby'],
                    ['!=', 'room', 'stairs'],
                    ['!=', 'indoor', 'corridor'],
                    ['!=', 'name', 'B020'],
                    filter
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],

                    'fill-extrusion-opacity': 1
                }
            });
        }
        addLayerForRooms('-1');
        addLayerForRooms('0');
        addLayerForRooms('1');
        addLayerForRooms('2');

        function addLayerRoomnumbers(level){
            var offset = level*(-4)
            map.addLayer({
            'id': `room_labels_floor_${level}`,
            'type': 'symbol',
            'source': 'floorplan',
            'filter': ['==', 'level', level],
            'layout': {
                'text-allow-overlap': false,  // The icon will be visible even if it collides with other previously drawn symbols.
                'text-ignore-placement': false, 
                'text-field': ['get', 'name'], 
                'text-size': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    
                    17, 3,   // zoomstufe , textgröße
                    18, 7.25,   // zoomstufe , textgröße
                    19, 12.5,   // zoomstufe , textgröße
                    20, 25,   // zoomstufe , textgröße
                    21, 50,   // zoomstufe , textgröße
                    22, 100   // zoomstufe , textgröße
                ],
                'text-offset': [0, offset] // Offset, um den Text zu verschieben, falls nötig
            },
            'paint': {
                'text-color': '#fff',
                'text-halo-color': '#AAA',
                'text-halo-width': 0.7,
                'text-translate-anchor': 'map' // Anpassung an die Kartenrotation
            }
            });
        }
        //Raumnummern hinzufügen
        addLayerRoomnumbers('-1');
        addLayerRoomnumbers('0');
        addLayerRoomnumbers('1');
        addLayerRoomnumbers('2');


        function addWalls(level){
            map.addLayer({
                'id': `room_walls_${level}`,
                'type': 'line',
                'source': 'floorplan',
                'filter': ['all',
                    ['==', 'level', level], 
                    ['==', 'indoor', 'room'],
                ],
                'layout': {
                'line-join': 'round',
                'line-cap': 'round'
                },
                'paint': {
                'line-color': '#222',
                'line-opacity': 0.25,
                'line-width': 1
                }
            });
        }
        addWalls('-1');
        addWalls('0');
        addWalls('1');
        addWalls('2');

        raumnummernVerstecken();
        waendeVerstecken();


    //==========================================================
    //==========Icons==========
    var markergeojson = getmarkergeojson()

    map.addSource('geojson-source', {
        'type': 'geojson',
        'data': markergeojson
    });

    // Add markers to the map.
    for (const marker of markergeojson.features) {
        // Create a DOM element for each marker.
        const el = document.createElement('div');
        const width = 60;  // Größe des Markers
        const height = 60;
        const iconUrl = marker.properties.iconUrl;

        el.className = 'marker';
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;

        // Create a child div for the image
        const imgDiv = document.createElement('div');
        imgDiv.style.backgroundImage = `url(${iconUrl})`;
        imgDiv.style.width = '80%';  // Größe des Bildes im Marker
        imgDiv.style.height = '80%';
        el.appendChild(imgDiv);

        el.addEventListener('mouseenter', () => {
            mouseovermarker(marker)
        });

        el.addEventListener('mouseleave', () => {
            popup.remove();
        });

        // Add markers to the map.
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
    }
    //==========Ende von Icons==========
    //==========================================================

    //==========================================================
    //==========Alle Gebäude in 3D==========
    const layers = map.getStyle().layers; // Insert the layer beneath any symbol layer.
    const labelLayerId = layers.find(
        (layer) => layer.type === 'symbol' && layer.layout['text-field']
    ).id;

    // The 'building' layer in the Mapbox Streets
    // vector tileset contains building height data
    // from OpenStreetMap.

    map.addLayer(
        {
            'id': 'add-3d-buildings',
            'source': 'composite',
            'source-layer': 'building',
            'filter': ['==', 'extrude', 'true'],
            'filter': ['all',
                    ['!=', 'type', 'school'],
                    ['==', 'extrude', 'true']
                ],
            'type': 'fill-extrusion',
            'minzoom': 15,
            'paint': {
                'fill-extrusion-color': '#aaa',

                // Use an 'interpolate' expression to
                // add a smooth transition effect to
                // the buildings as the user zooms in.
                'fill-extrusion-height': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'height']
                ],
                'fill-extrusion-base': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'min_height']
                ],
                'fill-extrusion-opacity': 0.6
            }
        },
        labelLayerId
    );
    //==========Ende von Gebäude in 3D==========
    //==========================================================

    //==========================================================
    //==========Wege animieren==========
    const geojsonWegZwischenSchulen = {
        'type': 'FeatureCollection',
        'features': [
            {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'coordinates': [
                        [8.194519503304662, 53.24126419838046],
                        [8.194605553237352, 53.24128367213041],
                        [8.194590225026104, 53.24136667404534],
                        [8.194684875475332, 53.24140982294469],
                        [8.195125653227507, 53.241452805733076],
                        [8.195155894747273, 53.24139753327026],
                        [8.195696990383453, 53.241479471767946],
                        [8.196058247056925, 53.24150021961873],
                        [8.196080582892705, 53.24153389028655],
                        [8.196210720592717, 53.24153407555923],
                        [8.196245033765223, 53.241817482727555],
                        [8.196254492380632, 53.24206543307915],
                        [8.196235161656432, 53.2424201972745],
                        [8.19624552155247, 53.24259639969466],
                        [8.19631113706609, 53.24259518799394],
                        [8.196322338182483, 53.242688045441724],
                        [8.196119412095385, 53.24269066900678],
                        [8.196018378877824, 53.24280049748779],
                        [8.195884108230302, 53.24309512789918],
                        [8.195685489115675, 53.24360691893989],
                        [8.195556065303407, 53.24395130603307],
                        [8.196288873614805, 53.24400406884726]
                        
                    ],
                    'type': 'LineString'
                }
            }
        ]
    };

    map.addSource('line', {
        type: 'geojson',
        data: geojsonWegZwischenSchulen
    });

    // add a line layer without line-dasharray defined to fill the gaps in the dashed line
    map.addLayer({
        type: 'line',
        source: 'line',
        id: 'line-background',
        paint: {
            'line-color': 'yellow',
            'line-width': 6,
            'line-opacity': 0.4
        }
    });

    // add a line layer with line-dasharray set to the first value in dashArraySequence
    map.addLayer({
        type: 'line',
        source: 'line',
        id: 'line-dashed',
        paint: {
            'line-color': 'yellow',
            'line-width': 6,
            'line-dasharray': [0, 4, 3]
        }
    });

    // technique based on https://jsfiddle.net/2mws8y3q/
    // an array of valid line-dasharray values, specifying the lengths of the alternating dashes and gaps that form the dash pattern
    const dashArraySequence = [
        [0, 4, 3],
        [0.5, 4, 2.5],
        [1, 4, 2],
        [1.5, 4, 1.5],
        [2, 4, 1],
        [2.5, 4, 0.5],
        [3, 4, 0],
        [0, 0.5, 3, 3.5],
        [0, 1, 3, 3],
        [0, 1.5, 3, 2.5],
        [0, 2, 3, 2],
        [0, 2.5, 3, 1.5],
        [0, 3, 3, 1],
        [0, 3.5, 3, 0.5]
    ];

    let step = 0;

    function animateDashArray(timestamp) {
        // Update line-dasharray using the next value in dashArraySequence. The
        // divisor in the expression `timestamp / 50` controls the animation speed.
        const newStep = parseInt(
            (timestamp / 50) % dashArraySequence.length
        );

        if (newStep !== step) {
            map.setPaintProperty(
                'line-dashed',
                'line-dasharray',
                dashArraySequence[step]
            );
            step = newStep;
        }

        // Request the next frame of the animation.
        requestAnimationFrame(animateDashArray);
    }

    // start the animation
    animateDashArray(0);


     //==========Ende von Wege animieren==========
    //==========================================================

    // Event Listener für den Suchknopf
    document.getElementById('searchButton').addEventListener('click', performSearch);

    // Event Listener für die Enter-Taste im Suchfeld
    document.getElementById('searchInput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Verhindert das Standard-Enter-Verhalten
            performSearch(); // Führt die Suche aus
        }
    });
    });

    function raumnummernVerstecken(){
            // Raumnummern für alle Etagen verstecken
            levels.forEach((level) => {
                map.setLayoutProperty(`room_labels_floor_${level}`, 'visibility', 'none');
                map.setLayoutProperty(`room_walls_${level}`, 'visibility', 'none');
            });
    }

    function waendeVerstecken(){
            // Raumnummern für alle Etagen verstecken
            levels.forEach((level) => {
                map.setLayoutProperty(`room_walls_${level}`, 'visibility', 'none');
            });
    }


    // ---------------------------------------------------------
    //  Knöpfe Eventhandler
    // ---------------------------------------------------------

    // 2D button
    document.getElementById('toggle-2d').addEventListener('click', () => {
        setTwoD();
    });

    
    // 3D button
    document.getElementById('toggle-3d').addEventListener('click', () => {
        setThreeD();
    });

    function setTwoD(){
        //map.dragRotate.disable(); //disable rotation
        //map.touchZoomRotate.disableRotation(); //disable rotation
        if(etage == 'ALLE'){
            etage = '0';
        }

        twoD = true;
        map.dragRotate.disable();
        map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
        map.easeTo({ pitch: 0, zoom: 18.7, duration: 1000}); // Set pitch to 0 for 2D view and zoom out

        //Höhe auf 0 setzen
        levels.forEach((level) => {
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-height', 0);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-base', 0);

            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-height', 0.01);
            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-base', 0.01);

            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-height', 0.01);
            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-base', 0.01);

            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-height', 0.01);
            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-base', 0.01);

            map.setLayoutProperty(`room_labels_floor_${level}`, 'text-offset', [0, 0.01]);

            map.setPaintProperty(`room_searched`, 'fill-extrusion-height', 0.01);
            map.setPaintProperty(`room_searched`, 'fill-extrusion-base', 0.01);
                
        });

        //EtagenKopffarbe der Ausgewählten etage richtig setzen
        levels.forEach((level) => {
            var floor_button = document.getElementById(`floor_${level}`);
            if(level == etage){
                floor_button.style.backgroundColor = "#d0d0d0";
            }
        });

        toggleFloor(); 
    }

    function setThreeD(){
        twoD = false;
        map.dragRotate.enable(); //enable rotation
        map.touchZoomRotate.enableRotation(); //enable rotation
        map.easeTo({ pitch: 50, zoom: 18, duration: 1000}); // Set pitch to 50 degrees for 3D view and zoom in
    
        //raumnummernVerstecken();
        waendeVerstecken();

        //Höhe auf auf 3d setzen
        levels.forEach((level) => {
            var offset = level*(-4);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-height', ['get', 'base_height']);
            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setLayoutProperty(`room_labels_floor_${level}`, 'text-offset', [0, offset]);

            map.setPaintProperty(`room_searched`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`room_searched`, 'fill-extrusion-base', ['get', 'base_height']);
        });
    }



    // Etage-Knöpfe
    //Knopfdruck erkennen
    levels.forEach((level) => {
        var floor_button = document.getElementById(`floor_${level}`);
        
        floor_button.addEventListener('click', () => {
            // Alle Knöpfe auf die ursprüngliche Farbe zurücksetzen
            levels.forEach((otherLevel) => {
                var other_button = document.getElementById(`floor_${otherLevel}`);
                other_button.style.backgroundColor = "#ffffff"; // Ihre ursprüngliche Farbe hier
            });
            // Die Farbe des angeklickten Knopfes ändern
            if(etage == level){
                if(!twoD){
                    alleEtagenAnzeigen();
                } else{
                    floor_button.style.backgroundColor = "#d0d0d0";
                }
                
            } else{
                etage = level;
                floor_button.style.backgroundColor = "#d0d0d0";
                toggleFloor(); 
            }
            
        });
    });


    //Richtige Etage anzeigen
    function toggleFloor() {
        raumnummernVerstecken();
        waendeVerstecken();
        // Raumnummern für die ausgewählte Etage anzeigen
        map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
        if(twoD){
            
            levels.forEach((level) => {
                map.setLayoutProperty(`room_walls_${level}`, 'visibility', etage === level ? 'visible' : 'none');
                map.setPaintProperty(`room_searched`, 'fill-extrusion-height', 0.01);
                map.setPaintProperty(`room_searched`, 'fill-extrusion-base', 0.01);
            });
        }

        // Filter setzen
        levels.forEach((level) => {
            //map.setLayoutProperty(`floor_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`hall_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`room_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`stair_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`floor_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
        });
        var featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: 'room_searched' });
        if (featuresTemp.length > 0) {
            for (var i = 0; i < featuresTemp.length; i++) {
                var featureTemp = featuresTemp[i];
                if(searchTerm && featureTemp.properties.name == searchTerm){
                    map.setLayoutProperty(`room_searched`, 'visibility', featureTemp.properties.level === etage ? 'visible' : 'none');
                }
            }
        }
        
    };

    function alleEtagenAnzeigen(){
        if(!twoD){
            etage = 'ALLE';
            raumnummernVerstecken();
            waendeVerstecken();
            for (var i = 0; i < 2; i++) {
                i;
                map.setLayoutProperty(`room_labels_floor_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`hall_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`room_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`stair_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`floor_extrusion_${i}`, 'visibility', 'visible');
            }
        } 
        
    }

    // Raumsuche Knopf
    // Funktion zum Auslösen der Suche -> Rest ist in Load drin
    function performSearch() {
        var query = document.getElementById('searchInput').value;
        console.log("Suchbegriff:", query); // Hier wird die Suche ausgeführt
        // Füge hier den Code hinzu, um die Suche durchzuführen
        gesuchterRaum = query;
        raumsuchen(gesuchterRaum)
    }

    function raumsuchen(gesuchterRaum) {
        let ersterBuchstabe = gesuchterRaum.charAt(0).toUpperCase();
        let zweiterBuchstabe = gesuchterRaum.charAt(1);
        let searchTerm;
        if (["A", "B", "C", "M", "V"].includes(ersterBuchstabe) && !isNaN(zweiterBuchstabe)) {
            searchTerm = String(gesuchterRaum).toUpperCase();
        } else {
            searchTerm = String(gesuchterRaum);
        }

        var roomFound = false;
        var etageChanged = false; // Variable zur Verfolgung des Etagenwechsels bei Raumsuche

        // Iteriere durch die Ebenen (levels)
        levels.forEach((level) => {
            const roomLayerId = `room_extrusion_${level}`;

            map.setPaintProperty(roomLayerId, 'fill-extrusion-opacity', 1);

            // Überprüfe, ob die Ebene (roomLayerId) existiert
            if (map.getLayer(roomLayerId)) {
                var featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: roomLayerId });

                if (featuresTemp.length > 0) {

                    // Entferne die "room_searched"-Ebene, falls sie existiert
                    if (map.getLayer('room_searched')) {
                        map.removeLayer('room_searched');
                    }
                    for (var i = 0; i < featuresTemp.length; i++) {
                        var featureTemp = featuresTemp[i];
                        if (featureTemp.properties.name == searchTerm) {
                            // Setze das Level des gefundenen Raums in der Layer "room_searched"
                            //var roomSearchedLevel = level;

                            // Erstelle die zusätzliche Ebene für den gesuchten Raum
                            map.addLayer({
                                'id': 'room_searched',
                                'type': 'fill-extrusion',
                                'source': 'floorplan',
                                'layout': {},
                                'paint': {
                                    'fill-extrusion-color': 'red',
                                    'fill-extrusion-height': ['get', 'height'],
                                    'fill-extrusion-base': ['get', 'base_height'],
                                    'fill-extrusion-opacity': 1.0
                                },
                                'filter': ['==', 'name', searchTerm]
                            }, roomLayerId);

                            // Jetzt kannst du roomSearchedLevel verwenden, um damit zu arbeiten
                            //console.log(`Das Level des gesuchten Raums '${searchTerm}' ist ${roomSearchedLevel}.`);

                            roomFound = true;

                            zoomToRoom(featureTemp);
                            
                            //=====Popup mit der raumnummer anzeigen=====
                            showRoomNamePopup(featureTemp)
                            break; // Du kannst die Schleife beenden, da der Raum gefunden wurde
                        }
                    
                    }

                    // Die Etage, in der der gesuchte Raum angezeigt wird (sobald der gesuchte Raum gefunden/erstellt wurde)
                    map.on('data', function (e) {
                        if (e.dataType === 'source' && e.sourceId === 'floorplan' && e.isSourceLoaded && roomFound) {
                            // Die Datenquelle 'floorplan' wurde vollständig geladen
                            // Jetzt können wir die Aktionen ausführen

                            var featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: 'room_searched' });

                            if (featuresTemp && !etageChanged) {
                                etageChanged = true;
                                for (var i = 0; i < featuresTemp.length; i++) {
                                    var featureTemp = featuresTemp[i];
                                    if(featureTemp.properties.name == searchTerm){
                                        if (featureTemp.properties.level == '-1') {
                                            etage = '-1';
                                        } else if (featureTemp.properties.level == '0') {
                                            etage = '0';
                                        } else if (featureTemp.properties.level == '1') {
                                            etage = '1';
                                        } else if (featureTemp.properties.level == '2') {
                                            etage = '2';
                                        }
                                    }
                                }
                                console.log(etage)
                                toggleFloor();

                                // Ändere die Knopffarben hier entsprechend der ausgewählten Etage
                                levels.forEach((otherLevel) => {
                                    var floor_button = document.getElementById(`floor_${otherLevel}`);
                                    floor_button.style.backgroundColor = otherLevel === etage ? "#d0d0d0" : "#ffffff";
                                });
                            }
                        }
                    });
                    map.moveLayer('room_searched');
                    return; // Beende die Schleife, wenn der Raum gefunden wurde
                }
            }
        });

        if (!roomFound) {
            //alert('Raum nicht gefunden.');
            showToast('Raum nicht gefunden');
        }
    }

    function showToast(message, bgColor = 'red') {
    let searchContainer = document.querySelector('.search-container');
    if (!searchContainer) return;

    let toast = document.createElement('div');
    toast.innerText = message;
    toast.style.position = 'absolute';
    toast.style.background = bgColor;
    toast.style.color = 'white';
    toast.style.padding = '8px 12px';
    toast.style.borderRadius = '5px';
    toast.style.fontSize = '14px';
    toast.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.2)';
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';

    // Position über dem Search-Container berechnen
    let rect = searchContainer.getBoundingClientRect();
    toast.style.left = `${rect.left + window.scrollX}px`;
    toast.style.top = `${rect.top + window.scrollY - 40}px`; // 40px über dem Container

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(-5px)';
    }, 100);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(0px)';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}



    // Hinzufügen eines Klick-Event-Listeners zur Karte
    map.on('click', function (evt) {
        // Fügen Sie hier Ihren Code hinzu, um auf Klicks zu reagieren
        var featuresTemp = map.queryRenderedFeatures(evt.point);
        if (featuresTemp) {
            for (var i = 0; i < featuresTemp.length; i++) {
                var featureTemp = featuresTemp[i];
                if (featureTemp.properties.indoor === 'room') {
                    //angeklickte Etage auswählen => Irrelevant, da die raumsuchfunktion das bereits macht
                    //etage = featureTemp.properties.level;
                    //toggleFloor();
                    //Raumname 
                    name = featureTemp.properties.name;
                    console.log("Raum geklickt. Etage: " + name);
                    if (map.getLayer('room_searched')) {
                        map.removeLayer('room_searched');
                    } else{
                       raumsuchen(name);
                        if (currentPopup) {
                            currentPopup.remove();
                        }  
                       
                    }
                    return;
                }
            }
        }
    });

    function zoomToRoom(featureTemp){
       // Nehme die einzelne Koordinate des Raums
        var centerRoom = calculateMiddleofFeaure(featureTemp); ;
        map.flyTo({
            center: centerRoom,
            essential: true // this animation is considered essential with respect to prefers-reduced-motion
        });
    }

    let currentPopup = null;

    function calculateMiddleofFeaure(feature){
        // Berechne die Bounding Box des Features, um den Mittelpunkt zu finden
        const coordinates = feature.geometry.type === 'Polygon'
            ? feature.geometry.coordinates[0] // Für einfache Polygone
            : feature.geometry.coordinates.flat(); // Für MultiPolygone

        // Konvertiere die Koordinaten in mapboxgl.LngLat Objekte
        const lngLats = coordinates.map(coord => new mapboxgl.LngLat(coord[0], coord[1]));

        // Berechne den Mittelpunkt
        const bounds = new mapboxgl.LngLatBounds();
        lngLats.forEach(lngLat => bounds.extend(lngLat));
        const center = bounds.getCenter();
        return center;
    }

    function showRoomNamePopup(featureTemp){
        //=====Popup mit der raumnummer anzeigen=====
        const center = calculateMiddleofFeaure(featureTemp); 

        if (currentPopup) {
            currentPopup.remove();
        }  
        // Setze das Popup an den Mittelpunkt des Features und verschiebe es nach oben
        currentPopup = new mapboxgl.Popup({
            closeOnClick: false,
            closeButton: false, // Deaktiviert das Schließen-Symbol (Kreuz)
            offset: [0, -30] // Verschiebt das Popup 30 Pixel nach oben
            
        })
        .setLngLat(center)
        .setHTML(`<strong>${featureTemp.properties.name}</strong>`)
        .addTo(map);
        
    }


    function rotateCamera(timestamp) {
        // clamp the rotation between 0 -360 degrees
        // Divide timestamp by 100 to slow rotation to ~10 degrees / sec
        map.rotateTo((timestamp / 100) % 360, { duration: 0 });
        // Request the next frame of the animation.
        requestAnimationFrame(rotateCamera);
    };



    function stair_filter(level) {
        var filter;
        if (level === '-1') {
                    filter = ['any',
                        ['==', 'level', '-1'],
                        ['==', 'level', '-1;0'],
                        ['==', 'level', '-1-1'],
                        ['==', 'level', '-1-2']
                    ];
                } else if (level === '0') {
                    filter = ['any',
                        ['==', 'level', '0'],
                        ['==', 'level', '-1;0'],
                        ['==', 'level', '0;1'],
                        ['==', 'level', '-1-1'],
                        ['==', 'level', '0-2'],
                        ['==', 'level', '-1-2'],
                        ['==', 'level', '1-2']
                    ];
                } else if (level === '1') {
                    filter = ['any',
                        ['==', 'level', '1'],
                        ['==', 'level', '0;1'],
                        ['==', 'level', '1;2'],
                        ['==', 'level', '-1-1'],
                        ['==', 'level', '-1-2'],
                        ['==', 'level', '0-2']
                    ];
                } else if (level === '2') {
                    filter = ['any',
                        ['==', 'level', '2'],
                        ['==', 'level', '1;2'],
                        ['==', 'level', '0-2'],
                        ['==', 'level', '-1-2']
                    ];
                } else {
                    filter = null;
                }
        return filter
    };

//==========================================================
//==========Icons==========
function getmarkergeojson(){
    return geojson = {
        'type': 'FeatureCollection',
        'features': [
            <?php foreach ($block->reise()->toBlocks() as $block) : ?> {
                    'type': 'Feature',
                    'properties': {
                        <?php
                        if ($block->name()->value() == "Feldbreite") : ?> 
                        'message': '<?= $page->adresse_s2()->toBlocks()->first()->content()->text()->value() ?>', //Holt Die Beschreibung des Icons
                        'iconSize': [50, 50],

                        
                        <?php elseif ($block->name()->value() == "Hauptgebäude") : ?> 
                        'message': '<?= $page->adresse_s1()->toBlocks()->first()->content()->text()->value() ?>', //Holt Die Beschreibung des Icons
                        'iconSize': [50, 50],

                        <?php else : ?> 

                        'message': 'Keine Adresse Vorhanden',
                        'iconSize': [50, 50],

                        <?php endif ?>
                                            

                        <?php
                        if ($block->bild()->isEmpty()) : ?> 
                            //Es wurde kein Bild hinterlegt, also ein Standard-Bild
                           'iconUrl': '<?= $kirby->url('assets') ?>/logo-kgs.jpg'

                        <?php else : ?> 

                            'iconUrl': '<?= $block->bild()->toFile()->url() ?>'

                        <?php endif ?>


                    },
                    'geometry': {
                        'type': 'Point',
                        'coordinates': [<?= $block->breitengrad() ?>, <?= $block->laengengrad() ?>]
                    }
                },
            <?php endforeach ?>
        ]
    };
}




// Create a popup, but don't add it to the map yet. -> Für die Icons zum Anzeigen der Beschreibung
const popup = new mapboxgl.Popup({
    closeButton: false,
    closeOnClick: false
});

// Definiere die mouseovermarker-Funktion
function mouseovermarker(marker) {
    // Kopiere die Koordinaten
    const coordinates = marker.geometry.coordinates.slice();
    const description = marker.properties.message;

    /* Notiz: Geht scheinbar auch ohne diesen code
    // Stelle sicher, dass die Popups über dem richtigen Feature erscheinen
    while (Math.abs(map.getCenter().lng - coordinates[0]) > 180) {
        coordinates[0] += map.getCenter().lng > coordinates[0] ? 0ß : -360; 
    }
        
    //Popup verschieben, sodass es nicht den Marker verdeckt
    var offset = [0, -30];
    const popupPosition = map.project(coordinates);
    if (popupPosition.y < 250) {  // Wenn das Popup nahe am oberen Rand ist
        offset = [0, 30];  // Verschiebe es nach unten
    }
*/


    // Populiere das Popup und setze die Koordinaten
    popup.setLngLat(coordinates).setHTML(description).addTo(map);
    popup.setOffset(offset);
    console.log(`Die Koordinate ist '${coordinates}' und die Beschreibung: ${description}.`);
    map.options.scrollWheelZoom = false;
}


console.log(`markergeojson geholt`);
map.on('mouseenter', 'geojson-source', (e) => {
    
});

map.on('mouseleave', 'places', () => {
    map.getCanvas().style.cursor = '';
    
});

//==========Ende von Icons==========
//==========================================================
</script>

</body>

