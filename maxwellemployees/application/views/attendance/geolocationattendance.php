<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
     <!-- Page Header -->
     <div class="page-header">
      <div class="row">
       <div class="col-sm-12">
        <h3 class="page-title"> <?php echo $title ;?>  </h3>
        <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
         <li class="breadcrumb-item active"> <?php echo $title ;?>  </li>
     </ul>
 </div>
</div>
</div>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJYtjpYsINOHFzVyjv-sejN6tIHkoiHtg"> </script>
<div class="card-body"> 
    <div class="table-responsive"  id="map" style="width: 100%; height: 400px;">
    </div>
</div>
<hr>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

/* HEADER */
.mxgeo-route-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    flex-wrap:wrap;
    gap:15px;
    margin-bottom:30px;
}

.mxgeo-route-title{
    font-size:20px;
    font-weight:700;
    margin-bottom:4px;
}

.mxgeo-route-subtitle{
    font-size:14px;
    color:#6c757d;
}

.mxgeo-route-count{
    background:#f7b731;
    color:#fff;
    padding:10px 20px;
    border-radius:10px;
    font-weight:700;
    font-size:16px;
}

/* SCROLL */
.mxgeo-route-scroll{
    overflow-x:auto;
    overflow-y:visible;
    padding-bottom:120px;
}

.mxgeo-route-scroll::-webkit-scrollbar{
    height:8px;
}

.mxgeo-route-scroll::-webkit-scrollbar-thumb{
    background:#adb5bd;
    border-radius:20px;
}

/* WRAPPER */
.mxgeo-route-wrapper{
    display:flex;
    align-items:flex-start;
    min-width:max-content;
    position:relative;

    padding:60px 60px 40px;
}

/* MAIN LINE */
.mxgeo-route-line{
    position:absolute;

    top:98px;

    left:60px;
    right:60px;

    height:5px;

    background:linear-gradient(90deg,#0d6efd,#20c997);

    border-radius:30px;

    z-index:1;
}

/* ITEM */
.mxgeo-route-item{
    width:220px;
    position:relative;
    text-align:center;
    flex-shrink:0;
    z-index:5;
}

/* PIN */
.mxgeo-route-pin{
    width:78px;
    height:78px;

    background:#fff;
    border:4px solid #0d6efd;
    border-radius:50%;

    margin:auto;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:28px;
    color:#0d6efd;

    position:relative;
    z-index:10;

    box-shadow:0 8px 20px rgba(13,110,253,0.18);

    transition:0.3s;
}

.mxgeo-route-pin:hover{
    transform:scale(1.05);
}

/* HOME */
.mxgeo-route-pin-start{
    border-color:#198754;
    color:#198754;
}

/* END */
.mxgeo-route-pin-end{
    border-color:#dc3545;
    color:#dc3545;
}

/* LABEL */
.mxgeo-route-label{
    margin-top:14px;
    font-size:16px;
    font-weight:700;
}

/* CONNECTOR */
.mxgeo-route-connector{
    width:160px;
    position:relative;
    flex-shrink:0;
}

/* DISTANCE */
.mxgeo-route-distance{
    position:absolute;

    /* FIXED PERFECTLY */
    top:78px;

    left:50%;
    transform:translateX(-50%);

    background:#0d6efd;
    color:#fff;

    padding:8px 18px;

    border-radius:40px;

    min-width:120px;

    font-size:13px;
    font-weight:700;

    text-align:center;

    white-space:nowrap;

    box-shadow:0 8px 18px rgba(13,110,253,0.25);

    z-index:20;
}

/* POPUP */
.mxgeo-route-popup{
    position:absolute;

    top:170px;

    left:50%;
    transform:translateX(-50%);

    width:280px;

    background:#fff;
    border-radius:18px;

    padding:18px;

    border:1px solid #e9ecef;

    box-shadow:0 15px 35px rgba(0,0,0,0.15);

    text-align:left;

    opacity:0;
    visibility:hidden;

    transition:0.3s ease;

    z-index:9999;
}

/* POPUP ARROW */
.mxgeo-route-popup::before{
    content:'';

    position:absolute;

    left:50%;
    top:-10px;

    width:20px;
    height:20px;

    background:#fff;

    border-left:1px solid #e9ecef;
    border-top:1px solid #e9ecef;

    transform:translateX(-50%) rotate(45deg);
}

.mxgeo-route-item:hover .mxgeo-route-popup{
    opacity:1;
    visibility:visible;
}

/* POPUP CONTENT */
.mxgeo-route-popup-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:15px;
}

