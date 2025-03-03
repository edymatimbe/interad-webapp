<script>
    // let mapElement = document.getElementById("map");
    // let centerMap = {
    //     lat: -25.95397805729807,
    //     lng: 32.59012929707339
    // };
    // let map, marker, polyline;

    // // Initialize and display the map
    // function initMap() {
    //     // Default coordinates (if location access is denied)
    //     var defaultLocation = {
    //         lat: 0,
    //         lng: 0
    //     };

    //     // Create a map object and specify the DOM element for display.
    //     map = new google.maps.Map(document.getElementById("map"), {
    //         zoom: 14,
    //         center: defaultLocation,
    //     });

    //     // Get user's location
    //     if (navigator.geolocation) {
    //         navigator.geolocation.watchPosition(
    //             function(position) {
    //                 var userLocation = {
    //                     lat: position.coords.latitude,
    //                     lng: position.coords.longitude,
    //                 };

    //                 // Set map center to user's location
    //                 map.setCenter(userLocation);
    //                 console.log(userLocation);

    //                 // Move existing marker to new position
    //                 if (marker) {
    //                     marker.setPosition(userLocation);
    //                 } else {
    //                     // Place a marker at user's location if it doesn't exist
    //                     marker = new google.maps.Marker({
    //                         position: userLocation,
    //                         map: map,
    //                         title: "Your Location",
    //                     });
    //                 }
    //             },
    //             function() {
    //                 handleLocationError(true, map.getCenter());
    //             }
    //         );
    //     } else {
    //         // Browser doesn't support Geolocation
    //         handleLocationError(false, map.getCenter());
    //     }
    // }

    // // Handle errors in geolocation
    // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    //     // Display an error message
    //     var errorMessage = browserHasGeolocation ?
    //         "Error: The Geolocation service failed." :
    //         "Error: Your browser doesn't support geolocation.";
    //     alert(errorMessage);
    // }

    let mapElement = document.getElementById("map");
    let centerMap = {
        lat: -25.95397805729807,
        lng: 32.59012929707339
    };
    let map, marker, polyline;

    // Coordenadas dos pontos
    let points = [{
            lat: -25.95397805729807,
            lng: 32.59012929707339
        },
        {
            lat: -25.954132,
            lng: 32.590639
        },
        // Adicione mais pontos conforme necessário
    ];

    // Inicializar e exibir o mapa
    function initMap() {
        // Coordenadas padrão (se o acesso à localização for negado)
        var defaultLocation = {
            lat: 0,
            lng: 0
        };

        // Criar um objeto de mapa e especificar o elemento DOM para exibição.
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: defaultLocation,
        });

        // Obter a localização do usuário
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    // Definir o centro do mapa para a localização do usuário
                    map.setCenter(userLocation);

                    // Mover o marcador existente para a nova posição
                    if (marker) {
                        marker.setPosition(userLocation);
                        console.log(userLocation);
                    } else {
                        // Colocar um marcador na localização do usuário se ele não existir
                        marker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "Your Location",
                        });
                    }

                    // Desenhar a linha
                    drawPolyline();
                },
                function() {
                    handleLocationError(true, map.getCenter());
                }
            );
        } else {
            // O navegador não suporta Geolocation
            handleLocationError(false, map.getCenter());
        }
    }

    // Desenhar a polyline conectando os pontos
    function drawPolyline() {
        // Remover a polyline existente, se houver
        if (polyline) {
            polyline.setMap(null);
        }

        // Criar uma nova polyline com os pontos
        polyline = new google.maps.Polyline({
            path: points,
            geodesic: true,
            strokeColor: "#FF0000", // Cor vermelha
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        // Definir a polyline no mapa
        polyline.setMap(map);
    }

    // Lidar com erros na geolocalização
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        // Exibir uma mensagem de erro
        var errorMessage = browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation.";
        alert(errorMessage);
    }
</script>