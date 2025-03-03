<div class="modal-content bg-light">

    <style>
        #map-history {
            height: 600px;
            width: 100%;
            padding: 0;
        }
    </style>
    <?php
    $cordinates = [];


    foreach (unserialize($history->location) as $key => $item) {
        $cordinates[] = $item;
        // if ($key == 100)
        //     break;
    }
    // echo count( $cordinates);
    ?>

    <div class="modal-body">
        <div class="card">
            <div class="card-body">

                <div id="map-history"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrmTR6p6INZFKzJ1V-Lvjwt6N2GMdT-_A&libraries=geometry"></script>
  <script>
    var map;
    var directionsService;
    var directionsDisplay;

    // Assuming you have a large array of coordinates in PHP
    var Array_Loc = <?php echo json_encode($cordinates, JSON_PRETTY_PRINT); ?>;

    // Initialize the map
    function initMap() {
        var myLatLng = Array_Loc[Array_Loc.length - 1];

        map = new google.maps.Map(document.getElementById('map-history'), {
            zoom: 14,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Ultima posição',
            icon: {
                url: "<?= base_url() ?>public/img/taxi.png",
                scaledSize: new google.maps.Size(48, 48)
            },
        });

        var marker = new google.maps.Marker({
            position: Array_Loc[0],
            map: map,
            title: 'Posição inicial',
            icon: {
                url: "<?= base_url() ?>public/img/taxi.png",
                scaledSize: new google.maps.Size(48, 48)
            },
        });

        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true // This will suppress the markers
        });

        // Call the showRoute function when the map is ready
        showRoute();
    }

    function showRoute() {
        // Split the waypoints into manageable chunks
        var maxWaypointsPerRequest = 23; // You can have up to 23 waypoints per request if not optimizing
        var waypointsChunks = [];

        for (var i = 0; i < Array_Loc.length; i += maxWaypointsPerRequest) {
            waypointsChunks.push(Array_Loc.slice(i, i + maxWaypointsPerRequest));
        }

        // Loop through each chunk and create a route for each
        for (var j = 0; j < waypointsChunks.length - 1; j++) {
            createRoute(waypointsChunks[j], waypointsChunks[j + 1][0]);
        }
    }

    function createRoute(chunk, nextStart) {
        var start = chunk[0]; // Start location
        var end = nextStart; // End location of the next chunk
        var waypoints = [];

        // Add waypoints to the array
        for (var i = 1; i < chunk.length; i++) {
            waypoints.push({
                location: chunk[i],
                stopover: true
            });
        }

        var request = {
            origin: start,
            destination: end,
            waypoints: waypoints,
            travelMode: 'DRIVING'
        };

        console.log(waypoints.length)

        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsDisplay.setDirections(result);

                // Create a new directions display for each chunk
                var render = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: true,
                    preserveViewport: true
                });
                render.setDirections(result);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
</script>