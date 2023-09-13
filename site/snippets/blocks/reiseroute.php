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
      height: 600px;
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

    const geojson = {
    'type': 'FeatureCollection',
    'features': <?= json_encode($features, JSON_PRETTY_PRINT) ?>
    };
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
    let etage = 0;

    map.setStyle('mapbox://styles/mapbox/outdoors-v12');

    // ---------------------------------------------------------
    //  Karte Laden
    // ---------------------------------------------------------
    map.on('load', () => {
        map.addSource('floorplan', {
            'type': 'geojson',
            'data': 'http://homepage/content/allgemeines/anfahrt/bereinigte_geojson_datei.geojson'
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
                    'fill-extrusion-color': ['get', 'color'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 0.5
                }
            });
        }
        /*
        addLayerForFloor('-1');
        addLayerForFloor('0');
        addLayerForFloor('1');
        addLayerForFloor('2');
        */

        function addLayerForHalls(level) {
            map.addLayer({
                'id': `hall_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['!=', 'indoor', 'level'],
                    ['==', 'level', level], 
                    ['any',
                        ['==', 'room', 'lobby'],
                        ['==', 'indoor', 'corridor'],
                        ['==', 'name', 'B020']
                    ]
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'color'],
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
            map.addLayer({
                'id': `stair_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['!=', 'indoor', 'level'],
                    ['==', 'level', level], 
                    ['==', 'room', 'stairs'],
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'color'],
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'base_height'],
                    'fill-extrusion-opacity': 0.4
                }
            });
        }
        addLayerForStairs('-1');
        addLayerForStairs('0');
        addLayerForStairs('1');
        addLayerForStairs('2');

        function addLayerForRooms(level) {
            map.addLayer({
                'id': `room_extrusion_${level}`,
                'type': 'fill-extrusion',
                'source': 'floorplan',
                'filter': ['all',
                    ['!=', 'indoor', 'level'],
                    ['==', 'level', level], 
                    ['!=', 'room', 'lobby'],
                    ['!=', 'room', 'stairs'],
                    ['!=', 'indoor', 'corridor'],
                    ['!=', 'name', 'B020']
                ],
                'paint': {
                    'fill-extrusion-color': ['get', 'color'],
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
                'text-field': ['get', 'name'], 
                'text-size': 12,
                'text-anchor': 'center',
            },
            'paint': {
                'text-color': 'white' // Farbe des Textlabels
            }
            });
        }
        //Raumnummern hinzufügen
        addLayerRoomnumbers('-1');
        addLayerRoomnumbers('0');
        addLayerRoomnumbers('1');
        addLayerRoomnumbers('2');

        raumnummernVerstecken();
    });

    function raumnummernVerstecken(){
            // Raumnummern für alle Etagen verstecken
            levels.forEach((level) => {
                map.setLayoutProperty(`room_labels_floor_${level}`, 'visibility', 'none');
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
        map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
        map.easeTo({ pitch: 0, zoom: 17 }); // Set pitch to 0 for 2D view and zoom out

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
        });
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
        });
    });


    // Etage-Knöpfe
    //Knopfdruck erkennen
    levels.forEach((level) => {
        document.getElementById(`floor_${level}`).addEventListener('click', () => {
            toggleFloor(level); 
        });
    });

    //Richtige Etage anzeigen
    function toggleFloor(floor) {
        raumnummernVerstecken();
        etage = floor;
        // Raumnummern für die ausgewählte Etage anzeigen
        if(twoD){
            map.setLayoutProperty(`room_labels_floor_${etage}`, 'visibility', 'visible');
        }

        // Filter setzen
        levels.forEach((level) => {
            map.setLayoutProperty(`floor_extrusion_${level}`, 'visibility', floor === level ? 'visible' : 'none');
            map.setLayoutProperty(`hall_extrusion_${level}`, 'visibility', floor === level ? 'visible' : 'none');
            map.setLayoutProperty(`room_extrusion_${level}`, 'visibility', floor === level ? 'visible' : 'none');
            map.setLayoutProperty(`stair_extrusion_${level}`, 'visibility', floor === level ? 'visible' : 'none');
        });
    }

    // Suche nach Raum beim Klicken auf die Schaltfläche
    document.getElementById('search-button').addEventListener('click', function () {
        const searchTerm = document.getElementById('search-input').value;

        // Iteriere durch die Ebenen (levels)
        levels.forEach((level) => {
            const roomLayerId = `room_extrusion_${level}`;

            // Überprüfe, ob die Ebene (roomLayerId) existiert
            if (map.getLayer(roomLayerId)) {

                // Setze die Deckkraft und Farbe für alle Räume
                map.setPaintProperty(roomLayerId, 'fill-extrusion-opacity', 0.3);
                map.setPaintProperty(roomLayerId, 'fill-extrusion-color', 'gray');

                // Erstelle eine zusätzliche Ebene für den gesuchten Raum
                const searchedRoomLayerId = `${roomLayerId}_searched`;
                if (map.getLayer(searchedRoomLayerId)) {
                    map.removeLayer(searchedRoomLayerId);
                }
                map.addLayer({
                    'id': searchedRoomLayerId,
                    'type': 'fill-extrusion',
                    'source': "floorplan",
                    'layout': {},
                    'paint': {
                        'fill-extrusion-color': 'red',
                        'fill-extrusion-height': ['get', 'height'],
                        'fill-extrusion-base': ['get', 'base_height'],
                        'fill-extrusion-opacity': 1.0
                    },
                    'filter': ['==', ['get', 'name'], searchTerm]
                }, roomLayerId);
            }
        });
    });




</script>

</body>

