<!--https://jsfiddle.net/gh/get/library/pure/googlemaps/js-samples/tree/master/dist/samples/polyline-simple/jsfiddle-->
<!--https://developers.google.com/maps/documentation/javascript/examples/polyline-simple-->


<!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg"> </script>-->

<!--need to test-->
<!--https://stackoverflow.com/questions/62591044/google-maps-route-with-multiple-distance-markers-and-clustering-->
<!--https://jsfiddle.net/geocodezip/jym4ax70/1-->
<!--need to test-->

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg&callback=initMap&v=weekly"
      defer
    ></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


<!-- Page Wrapper -->
<!--<div class="page-wrapper">-->

    <!-- Page Content -->
    <div class="content container-fluid">
	<!-- <div class="spinner-border text-muted"></div> -->
        <!-- Page Header -->
<!--        <div class="page-header">-->
<!--            <div class="row align-items-center">-->
<!--                <div class="col">-->
<!--                    <h3 class="page-title">Geo Location Attendance</h3>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- /Page Header -->
        <div class="row staff-grid-row">
        
        <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
        </div>
        
        




<?php /*


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
        
 */  ?>     
        
<script type="text/javascript">

 var locations = <?php echo json_encode($locations) ?>;

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: new google.maps.LatLng(locations[0][1], locations[0][2]),
    mapTypeId: google.maps.MapTypeId.ROADMAP

    // zoom: 10,
    // center: { lat: 21.7679, lng: 78.8718 },
    // mapTypeId: "terrain",
  });
  
   const flightPlanCoordinates = <?php  echo json_encode($locations1) ?>;

//   const flightPlanCoordinates = [
//     { lat: 17.423412, lng: 78.4616385 },
//     { lat: 17.4426187, lng: 78.4616385 },
//     { lat: 17.4426156, lng: 78.4893747 },
//     { lat: 17.4426156, lng: 78.4893747 },
//   ];
  
  
  
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
</script>


    <!--    </div>-->
    <!--</div>-->
    <!-- /Page Content -->
<!--</div>-->
<!-- /Page Wrapper -->


