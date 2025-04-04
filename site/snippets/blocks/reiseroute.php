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
?>
<!-- ========================================================= -->
<!-- Knöpfe(mit Text) in der Karte erstellen  -->
<!-- ========================================================= -->
<div id="map-container" class="relative w-full h-[60vh] overflow-hidden">
    <!-- 2D und 3D Buttons -->
    <div id="perspective-buttons" class="absolute top-2 left-2 z-10 flex gap-2 bg-gray-100 p-2 rounded-xl shadow-lg">
        <button id="toggle-2d" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">2D</button>
        <button id="toggle-3d" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">3D</button>
    </div>

    <!-- Karte -->
    <div id="map" class="w-full h-[87%]"></div>

    <!-- Etagen Buttons -->
    <div id="floor-buttons" class="absolute top-[75px] right-2 z-10 flex flex-col items-end bg-gray-100 p-2 rounded-xl shadow-lg">
        <button id="floor_2" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 mb-2 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">2</button>
        <button id="floor_1" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 mb-2 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">1</button>
        <button id="floor_0" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 mb-2 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">0</button>
        <button id="floor_-1" class="bg-white text-gray-700 border-none rounded-lg py-2 px-4 text-sm hover:bg-gray-200 active:bg-gray-300 transition-all">-1</button>
    </div>

    <!-- Suchleiste -->
    <div class="search-container flex items-center rounded-lg overflow-hidden max-w-[400px] mx-auto my-5">
      <form action="javascript:void(0)" onsubmit="raumsuchen(this.roomsearch.value)" class="w-full flex">
        <input type="text" name="roomsearch" class="flex-1 py-2 px-3 border border-gray-300 rounded-l-lg text-base focus:outline-none focus:ring-2 focus:ring-gray-300 box-border" placeholder="Raum suchen...">
        <button type="submit" class="py-2 px-4 bg-gray-200 text-gray-700 border border-gray-300 rounded-r-lg hover:bg-gray-300 active:bg-gray-400 transition-all box-border">Suchen</button>
      </form>
    </div>
</div>