.mxgeo-route-popup-row{
    margin-bottom:10px;
    font-size:14px;
    line-height:1.5;
}

.mxgeo-route-popup-row:last-child{
    margin-bottom:0;
}

</style>
<?php

$totalDistance = 0;

foreach($locations['list'] as $i => $row){

    if($i < (count($locations['list']) - 1)){

        $latt1 = $locations['list'][$i]['latitudes'];
        $long1 = $locations['list'][$i]['longitudes'];

        $latt2 = $locations['list'][$i+1]['latitudes'];
        $long2 = $locations['list'][$i+1]['longitudes'];

        $distance = distance($latt1, $long1, $latt2, $long2, "K");

        $totalDistance += $distance;
    }
}

?>

<?php

$excelData = array();

foreach ($locations['list'] as $i => $row) {

    // Distance from previous location
    if ($i == 0) {
        $distance = 0;
    } else {

        $distance = distance(
            $locations['list'][$i - 1]['latitudes'],
            $locations['list'][$i - 1]['longitudes'],
            $row['latitudes'],
            $row['longitudes'],
            "K"
        );
    }

    $excelData[] = array(
        'employee_name'   => $row['mxemp_emp_fname'],
        'employee_code'   => $row['employee_code'],
        'attendance_date' => $row['attendance_date'],
        'punch_time'      => $row['attendance_time'],
        'type'            => $row['entry_type'],
        'company'         => $row['mxcp_name'],
        'division'        => $row['mxd_name'],
        'state'           => $row['mxst_state'],
        'branch'          => $row['mxb_name'],
        'latitude'        => $row['latitudes'],
        'longitude'       => $row['longitudes'],
        'location'        => $row['location'],
        'is_location'     => $row['islocation'],
        'distance'        => number_format($distance, 2) . ' Km'
    );
}

$excelJson = urlencode(json_encode($excelData));

?>
<div class="d-flex gap-2 flex-wrap">

    <div class="mxgeo-route-count">
        Total Records : <?php echo count($locations['list']); ?>
    </div>

    <div class="mxgeo-route-count" style="background:#0d6efd;">
        Total Distance : <?php echo number_format($totalDistance,2); ?> KM
    </div>

<a href="<?php echo base_url('Employee/exporttoexcel'); ?>?name=<?php echo rawurlencode('Geolocation Attendance'); ?>&excelarraydata=<?php echo $excelJson; ?>&callmodel=0"
   class="btn btn-success">

    <i class="fa fa-file-excel-o"></i>
    Download Excel

</a>

</div>
<!-- SCROLL -->
<div class="mxgeo-route-scroll">

    <div class="mxgeo-route-wrapper">

        <!-- MAIN LINE -->
        <div class="mxgeo-route-line"></div>

        <?php foreach($locations['list'] as $i => $row){ ?>

            <?php

            $iconClass = 'fa-location-dot';
            $pinClass  = '';

            // HOME
            if(strpos($row['location'], $row['mxemp_emp_present_postalcode']) !== false){

                $iconClass = 'fa-house';
                $pinClass  = 'mxgeo-route-pin-start';
            }

            // LAST
            if($i == (count($locations['list']) - 1)){

                $iconClass = 'fa-flag-checkered';
                $pinClass  = 'mxgeo-route-pin-end';
            }

            ?>

            <!-- ITEM -->
            <div class="mxgeo-route-item">

                <!-- PIN -->
                <div class="mxgeo-route-pin <?php echo $pinClass; ?>">
                    <i class="fa-solid <?php echo $iconClass; ?>"></i>
                </div>

                <!-- LABEL -->
                <div class="mxgeo-route-label">
                    <?php echo $row['entry_type']; ?>
                </div>

                <!-- POPUP -->
                <div class="mxgeo-route-popup">

                    <div class="mxgeo-route-popup-title">
                        <?php echo $row['mxemp_emp_fname']; ?>
                    </div>

                    <div class="mxgeo-route-popup-row">
                        <strong>Date :</strong>
                        <?php echo $row['attendance_date']; ?>
                    </div>

                    <div class="mxgeo-route-popup-row">
                        <strong>Time :</strong>
                        <?php echo $row['attendance_time']; ?>
                    </div>

                    <div class="mxgeo-route-popup-row">
                        <strong>Location :</strong><br>
                        <?php echo $row['location']; ?>
                    </div>

                    <div class="mxgeo-route-popup-row">
                        <strong>Latitude :</strong>
                        <?php echo $row['latitudes']; ?>
                    </div>

                    <div class="mxgeo-route-popup-row">
                        <strong>Longitude :</strong>
                        <?php echo $row['longitudes']; ?>
                    </div>

                </div>

            </div>

            <!-- CONNECTOR -->
            <?php if($i < (count($locations['list']) - 1)){ ?>

                <?php

                $latt1 = $locations['list'][$i]['latitudes'];
                $long1 = $locations['list'][$i]['longitudes'];

                $latt2 = $locations['list'][$i+1]['latitudes'];
                $long2 = $locations['list'][$i+1]['longitudes'];

                $distance = distance($latt1, $long1, $latt2, $long2, "K");

                ?>

                <div class="mxgeo-route-connector">

                    <div class="mxgeo-route-distance">
                        <?php echo number_format($distance,2); ?> KM
                    </div>

                </div>

            <?php } ?>

        <?php } ?>

    </div>

