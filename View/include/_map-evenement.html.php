<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>


<style>
    .marker {
        background-image: url('asset/pngegg.png');
        background-size: cover;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
    }
</style>


<div id='<?php echo 'map' . $e['publication_id']; ?>' style='width: 400px; height: 300px;'></div>
<script>
    function init() {

        mapboxgl.accessToken = 'pk.eyJ1IjoicXVlbnRpbm1hcCIsImEiOiJjbDAyN3ppajcwMDNzM2pzMGtvbmhxbjF1In0.06Ug30wv9FZTWz6v2NfE5A';
        var map = new mapboxgl.Map({
            container: '<?php echo 'map' . $e['publication_id']; ?>',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 11
        });
        const geojson = <?php echo json_encode($geojson[$e['publication_id']],JSON_NUMERIC_CHECK); ?>


        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';

            // make a marker for each feature and add to the map
            new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);
            if(longMin){
                if(longMin > feature.geometry.coordinates[0]){
                    var longMin = feature.geometry.coordinates[0];
                }
                if(latMin > feature.geometry.coordinates[1]){
                    var latMin = feature.geometry.coordinates[1];
                }
                if(longMax < feature.geometry.coordinates[0]){
                    var longMax = feature.geometry.coordinates[0];
                }
                if(latMax < feature.geometry.coordinates[1]){
                    var latMax = feature.geometry.coordinates[1];
                }
            }else{
                var longMin = feature.geometry.coordinates[0]
                var latMin = feature.geometry.coordinates[1]

                var longMax = feature.geometry.coordinates[0]
                var latMax = feature.geometry.coordinates[1]
            }
        }

        map.fitBounds([
            [longMax + 0.2, latMax + 0.2], // northeastern corner of the bounds
            [longMin - 0.2, latMin - 0.2], // southwestern corner of the bounds
        ]);

    }

    window.addEventListener('DOMContentLoaded', init)
</script>