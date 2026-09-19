
<!--https://stackoverflow.com/questions/40626180/multiple-marker-on-googlemaps-from-php-and-mysql-->
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg"> </script>	



<?php // echo '<pre>'; print_r($list);  ?>
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="card mb-0">					
            <div class="card-header">
                <h4 class="card-title mb-0">Employees Location</h4>
            </div>
            <div class="card-body">	
                <div class="table-responsive">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<?php
/*


<!-- Page Wrapper -->
<div class="page-wrapper">

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
</div>

*/
?>
        
        
<script type="text/javascript">


// var locations = [
//     ['Somajiguda',17.423412,78.4616385,4],
//     ['Secunderabad',17.4426187,78.4616385,3],
//     ['surya towers',17.4426156,78.4893747,2],
//     ['Kalasiguda',17.4426156,78.4893747,1]
// ];
 
   var locations = <?php  echo json_encode($locations) ?>;

var map = new google.maps.Map(document.getElementById('map'), {
zoom: 15,
center: new google.maps.LatLng(locations[0][1], locations[0][2]),
mapTypeId: google.maps.MapTypeId.ROADMAP
});

var infowindow = new google.maps.InfoWindow();

var marker, i;
    for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
        });
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        }
        })(marker, i));
    }

</script>

    <!--    </div>-->
    <!--</div>-->
    <!-- /Page Content -->
<!--</div>-->
<!-- /Page Wrapper -->