</div>
<hr>
<div class="container-fluid">

    <div class="row">

        <?php $sno = 1; for($i = 0; $i < count($locations['list']); $i++){ ?>

            <div class="col-md-4 mb-4">

                <div class="card shadow-lg border-0 rounded-4">

                    <!-- Header -->
                    <div class="card-header bg-primary text-white rounded-top-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h5 class="mb-0">
                                    <?php echo $locations['list'][$i]['mxemp_emp_fname']; ?>
                                </h5>

                                <small>
                                    Employee Code :
                                    <?php echo $locations['list'][$i]['employee_code']; ?>
                                </small>
                            </div>

                            <!-- Toggle Button -->
                            <button class="btn btn-light btn-sm"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#employeeCard<?php echo $i; ?>"
                                    aria-expanded="false">

                                Open / Close

                            </button>

                        </div>

                    </div>

                    <!-- Collapse Start -->
                    <div class="collapse" id="employeeCard<?php echo $i; ?>">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-6 mb-3">
                                    <strong>Attendance Date</strong><br>
                                    <?php echo $locations['list'][$i]['attendance_date']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Punch Time</strong><br>
                                    <?php echo $locations['list'][$i]['attendance_time']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Type</strong><br>
                                    <?php echo $locations['list'][$i]['entry_type']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Company</strong><br>
                                    <?php echo $locations['list'][$i]['mxcp_name']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Division</strong><br>
                                    <?php echo $locations['list'][$i]['mxd_name']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>State</strong><br>
                                    <?php echo $locations['list'][$i]['mxst_state']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Branch</strong><br>
                                    <?php echo $locations['list'][$i]['mxb_name']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Latitude</strong><br>
                                    <?php echo $locations['list'][$i]['latitudes']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Longitude</strong><br>
                                    <?php echo $locations['list'][$i]['longitudes']; ?>
                                </div>

                                <div class="col-12 mb-3">
                                    <strong>Location</strong><br>
                                    <?php echo $locations['list'][$i]['location']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Is Location</strong><br>
                                    <?php echo $locations['list'][$i]['islocation']; ?>
                                </div>

                                <div class="col-6 mb-3">
                                    <strong>Distance</strong><br>

                                    <?php
                                    if($i == 0){

                                        $latt1 = $locations['list'][$i]['latitudes'];
                                        $long1 = $locations['list'][$i]['longitudes'];

                                        $latt2 = '';
                                        $long2 = '';

                                    }else{

                                        $latt1 = $locations['list'][$i-1]['latitudes'];
                                        $long1 = $locations['list'][$i-1]['longitudes'];

                                        $latt2 = $locations['list'][$i]['latitudes'];
                                        $long2 = $locations['list'][$i]['longitudes'];
                                    }

                                    echo distance($latt1, $long1, $latt2, $long2, "K") . " Km";
                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Collapse End -->

                </div>

            </div>

        <?php $sno++; } ?>

    </div>

</div>


<?php
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if ((($lat1 == $lat2) && ($lon1 == $lon2)) || (empty($lat2)) || (empty($lon2))) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return round(($miles * 1.609344),2);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}
if(count($locations['lc'])>0){ ?>

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
<?php } ?>