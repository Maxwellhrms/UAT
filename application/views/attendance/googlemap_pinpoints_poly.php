	
	<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg"> </script>	

	
		<!--<script  src="https://maps.googleapis.com/maps/api/js?key=<?php // $a=config('google_api_key'); echo $a[0];  ?>"> </script>	-->

			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Geo Location Attendance</h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
						
	<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="card mb-0">					
            <div class="card-header">
                <h4 class="card-title mb-0"> Employees Locations (<span style="color:red"><?php echo $locations['list'][0]['mxemp_emp_fname'].' - '.$locations['list'][0]['attendance_date'] ?></span>)</h4>
            </div>
            <div class="card-body">	
                <div class="table-responsive"  id="map" style="width: 100%; height: 400px;">
                </div>
            </div>
        </div>
    </div>
</div>

<br>


<table class="datatable table table-stripped mb-0"  id="dataTables-example">
<thead>
	<tr>
		<th>#</th>
		<th>Attendance Date</th>
		<th>Punch Time</th>
		<th>Employee Code</th>
		<th>Employee Name</th>
		<th>Company</th>
		<th>Division</th>
		<th>State</th>
		<th>Branch</th>
		<th>lattitue</th>
		<th>longitude</th>
		<th>location</th>
	</tr>
</thead>
<tbody>
    <?php $sno = 1; foreach($locations['list'] as $key => $val){ ?>
	<tr>
	    <td><?php echo $sno; ?></td>
	    <td><?php echo $val['attendance_date']; ?></td>
	    <td><?php echo $val['attendance_time']; ?></td>
	    <td><?php echo $val['employee_code']; ?></td>
	    <td><?php echo $val['mxemp_emp_fname']; ?></td>
	    <td><?php echo $val['mxcp_name']; ?></td>
	    <td><?php echo $val['mxd_name']; ?></td>
	    <td><?php echo $val['mxst_state']; ?></td>
	    <td><?php echo $val['mxb_name']; ?></td>
	    <td><?php echo $val['latitudes']; ?></td>
	    <td><?php echo $val['longitudes']; ?></td>
	    <td><?php echo $val['location']; ?></td>
	</tr>
	<?php $sno++; } ?>
</tbody>
</table>
</div>

				</div>

			</div>
			<!-- /Page Wrapper -->





<?php if(count($locations['lc'])>0){ ?>
<?php /*
<script type="text/javascript">

var locations = <?php  echo json_encode($locations['lc']) ?>;

var map = new google.maps.Map(document.getElementById('map'), {
zoom: 12,
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
        infowindow.setContent(locations[i][0]+"<br/><span style='color:red;font-size: 1.175em'>"+locations[i][4]+' '+locations[i][5]+"</span>");
        infowindow.open(map, marker);
        }
        })(marker, i));
    }
    
    // google.setOnLoadCallback(initialize);

    // var esi_company_id =1;

    
    // $('#esi_company_id').val(esi_company_id).trigger("change");


</script>
*/ ?>



    <script type="text/javascript">
    
        function InitializeMap() {
            var locations = <?php  echo json_encode($locations['lc']) ?>;
            var ltlng = [];
            ltlng.push(new google.maps.LatLng(locations[0][1], locations[0][2]));
           
            // var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
                zoom: 8,
                //center: latlng,
                center: ltlng[0],
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), myOptions);

            for (var i = 0; i < ltlng.length; i++) {
                var marker = new google.maps.Marker
                    (
                    {
                        // position: new google.maps.LatLng(-34.397, 150.644),
                        position: ltlng[i],
                        map: map,
                        title: 'Click me'
                    }
                    );
            }
            //***********ROUTING****************//

            //Intialize the Path Array
            var path = new google.maps.MVCArray();

            //Intialize the Direction Service
            var service = new google.maps.DirectionsService();

            //Set the Path Stroke Color
            var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });
            //Loop and Draw Path Route between the Points on MAP
            for (var i = 0; i < ltlng.length; i++)
            {
                if ((i + 1) < ltlng.length) {
                    var src = ltlng[i];
                    var des = ltlng[i + 1];
                    path.push(src);
                    poly.setPath(path);
                    service.route({
                        origin: src,
                        destination: des,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                                path.push(result.routes[0].overview_path[i]);
                            }
                        }
                    });
                }
            }

        }

        window.onload = InitializeMap;

    </script>









<?php } ?>