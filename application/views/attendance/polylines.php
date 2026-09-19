<!--https://jsfiddle.net/gh/get/library/pure/googlemaps/js-samples/tree/master/dist/samples/polyline-simple/jsfiddle-->
<!--https://developers.google.com/maps/documentation/javascript/examples/polyline-simple-->


<!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg"> </script>-->

<!--need to test-->
<!--https://stackoverflow.com/questions/62591044/google-maps-route-with-multiple-distance-markers-and-clustering-->
<!--https://jsfiddle.net/geocodezip/jym4ax70/1-->
<!--need to test-->

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg&callback=initMap&v=weekly"
      defer></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
	<!-- <div class="spinner-border text-muted"></div> -->
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Geo Location Attendance</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row staff-grid-row">
        
        <div id="map" style="width: 100%; height: 400px;"></div>
        
        
        <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
        <!-- Replace the value of the key parameter with your own API key. -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap">
        </script>

        
        
<script type="text/javascript">
var geocoder;
var map;
var marker;
var gmarkers = [];
var markerCluster;
var METERS_TO_MILES = 0.000621371192;
var walked = (Math.round(550 * 1609.344));

var jMarkers = [
  ['Craig Smith', 16],
  ['Bob Smith', 36],
  ['John Jones', 76],
  ['John Jones', 75],
  ['Brett Jones', 123],
  ['John Peterson', 145],
  ['John Smith', 175]
];


//ICON
var iconImage = {

  url: 'https://maps.google.com/mapfiles/ms/micons/red.png',
  size: new google.maps.Size(25, 34), //MARKER SIZE (WxH)
  origin: new google.maps.Point(0, 0), //MARKER ORIGIN
  anchor: new google.maps.Point(16, 34) //MARKER ANCHOR
};

//INFO WINDOW
var infowindow = new google.maps.InfoWindow({
  size: new google.maps.Size(150, 50)
});

//CREATE MARKER
function createMarker(latlng, label, html) {
  var contentString = '<b>' + label + '</b><br>' + html;
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    icon: iconImage,
    title: label,
    zIndex: Math.round(latlng.lat() * -100000) << 5
  });

  marker.myname = label;
  gmarkers.push(marker);

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(contentString);
    infowindow.open(map, marker);
  });
  return marker;
}

function initialize() {
  var latlng = new google.maps.LatLng(51.555967, -0.279736);
  var myOptions = {
    zoom: 9,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  map = new google.maps.Map(document.getElementById("map"), myOptions);

  // Add a marker clusterer to manage the markers.
  markerCluster = new MarkerClusterer(map, [], {
    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
  });

  var rendererOptions = {
    map: map,
    suppressMarkers: true,
  };

  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

  //waypoints
  var point1 = new google.maps.LatLng(48.858469, 2.294353);

  var wps = [{
    location: point1
  }];

  //START
  var org = new google.maps.LatLng(51.513872, -0.098329);

  //FINISH
  var dest = new google.maps.LatLng(45.465361, 9.191464);

  var request = {
    origin: org,
    destination: dest,
    waypoints: wps,
    travelMode: google.maps.DirectionsTravelMode.WALKING,
  };

  directionsService = new google.maps.DirectionsService();
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      //SHOW ROUTE
      directionsDisplay.setDirections(response);

      //COPY POLY FROM DIRECTION SERVICE
      var polyline = new google.maps.Polyline({
        path: [],
        strokeColor: '#FF0000',
        strokeWeight: 3
      });

      var bounds = new google.maps.LatLngBounds();
      var lengthMeters = 0;
      var legs = response.routes[0].legs;
      for (i = 0; i < legs.length; i++) {
        var steps = legs[i].steps;
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {

            if (lengthMeters <= walked) {
              polyline.getPath().push(nextSegment[k]);
              if (polyline.getPath().getLength() > 1) {
                var lastPt = polyline.getPath().getLength() - 1;
                lengthMeters += google.maps.geometry.spherical.computeDistanceBetween(polyline.getPath().getAt(lastPt - 1), polyline.getPath().getAt(lastPt));
              }
            }
            bounds.extend(nextSegment[k]);

          }
        }
      }

      polyline.setMap(map);

      var i;
      for (i = 0; i < jMarkers.length; i++) {
        walked = 0;
        walked = (Math.round(jMarkers[i][1] * 1609.344));
        markerCluster.addMarker(createMarker(polyline.GetPointAtDistance(walked), jMarkers[i][0], (Math.round(walked * METERS_TO_MILES * 10) / 10) + ' miles'));
      }


      //ADD MARKER TO NEW POLYLINE AT 'X' DISTANCE
      //      createMarker(polyline.GetPointAtDistance(walked), "You are here", (Math.round(walked * METERS_TO_MILES * 10) / 10) + ' miles');


      //GET THE TOTAL DISTANCE
      var distance = 0;
      //var METERS_TO_MILES = 0.000621371192;
      for (i = 0; i < response.routes[0].legs.length; i++) {
        //FOR EACH LEG GET THE DISTANCE AND ADD IT TO THE TOTAL
        distance += parseFloat(response.routes[0].legs[i].distance.value);
      }

    } else if (status == google.maps.DirectionsStatus.MAX_WAYPOINTS_EXCEEDED) {
      alert('Max waypoints exceeded');
    } else {
      alert('failed to get directions');
    }
  });
};
window.onload = function() {
  initialize();
};


