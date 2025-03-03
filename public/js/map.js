let mapElement = document.getElementById("map");
let centerMap = {
	lat: -25.95397805729807,
	lng: 32.59012929707339,
};
let map, marker, polyline;


function getMarkerPosistion(location) {

}

// Initialize and display the map
function initMap() {
	// Default coordinates (if location access is denied)
	var defaultLocation = {
		lat: 0,
		lng: 0,
	};

	// Create a map object and specify the DOM element for display.
	map = new google.maps.Map(mapElement, {
		zoom: 14,
		center: centerMap,
	});

	// Get user's location
	if (navigator.geolocation) {
		navigator.geolocation.watchPosition(
			function (position) {
				var userLocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude,
				};

				// Set map center to user's location
				map.setCenter(userLocation);
				console.log(userLocation);

				// Move existing marker to new position
				if (marker) {
					marker.setPosition(userLocation);
				} else {
					// Place a marker at user's location if it doesn't exist
					marker = new google.maps.Marker({
						position: userLocation,
						map: map,
						title: "Your Location",
					});
				}
			},
			function () {
				handleLocationError(true, map.getCenter());
			}
		);
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, map.getCenter());
	}
}

// Handle errors in geolocation
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	// Display an error message
	var errorMessage = browserHasGeolocation
		? "Error: The Geolocation service failed."
		: "Error: Your browser doesn't support geolocation.";
	alert(errorMessage);
}
