<?php snippet('header') ?>

<?php snippet('page-header') ?>


<div class="team-1" id="team-1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title"><?= $page->main_text() ?></h2>
                <h4 class="description">
                    <?= $page->adresse_s1()->blocks() ?>
                </h4>
                <h4 class="description">
                    <?= $page->adresse_s2()->blocks() ?>
                </h4>
                <h5 class="description">
                    <?= $page->anfahrt_text() ?>
                </h5>
            </div>
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h4 class="description">
                    <?= $page->anfahrt_text_s1()->blocks() ?>
                </h4>
            </div>
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h4 class="description">
                    <?= $page->anfahrt_text_s2()->blocks() ?>
                </h4>
            </div>
        <div class="row">
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


<div id="mapid" style="height: 400px;"></div>
<script>
    var mymap = L.map('mapid').setView([53.24111, 8.194932], 15);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    L.marker([53.2442, 8.1963]).addTo(mymap)
        .bindPopup("<b>Hauptgeb&auml;ude</b><br />Jahrg&auml;nge 7-13").openPopup();

    L.marker([53.24111, 8.194932]).addTo(mymap)
        .bindPopup("<b>Feldbreite</b><br />Jahrg&auml;nge 5-6.").openPopup();


    var popup = L.popup();

     /*     Diese Funktion ist momentan deaktiviert, da Sie unnötig ist
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);
    */
</script>


<?php snippet('footer') ?>