// === first support methods that don't (yet) exist in v3
google.maps.LatLng.prototype.distanceFrom = function(newLatLng) {
  var EarthRadiusMeters = 6378137.0; // meters
  var lat1 = this.lat();
  var lon1 = this.lng();
  var lat2 = newLatLng.lat();
  var lon2 = newLatLng.lng();
  var dLat = (lat2 - lat1) * Math.PI / 180;
  var dLon = (lon2 - lon1) * Math.PI / 180;
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = EarthRadiusMeters * c;
  return d;
}

google.maps.LatLng.prototype.latRadians = function() {
  return this.lat() * Math.PI / 180;
}

google.maps.LatLng.prototype.lngRadians = function() {
  return this.lng() * Math.PI / 180;
}

// === A method which returns the length of a path in metres ===
google.maps.Polygon.prototype.Distance = function() {
  var dist = 0;
  for (var i = 1; i < this.getPath().getLength(); i++) {
    dist += this.getPath().getAt(i).distanceFrom(this.getPath().getAt(i - 1));
  }
  return dist;
}

// === A method which returns a GLatLng of a point a given distance along the path ===
// === Returns null if the path is shorter than the specified distance ===
google.maps.Polygon.prototype.GetPointAtDistance = function(metres) {
  // some awkward special cases
  if (metres == 0) return this.getPath().getAt(0);
  if (metres < 0) return null;
  if (this.getPath().getLength() < 2) return null;
  var dist = 0;
  var olddist = 0;
  for (var i = 1;
    (i < this.getPath().getLength() && dist < metres); i++) {
    olddist = dist;
    dist += this.getPath().getAt(i).distanceFrom(this.getPath().getAt(i - 1));
  }
  if (dist < metres) {
    return null;
  }
  var p1 = this.getPath().getAt(i - 2);
  var p2 = this.getPath().getAt(i - 1);
  var m = (metres - olddist) / (dist - olddist);
  return new google.maps.LatLng(p1.lat() + (p2.lat() - p1.lat()) * m, p1.lng() + (p2.lng() - p1.lng()) * m);
}

// === A method which returns an array of GLatLngs of points a given interval along the path ===
google.maps.Polygon.prototype.GetPointsAtDistance = function(metres) {
  var next = metres;
  var points = [];
  // some awkward special cases
  if (metres <= 0) return points;
  var dist = 0;
  var olddist = 0;
  for (var i = 1;
    (i < this.getPath().getLength()); i++) {
    olddist = dist;
    dist += this.getPath().getAt(i).distanceFrom(this.getPath().getAt(i - 1));
    while (dist > next) {
      var p1 = this.getPath().getAt(i - 1);
      var p2 = this.getPath().getAt(i);
      var m = (next - olddist) / (dist - olddist);
      points.push(new google.maps.LatLng(p1.lat() + (p2.lat() - p1.lat()) * m, p1.lng() + (p2.lng() - p1.lng()) * m));
      next += metres;
    }
  }
  return points;
}

// === A method which returns the Vertex number at a given distance along the path ===
// === Returns null if the path is shorter than the specified distance ===
google.maps.Polygon.prototype.GetIndexAtDistance = function(metres) {
  // some awkward special cases
  if (metres == 0) return this.getPath().getAt(0);
  if (metres < 0) return null;
  var dist = 0;
  var olddist = 0;
  for (var i = 1;
    (i < this.getPath().getLength() && dist < metres); i++) {
    olddist = dist;
    dist += this.getPath().getAt(i).distanceFrom(this.getPath().getAt(i - 1));
  }
  if (dist < metres) {
    return null;
  }
  return i;
}

// === Copy all the above functions to GPolyline ===
google.maps.Polyline.prototype.Distance = google.maps.Polygon.prototype.Distance;
google.maps.Polyline.prototype.GetPointAtDistance = google.maps.Polygon.prototype.GetPointAtDistance;
google.maps.Polyline.prototype.GetPointsAtDistance = google.maps.Polygon.prototype.GetPointsAtDistance;
google.maps.Polyline.prototype.GetIndexAtDistance = google.maps.Polygon.prototype.GetIndexAtDistance;



/*
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 3,
    center: { lat: 21.7679, lng: 78.8718 },
    mapTypeId: "terrain",
  });
  
  
  const flightPlanCoordinates = [
    { lat: 17.423412, lng: 78.4616385 },
    { lat: 17.4426187, lng: 78.4616385 },
    { lat: 17.4426156, lng: 78.4893747 },
    { lat: 17.4426156, lng: 78.4893747 },
  ];
  
  const flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
  });

  flightPath.setMap(map);
}

window.initMap = initMap;

*/


</script>


        </div>
    </div>
    <!-- /Page Content -->
</div>
<!-- /Page Wrapper -->