<!-- ========================================================= -->
<!-- Skripte -->
<!-- ========================================================= -->
<script>
    // ---------------------------------------------------------
    //  Variablen setzen
    // ---------------------------------------------------------
    <?php
        //Accestoken aus der config.php Datei holen
        $mapboxAccessToken = Config::get('mapbox.access_token');
    ?>
    //mapboxgl.accessToken auf den soeben geholten Token setzen
    mapboxgl.accessToken = "<?= $mapboxAccessToken; ?>";
      
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/outdoors-v12', 
        center: [8.1964, 53.2442],
        zoom: 18.5, 
        pitch: 50, 
        bearing: 20, 
        antialias: true,
        projection: 'globe'
    });
    
    const levels = ['-1','0', '1', '2'];
    let twoD = false;
    let etage = '0';
    let searchTerm;

    
    // ---------------------------------------------------------
    //  Karte Laden
    // ---------------------------------------------------------
    map.on('load', () => {
        //------------Die KGS-Rastede (Hauptgebäude) dynamisch heranzoomen------------------------
        map.fitBounds([
            [8.1960, 53.2435], // [lng, lat] - südwestliche Ecke des angezeigten Kartenausschnitts
            [8.1968, 53.2446]  // [lng, lat] - nordöstliche Ecke des angezeigten Kartenausschnitts
        ], {
            padding: { top: 10, bottom: 25, left: 15, right: 5 }, // Optional padding
            pitch: 50, // Behalte den aktuellen pitch
            bearing: 20, // Behalte den aktuellen bearing
            maxZoom: 18.5, // Optional: Begrenze den Zoom, damit er nicht zu weit herauszoomt
            duration: 1000 //Dauer der Animation
        });

        // Sobald die Animation abgeschlossen ist, wird setTwoD() aufgerufen
        map.once('moveend', () => {
            setTwoD();
        });


        //------------Steuerungselemente hinzufügen------------------------
        // Zoom- und Rotationssteuerelemente hinzufügem
        const nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'bottom-right'); // Platziere sie unten rechts

        // Skala hinzufügen
        map.addControl(new mapboxgl.ScaleControl(), 'bottom-left');

        //Vollbild Knopf hinzufügen
        map.addControl(new mapboxgl.FullscreenControl(), 'top-right');
        

        // ------------ Quelle für alle Layer hinzufügen ------------
        map.addSource('floorplan', {
            'type': 'geojson',
            'data': '/content/allgemeines/anfahrt/bereinigte_geojson_datei.geojson'
        });

        // Liste der Stockwerke
        const levels = ['-1', '0', '1', '2'];

        // Generische Funktion zum Hinzufügen einer Layer
        function addLayer(idPrefix, type, level, filter, paint = {}, layout = {}) {
            map.addLayer({
                'id': `${idPrefix}_${level}`,
                'type': type,
                'source': 'floorplan',
                'filter': filter,
                'paint': paint,
                'layout': layout
            });
        }

        // --------- Layer für Böden, Etagenwände, Treppen, Räume hinzufügen ---------
        levels.forEach(level => {
            // Boden (Etagen)
            addLayer(`floor_extrusion`, 'fill-extrusion', level, 
                ['all', ['==', 'indoor', 'level'], ['==', 'level', level]], 
                {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            );

            // Etagenwände
            addLayer(`hall_extrusion`, 'fill-extrusion', level, 
                ['all', ['!=', 'indoor', 'level'], ['==', 'level', level]], 
                {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'base_height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            );

            // Treppen
            const stairFilter = stair_filter(level) || ['==', 'level', level]; // Falls `stair_filter(level)` undefined ist
            addLayer(`stair_extrusion`, 'fill-extrusion', level, 
                ['all', ['==', 'room', 'stairs'], ['!=', 'indoor', 'level'], stairFilter], 
                {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            );

            // Räume
            addLayer(`room_extrusion`, 'fill-extrusion', level, 
                ['all', ['!=', 'indoor', 'level'], ['!=', 'room', 'lobby'], ['!=', 'room', 'stairs'], 
                ['!=', 'indoor', 'corridor'], ['!=', 'name', 'B020'], stairFilter], 
                {
                    'fill-extrusion-color': ['get', 'colour'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 1
                }
            );
        });

        // --------- Raumnummern hinzufügen ---------
        levels.forEach(level => {
            const offset = level * (-4);
            addLayer(`room_labels_floor`, 'symbol', level, ['==', 'level', level], 
                {
                    'text-color': '#fff',
                    'text-halo-color': '#AAA',
                    'text-halo-width': 0.7,
                    'text-translate-anchor': 'map'
                },
                {
                    'text-allow-overlap': false,
                    'text-ignore-placement': false,
                    'text-field': ['get', 'name'],
                    'text-size': [
                        'interpolate', ['linear'], ['zoom'],
                        17, 3, 18, 7.25, 19, 12.5, 20, 25, 21, 50, 22, 100
                    ],
                    'text-offset': [0, offset]
                }
            );
        });

        // --------- Wände hinzufügen ---------
        levels.forEach(level => {
            addLayer(`room_walls`, 'line', level, ['all', ['==', 'level', level], ['==', 'indoor', 'room']], 
                {
                    'line-color': '#222',
                    'line-opacity': 0.25,
                    'line-width': 1
                },
                {
                    'line-join': 'round',
                    'line-cap': 'round'
                }
            );
        });

        // Raumnummern & Wände zu Beginn verstecken für schnelleres Laden
        raumnummernVerstecken();
        waendeVerstecken();


    //==========================================================
    //========== Icons ==========
    const markergeojson = getmarkergeojson();

    map.addSource('geojson-source', {
        'type': 'geojson',
        'data': markergeojson
    });

    // Add markers to the map.
    for (const marker of markergeojson.features) {
        const el = document.createElement('div');
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        const iconUrl = marker.properties.iconUrl;

        el.className = 'marker';
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;

        const imgDiv = document.createElement('div');
        imgDiv.style.backgroundImage = `url(${iconUrl})`;
        imgDiv.style.width = '80%';
        imgDiv.style.height = '80%';
        el.appendChild(imgDiv);

        // Popup erstellen
        const popup = new mapboxgl.Popup({
            closeButton: false,
            closeOnClick: false
        }).setLngLat(marker.geometry.coordinates)
            .setHTML(`<div class="popup-content">${marker.properties.message}</div>`);

        let isMouseOverMarker = false;
        let isMouseOverPopup = false;

        function showPopup() {
            popup.addTo(map);

            // DOM-Element des Popups holen
            const popupEl = document.querySelector('.mapboxgl-popup');

            if (popupEl) {
                popupEl.addEventListener('mouseenter', () => {
                    isMouseOverPopup = true; // Maus ist über dem Popup
                });

                popupEl.addEventListener('mouseleave', () => {
                    isMouseOverPopup = false; // Maus verlässt das Popup
                    hidePopup(); // Popup nur entfernen, wenn Maus nicht mehr über Marker oder Popup ist
                });
            }
        }

        function hidePopup() {
            if (!isMouseOverMarker && !isMouseOverPopup) {
                popup.remove(); // Popup nur entfernen, wenn Maus weder über Marker noch über Popup ist
            }
        }

        // Event-Listener für den Marker
        el.addEventListener('mouseenter', () => {
            isMouseOverMarker = true; // Maus ist über dem Marker
            showPopup();
        });

        el.addEventListener('mouseleave', () => {
            isMouseOverMarker = false; // Maus verlässt den Marker
            hidePopup(); // Popup entfernen nur, wenn Maus auch nicht mehr über dem Popup ist
        });

        // Fügt den Marker der Map hinzu
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
    }
    //========== Ende von Icons ==========
    //==========================================================

    //==========================================================
    //==========Alle Gebäude in 3D==========
    const layers = map.getStyle().layers; // Holt sich alle layers, damit gleich die Symbol-Layer gefunden wird
    const labelLayerId = layers.find(
        (layer) => layer.type === 'symbol' && layer.layout['text-field']
    ).id;

    // Die Ebene „building“ im Mapbox-Streets-
    // Vektorkachelset enthält Gebäudedaten
    // mit Höheninformationen aus OpenStreetMap.
    map.addLayer(
        {
            'id': 'add-3d-buildings',
            'source': 'composite',
            'source-layer': 'building',
            'filter': ['==', 'extrude', 'true'],
            'filter': ['all',
                    ['!=', 'type', 'school'],
                    ['!=', 'building_id', 1203265826],
                    ['==', 'extrude', 'true']
                ],
            'type': 'fill-extrusion',
            'minzoom': 15,
            'paint': {
                'fill-extrusion-color': '#aaa',

                //Kleine Animation, wenn rangezoomed/rausgezoomed wird
                'fill-extrusion-height': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'height']
                ],

                //Kleine Animation, wenn rangezoomed/rausgezoomed wird
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

    // Layer, die die Hintergrundfarbe des animierten Weges anzeigt (in den Lücken)
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

    // Layer, die die Streifen anzeigt
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

    // Linienanimation basierend auf https://jsfiddle.net/2mws8y3q/
    // Ein Array mit gültigen Werten für line-dasharray,
    // das die Längen der abwechselnden Striche und Lücken
    // im Strichmuster festlegt
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
        // Aktualisiert line-dasharray mit dem nächsten Wert aus dashArraySequence.  
        // Der Divisor im Ausdruck `timestamp / 50` steuert die Animationsgeschwindigkeit.
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
        
        //Anfrage für nächsten Frame 
        requestAnimationFrame(animateDashArray);
    }

    // Start der Animation
    animateDashArray(0);
    //==========Ende von Wege animieren==========
    //==========================================================
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
    //==========Ende von Rest==========
    //==========================================================


    //==========================================================
    //==========Knöpfe Eventhandler und umsetzung==========
    
    // ---------------------------------------------------------
    //  2D und 3D Wechsel und Knöpfe dafür
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
        map.easeTo({ pitch: 0, zoom: 18.7, duration: 1000}); // Setzte Neigung auf 0 für 2D Ansicht und zoome raus

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

            if (map.getLayer('room_searched')) {
                map.setPaintProperty(`room_searched`, 'fill-extrusion-height', 0.01);
                map.setPaintProperty(`room_searched`, 'fill-extrusion-base', 0.01);
            }
                
        });

        //EtagenKopffarbe der Ausgewählten Etage richtig setzen
        levels.forEach((level) => {
            const floor_button = document.getElementById(`floor_${level}`);
            if(level == etage){
                floor_button.style.backgroundColor = "#d0d0d0";
            }
        });
        toggleFloor(); 
    }

    function setThreeD(){
        twoD = false;
        map.dragRotate.enable(); //erlaube Rotation
        map.touchZoomRotate.enableRotation(); //erlaube zoom
        map.easeTo({ pitch: 50, zoom: 18, duration: 1000}); // Setzte Neigung auf 50 Graf für 3D sicht und zoome rein
    
        waendeVerstecken();

        //Höhe auf auf 3d setzen
        levels.forEach((level) => {
            const offset = level*(-4);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-height', ['get', 'base_height']);
            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setLayoutProperty(`room_labels_floor_${level}`, 'text-offset', [0, offset]);

            if (map.getLayer('room_searched')) {
                map.setPaintProperty(`room_searched`, 'fill-extrusion-height', ['get', 'height']);
                map.setPaintProperty(`room_searched`, 'fill-extrusion-base', ['get', 'base_height']);
            }
        });
    }


// ---------------------------------------------------------
// Etagen Knöpfe und Wechsel
// ---------------------------------------------------------
// Etage-Knöpfe
levels.forEach((level) => {
    const floor_button = document.getElementById(`floor_${level}`);
    
    floor_button.addEventListener('click', () => {
        // Alle Knöpfe auf die ursprüngliche Farbe zurücksetzen
        levels.forEach((otherLevel) => {
            const other_button = document.getElementById(`floor_${otherLevel}`);
            // Entfernen der Tailwind-Klassen, die die Hintergrundfarbe beeinflussen
            other_button.classList.remove('bg-gray-300', 'bg-white');
            other_button.classList.add('bg-white'); // Setzt zurück auf Weiß
        });

        // Die Farbe des angeklickten Knopfes ändern
        if (etage == level) {
            if (!twoD) {
                alleEtagenAnzeigen();
            } else {
                // Im 2D-Modus wird der Knopf grau
                floor_button.classList.remove('bg-white');
                floor_button.classList.add('bg-gray-300');
            }
        } else {
            etage = level;
            floor_button.classList.remove('bg-white');
            floor_button.classList.add('bg-gray-300');
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
                if (map.getLayer('room_searched')) {
                    map.setPaintProperty(`room_searched`, 'fill-extrusion-height', 0.01);
                    map.setPaintProperty(`room_searched`, 'fill-extrusion-base', 0.01);
                }
            });
        }

        // Filter setzen
        levels.forEach((level) => {
            map.setLayoutProperty(`hall_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`room_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`stair_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
            map.setLayoutProperty(`floor_extrusion_${level}`, 'visibility', etage === level ? 'visible' : 'none');
        });

        const featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: 'room_searched' });
        if (featuresTemp.length > 0) {
            for (let i = 0; i < featuresTemp.length; i++) {
                let featureTemp = featuresTemp[i];
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
            for (let i = 0; i < 2; i++) {
                i;
                map.setLayoutProperty(`room_labels_floor_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`hall_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`room_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`stair_extrusion_${i}`, 'visibility', 'visible');
                map.setLayoutProperty(`floor_extrusion_${i}`, 'visibility', 'visible');
            }
        } 
        
    }

    // ---------------------------------------------------------
    //  Raum suchen Knopf
    // ---------------------------------------------------------

    function raumsuchen(gesuchterRaum) {
        let ersterBuchstabe = gesuchterRaum.charAt(0).toUpperCase();
        let zweiterBuchstabe = gesuchterRaum.charAt(1);
        let searchTerm;
        if (["A", "B", "C", "M", "V"].includes(ersterBuchstabe) && !isNaN(zweiterBuchstabe)) {
            searchTerm = String(gesuchterRaum).toUpperCase();
        } else {
            searchTerm = String(gesuchterRaum);
        }

        let roomFound = false;
        let etageChanged = false; // Variable zur Verfolgung des Etagenwechsels bei Raumsuche

        levels.forEach((level) => {
            const roomLayerId = `room_extrusion_${level}`;

            map.setPaintProperty(roomLayerId, 'fill-extrusion-opacity', 1);

            // Hier wird überprüft, ob die Ebene (roomLayerId) existiert
            if (map.getLayer(roomLayerId)) {
                const featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: roomLayerId });

                if (featuresTemp.length > 0) {

                    // Entfernt die "room_searched"-Ebene, falls sie existiert
                    if (map.getLayer('room_searched')) {
                        map.removeLayer('room_searched');
                    }
                    for (let i = 0; i < featuresTemp.length; i++) {
                        let featureTemp = featuresTemp[i];
                        if (featureTemp.properties.name == searchTerm) {

                            // Erstellt die zusätzliche Ebene für den gesuchten Raum
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


                            roomFound = true;

                            zoomToRoom(featureTemp);
                            
                            //=====Popup mit der raumnummer anzeigen=====
                            showRoomNamePopup(featureTemp)
                            break; 
                        }
                    
                    }

                    // Die Etage, in der der gesuchte Raum angezeigt wird (sobald der gesuchte Raum gefunden/erstellt wurde)
                    map.on('data', function (e) {
                        if (e.dataType === 'source' && e.sourceId === 'floorplan' && e.isSourceLoaded && roomFound) {

                            const featuresTemp = map.querySourceFeatures('floorplan', { sourceLayer: 'room_searched' });

                            if (featuresTemp && !etageChanged) {
                                etageChanged = true;
                                for (let i = 0; i < featuresTemp.length; i++) {
                                    let featureTemp = featuresTemp[i];
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
                                toggleFloor();

                                // Ändert die Knopffarben entsprechend der ausgewählten Etage
                                levels.forEach((otherLevel) => {
                                    const floor_button = document.getElementById(`floor_${otherLevel}`);
                                    floor_button.style.backgroundColor = otherLevel === etage ? "#d0d0d0" : "#ffffff";
                                });
                            }
                        }
                    });
                    if (map.getLayer('room_searched')) {
                        map.moveLayer('room_searched');
                    }
                    levels.forEach((level) => {
                        map.moveLayer(`room_labels_floor_${level}`);
                    })
                    return; 
                }
            }
        });

        if (!roomFound) {
            showToast('Raum nicht gefunden');
        }
    }

    // ---------------------------------------------------------
    //  Nachricht, wenn Raum nicht gefunden wird
    // ---------------------------------------------------------

    function showToast(message, bgColor = 'red') {
        let searchContainer = document.querySelector('.search-container');
        if (!searchContainer) return;

        let toast = document.createElement('div');
        toast.innerText = message;
        toast.className = 'toast';
        toast.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';

        // Position über dem Search-Container berechnen
        let rect = searchContainer.getBoundingClientRect();
        toast.style.left = `${rect.left + window.scrollX}px`;
        toast.style.top = `${rect.top + window.scrollY - 40}px`; // 40px über dem Container

        document.body.appendChild(toast);

        // Die Animation endet nach 3 Sekunden und entfernt das Toast automatisch
        toast.addEventListener('animationend', () => {
            toast.remove();
        });
    }

    //==========Ende von Knöpfen==========
    //==========================================================


    //==========================================================
    //==========Raum anklicken für mehr Infos==========
    // Hinzufügen eines Klick-Event-Listeners zur Karte
    map.on('click', function (evt) {
        const featuresTemp = map.queryRenderedFeatures(evt.point);
        if (featuresTemp) {
            for (let i = 0; i < featuresTemp.length; i++) {
                let featureTemp = featuresTemp[i];
                if (featureTemp.properties.indoor === 'room') {
                    name = featureTemp.properties.name;
                    if (map.getLayer('room_searched')) {
                        map.removeLayer('room_searched');
                        if (currentPopup) {
                            currentPopup.remove();
                        }  
                    } else{
                       raumsuchen(name);
                    }
                    return;
                }
            }
        }
    });
    
    function zoomToRoom(featureTemp){
       // Koordinate des Raumes holen
        const centerRoom = calculateMiddleofFeaure(featureTemp); ;
        map.flyTo({
            center: centerRoom,
            essential: true 
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
        //=====Popup mit der Raumnummer anzeigen=====
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
        // Begrenze die Rotation auf 0–360 Grad.
        // Teile den Timestamp durch 100, um die Rotation auf ca. 10 Grad pro Sekunde zu verlangsamen.
        map.rotateTo((timestamp / 100) % 360, { duration: 0 });
        // Fordere das nächste Frame der Animation an.
        requestAnimationFrame(rotateCamera);
    };
    //==========Ende von Raum anklicken==========
    //==========================================================


    // ---------------------------------------------------------
    //  Treppen GANZ anzeigen, auch wenn eine bestimmte Etage angezeigt wird
    // ---------------------------------------------------------

    function stair_filter(level) {
        let filter;
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




    // Erstelle ein Popup (aber es wird noch nicht angezeigt) -> Für die Icons zum Anzeigen der Beschreibung
    const popup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false
    });

    // Definiere die mouseovermarker-Funktion
    function mouseovermarker(marker) {
        // Kopiere die Koordinaten
        const coordinates = marker.geometry.coordinates.slice();
        const description = marker.properties.message;

        // Populiere das Popup und setze die Koordinaten
        popup.setLngLat(coordinates).setHTML(description).addTo(map);
        popup.setOffset(offset);
        map.options.scrollWheelZoom = false;
    }


    map.on('mouseenter', 'geojson-source', (e) => {
        
    });

    map.on('mouseleave', 'places', () => {
        map.getCanvas().style.cursor = '';
        
    });

    //==========Ende von Icons==========
    //==========================================================
</script>

</body>

