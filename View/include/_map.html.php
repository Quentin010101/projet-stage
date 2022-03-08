
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


<div id='map' style='width: 400px; height: 300px;'></div>


<script>
    function init(){

        mapboxgl.accessToken = 'pk.eyJ1IjoicXVlbnRpbm1hcCIsImEiOiJjbDAyN3ppajcwMDNzM2pzMGtvbmhxbjF1In0.06Ug30wv9FZTWz6v2NfE5A';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [<?php echo htmlspecialchars($organisation['gps_lat']); ?>, <?php echo htmlspecialchars($organisation['gps_long']); ?>],
            zoom: 11
        });
    
        const geojson = {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [<?php echo htmlspecialchars($organisation['gps_lat']); ?>, <?php echo htmlspecialchars($organisation['gps_long']); ?>]
                },
                properties: {
                    title: 'Mapbox',
                    description: '<?php echo htmlspecialchars($organisation['nom']); ?>'
                }
            } ]
        };
    
        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';
    
            // make a marker for each feature and add to the map
            new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);

        }

    }

    window.addEventListener('DOMContentLoaded', init)
    
</script>