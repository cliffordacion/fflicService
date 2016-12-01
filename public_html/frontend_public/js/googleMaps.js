// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function init() 
{
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 14.6549925, lng: 121.07098150000002}, // UP Main Libary Position
    streetViewControl: false,
    mapTypeControl: false,
    zoom: 15,
    mapTypeId: 'roadmap'
  });

  var currentAddress = null;
  // Check if allowed to detect current position of user
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      map.setCenter(pos);
      geocodeLatLng(position.coords.latitude, position.coords.longitude, function(err, results){
        setLatLangInputValue(pos['lat'], pos['lng']);
        initAutocomplete(map, results);
      });
    }, function() {
    });
  } else {
    initAutocomplete(map, infoWindow, currentAddress);
  }
}


function initAutocomplete(map, currentAddress) {
  // var infoWindow = new google.maps.InfoWindow({map: map});
  // Create the search box and link it to the UI element.
  var input = document.getElementById('bookingAddress');
  input.value = currentAddress;
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    lat = places[0].geometry.location.lat(); // Get Latitude
    lng = places[0].geometry.location.lng(); // Get Longitude

    setLatLangInputValue(lat, lng);

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));


      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}

function geocodeLatLng(lat, lng, callback)
{
  var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
  var geocoder = new google.maps.Geocoder;

  geocoder.geocode({'location': latlng}, function(results, status){
    if (status === 'OK' && results[0]) {
        callback(null, results[0].formatted_address);
    } else {
      callback(status, null);
      console.log('Geocoder failed due to: ' + status);
    }
  });
}

function setLatLangInputValue(lat, lng)
{
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
}