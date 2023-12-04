<?php snippet('header') ?>
<?php snippet('page-header') ?>

<?php snippet('sidebar') ?>
<div class="teamfarbe1 teamfarbe2 teamfarbe3 teamfarbe4 teamfarbe5 teamfarbe6 teamfarbe7"> </div>


<div class="container">




<h1>Karte</h1>

      <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
      <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />

      <style>
        body {
          margin: 0;
          padding: 0;
        }

        #map {
          height: 400px;

        }
      </style>

      <style>
        .marker {
          display: block;
          border: none;
          border-radius: 50%;
          cursor: pointer;
          padding: 0;
        }
      </style>


      <div id="map"></div>
      <button class="btn btn-primary mt-2 mb-5" id="fit">Auf Punkte reinzoomen</button>

      <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoia2dzcmFzdGVkZSIsImEiOiJja3hnZ2dnaXczb293MnBvNWxhdWxkdnYxIn0.kHEpdxzycw6ZVg719GpdLA';

        const geojson = {
          'type': 'FeatureCollection',
          'features': [


            <?php foreach ($page->children() as $unterprojekt) : ?>
              <?php foreach ($unterprojekt->text()->toBlocks() as $projektblock) : ?>
                <?php if ($projektblock->type() === "reiseroute") : ?> 
                  <?php foreach ($projektblock->reise()->toBlocks() as $reise) : ?>
                    <?php if ($reise->type() === "koordinate") : ?>
                    {
                      'type': 'Feature',
                      'properties': {
                        'message': 'TODO',
                        'iconSize': [50, 50],

                        //TODO wenn hier kein Bild hochgeladen wurde muss ein Default Bild genommen werden
                        'iconUrl': '<?= $unterprojekt->teamlogo()->toFile()->url() ?>'
                      },
                      'geometry': {
                        'type': 'Point',
                        'coordinates': [<?= $reise->breitengrad()->toText() ?>, <?= $reise->laengengrad()->toText() ?>]
                      }
                    },
                    <?php endif ?>
                  <?php endforeach ?>
                <?php endif ?>
              <?php endforeach ?>
            <?php endforeach ?>


          ]
        };

        const map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: [8.2, 53.24],
          zoom: 13
        });

        /*
         * Hier werden die äußeren Ecken berechnet. Der Code fehlt leider noch :-)
         * Daher wird erstmal auf Niederachsen gezoomt, das soll reichen
         * 
         * Der API dafür ist hier dokumentiert: 
         *   https://docs.mapbox.com/mapbox-gl-js/api/map/#map
         * 
         * Man muss an alle Marker drankommen, und die sind schon im Speicher:
         *   for (const marker of geojson.features) {
         */
        document.getElementById('fit').addEventListener('click', () => {
          // das ist circa Niedersachsen
          west = 53;
          east = 54;
          north = 8;
          south = 7;

          var first_iteration = true;
          for (const marker of geojson.features) {

            loc_latitude = marker.geometry.coordinates[0]; //bei Asien circa 120
            loc_longitude = marker.geometry.coordinates[1]; //bei Asien um die 30 

            if (first_iteration) {
              //Im ersten Durchgang werden die werte auf die erste Koordinate gesetzt
              //Damit ist die Karte schonmal in der richtigen Region
              north = loc_latitude;
              south = loc_latitude;
              east = loc_longitude;
              west = loc_longitude;

              first_iteration = false;
            }

            // Jetzt wird geschaut, ob es Koordinaten gibt, die weiter nördlich/südlich/östlich/westlich
            // liegen. Wenn das der Fall ist, werden neue Minima gesetzt
            if (loc_latitude > north) {
              north = loc_latitude;
            } else if (loc_latitude < south) {
              south = loc_latitude;
            }

            if (loc_longitude < west) {
              west = loc_longitude;
            } else if (loc_longitude > east) {
              east = loc_longitude;
            }


          }


          // const southWest = new mapboxgl.LngLat(-73.9876, 40.7661);
          // const northEast = new mapboxgl.LngLat(-73.9397, 40.8002);
          // const boundingBox = new mapboxgl.LngLatBounds(southWest, northEast);


          // Mit dem Code im Anschluss werden die Ecken rausgefunden. TODO
          // Der Code an sich ist korrekt, muss nur zum Laufen gebracht werden.
          map.fitBounds([
            [south, west], // Süd-West-Ecke der Ansicht
            [north, east] // Nord-Ost-Ecke der Ansicht
          ], {
            // Abstände um die Zoom-Box definieren, damit die Punkte definitiv im Bild sind
            // https://docs.mapbox.com/mapbox-gl-js/api/properties/#paddingoptions
            padding: {
              top: 100,
              bottom: 100,
              left: 100,
              right: 100
            }
          });



        });







        // Add markers to the map.
        for (const marker of geojson.features) {
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

          el.addEventListener('click', () => {
            window.alert(marker.properties.message);
          });

          // Add markers to the map.
          new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
        }

        // Zoom-Knöpfe anzeigen
        // https://docs.mapbox.com/mapbox-gl-js/example/navigation/
        map.addControl(new mapboxgl.NavigationControl());

        // Vollbild ermöglichen
        map.addControl(new mapboxgl.FullscreenControl());


        // Create a popup, but don't add it to the map yet.
        const popup = new mapboxgl.Popup({
          closeButton: false,
          closeOnClick: false
        });

        map.on('mouseenter', 'geojson.features', (e) => {
          // Change the cursor style as a UI indicator.
          map.getCanvas().style.cursor = 'pointer';

          // Copy coordinates array.
          const coordinates = e.features[0].geometry.coordinates.slice();
          const description = e.features[0].properties.description;

          // Ensure that if the map is zoomed out such that multiple
          // copies of the feature are visible, the popup appears
          // over the copy being pointed to.
          while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
          }

          // Populate the popup and set its coordinates
          // based on the feature found.
          popup.setLngLat(coordinates).setHTML(description).addTo(map);
        });

        map.on('mouseleave', 'places', () => {
          map.getCanvas().style.cursor = '';
          popup.remove();
        });
      </script>



      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 gx-4">





        <?php foreach ($page->children() as $unterprojekt) : ?>
          <a href="<?= $unterprojekt->url() ?>">
            <div class="card <?= $unterprojekt->teamfarbe() ?>  bs-teamfarbe1 mb-3" style="max-width: 18rem;">

              <img src="<?= $unterprojekt->teamlogo()->toFile()->url() ?>" class="card-img-top" alt="Teamlogo">
              <div class="card-body">
                <h3 class="card-title mb-3"><?= $unterprojekt->title() ?></h3>
                <h3 class="card-title"><?= $unterprojekt->heading() ?></h3>
              </div>
            </div>

          </a>

        <?php endforeach; ?>


      </div>
</div>

<?php snippet('footer') ?>