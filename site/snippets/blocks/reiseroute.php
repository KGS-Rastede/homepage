<!-- ========================================================= -->
<!-- Hole Koordinaten aus speicher-->
<!-- ========================================================= -->
<?php 
  $features = [];
  $koordinaten = [];

  $features = snippet('koordinaten-extrahieren', [
    'koordinaten' => $koordinaten, 
    'features' => $features, 
    'block' => $block ]
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
      overflow: hidden;
    }
    #map-container {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: scroll;
    }
    #map {
      height: 800px;
    }
    #perspective-buttons {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
    }
    #floor-buttons {
        position: absolute;
        top: 130px;
        right: 10px;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .circle {
        border-radius: 50%; /* Ändere den Border-Radius auf 50% für Kreisform */
        width: 50px; 
        height: 50px; 
        display: flex;
        justify-content: center;
        align-items: center;
    }
    button {
        margin: 5px;
        padding: 10px 20px;
        background-color: #0078FF;
        color: #FFFFFF;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 18px; 
    }
    #floor-label {
        font-weight: bold;
        text-align: center;
        margin-bottom: 5px;
    }
    .marker {
      display: block;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      padding: 0;
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
<input type="text" id="search-input" placeholder="Raum suchen">
<button id="search-button">Suchen</button>
</div>

<!-- ========================================================= -->
<!-- Skripte -->
<!-- ========================================================= -->
<div id="map"></div>
<button class="btn btn-primary mt-2 mb-5" id="fit">Auf Punkte reinzoomen</button>


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
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [8.1964, 53.2442],
        zoom: 18,
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



        twoD = false;

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
            map.addLayer({
            'id': `room_labels_floor_${level}`,
            'type': 'symbol',
            'source': 'floorplan',
            'filter': ['==', 'level', level],
            'layout': {
                'text-allow-overlap': true,  // The icon will be visible even if it collides with other previously drawn symbols.
                'text-ignore-placement': true, 
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
                'text-anchor': 'center',
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
                'line-width': 1
                }
            });
        }
        addWalls('-1');
        addWalls('0');
        addWalls('1');
        addWalls('2');

        raumnummernVerstecken();

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
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        const iconUrl = marker.properties.iconUrl;
        el.className = 'marker';
        el.style.backgroundImage = `url(${iconUrl})`;
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;
        el.style.backgroundSize = '100%';

        //el.addEventListener('click', () => {
        //    window.alert(marker.properties.message);
        //});

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
    });
    

    function raumnummernVerstecken(){
            // Raumnummern für alle Etagen verstecken
            levels.forEach((level) => {
                map.setLayoutProperty(`room_labels_floor_${level}`, 'visibility', 'none');
                map.setLayoutProperty(`room_walls_${level}`, 'visibility', 'none');
            });
    }


    // ---------------------------------------------------------
    //  Knöpfe Eventhandler
    // ---------------------------------------------------------

    // 2D button
    document.getElementById('toggle-2d').addEventListener('click', () => {
        //map.dragRotate.disable(); //disable rotation
        //map.touchZoomRotate.disableRotation(); //disable rotation
        twoD = true;
        map.dragRotate.disable();
        map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
        map.easeTo({ pitch: 0, zoom: 19 }); // Set pitch to 0 for 2D view and zoom out

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

                map.setPaintProperty(`room_searched`, 'fill-extrusion-height', 0.01);
                map.setPaintProperty(`room_searched`, 'fill-extrusion-base', 0.01);
        });

        toggleFloor(); 

    });

    // 3D button
    document.getElementById('toggle-3d').addEventListener('click', () => {
        twoD = false;
        map.dragRotate.enable(); //enable rotation
        map.touchZoomRotate.enableRotation(); //enable rotation
        map.easeTo({ pitch: 50, zoom: 18 }); // Set pitch to 50 degrees for 3D view and zoom in
    
        raumnummernVerstecken();

        //Höhe auf auf 3d setzen
        levels.forEach((level) => {
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`floor_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-height', ['get', 'base_height']);
            map.setPaintProperty(`hall_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`room_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`stair_extrusion_${level}`, 'fill-extrusion-base', ['get', 'base_height']);

            map.setPaintProperty(`room_searched`, 'fill-extrusion-height', ['get', 'height']);
            map.setPaintProperty(`room_searched`, 'fill-extrusion-base', ['get', 'base_height']);
        });
    });


    // Etage-Knöpfe
    //Knopfdruck erkennen
    levels.forEach((level) => {
        var floor_button = document.getElementById(`floor_${level}`);
        
        floor_button.addEventListener('click', () => {
            // Alle Knöpfe auf die ursprüngliche Farbe zurücksetzen
            levels.forEach((otherLevel) => {
                var other_button = document.getElementById(`floor_${otherLevel}`);
                other_button.style.backgroundColor = "#0078FF"; // Ihre ursprüngliche Farbe hier
            });
            
            // Die Farbe des angeklickten Knopfes ändern
            etage = level;
            floor_button.style.backgroundColor = "#0011DC";
            toggleFloor(); 
        });
    });


    //Richtige Etage anzeigen
    function toggleFloor() {
        raumnummernVerstecken();
        // Raumnummern für die ausgewählte Etage anzeigen
        if(twoD){
            map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
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

    // Raumsuche Knopf
    document.getElementById('search-button').addEventListener('click', function (evt) {
        gesuchterRaum = document.getElementById('search-input').value;
        raumsuchen(gesuchterRaum)
    });

    function raumsuchen(searchTerm) {
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
                    roomFound = true;

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
                                    floor_button.style.backgroundColor = otherLevel === etage ? "#0011DC" : "#0078FF";
                                });
                            }
                        }
                    });

                    return; // Beende die Schleife, wenn der Raum gefunden wurde
                }
            }
        });

        if (!roomFound) {
            alert('Raum nicht gefunden.');
        }
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
                    raumsuchen(name)
                    return;
                }
            }
        }
    });

    let currentPopup = null;

    function showRoomNamePopup(featureTemp){
        //=====Popup mit der raumnummer anzeigen=====
        // Berechne die Bounding Box des Features, um den Mittelpunkt zu finden
        const coordinates = featureTemp.geometry.type === 'Polygon'
            ? featureTemp.geometry.coordinates[0] // Für einfache Polygone
            : featureTemp.geometry.coordinates.flat(); // Für MultiPolygone

        // Konvertiere die Koordinaten in mapboxgl.LngLat Objekte
        const lngLats = coordinates.map(coord => new mapboxgl.LngLat(coord[0], coord[1]));

        // Berechne den Mittelpunkt
        const bounds = new mapboxgl.LngLatBounds();
        lngLats.forEach(lngLat => bounds.extend(lngLat));
        const center = bounds.getCenter();

        if (currentPopup) {
            currentPopup.remove();
        }  
        // Setze das Popup an den Mittelpunkt des Features und verschiebe es nach oben
        currentPopup = new mapboxgl.Popup({
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
                        'message': '<?= $block->name() ?>',
                        'iconSize': [50, 50],

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


// Create a popup, but don't add it to the map yet.
const popup = new mapboxgl.Popup({
    closeButton: false,
    closeOnClick: false
});

// Definiere die mouseovermarker-Funktion
function mouseovermarker(marker) {
    // Kopiere die Koordinaten
    const coordinates = marker.geometry.coordinates.slice();
    const description = marker.properties.message;

    // Stelle sicher, dass die Popups über dem richtigen Feature erscheinen
    while (Math.abs(map.getCenter().lng - coordinates[0]) > 180) {
        coordinates[0] += map.getCenter().lng > coordinates[0] ? 360 : -360;
    }

    // Populiere das Popup und setze die Koordinaten
    popup.setLngLat(coordinates).setHTML(description).addTo(map);
    console.log(`Die Koordinate ist '${coordinates}' und die Beschreibung: ${description}.`);
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

