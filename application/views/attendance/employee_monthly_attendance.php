<?php $months = date('m'); ?>
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"> <?php echo $titlehead; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active"> Create Monthly/Yearly Attendance</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
                    <form id="commonform" >
                        <div class="row filter-row">

                            <div class="col-sm-6 col-md-3"> 
                                <div class="form-group form-focus select-focus">
                                    <select class="select select2" style="width: 100%" name="attndyear" id="attndyear"> 
                                        <option value="">Select Year</option>
                                        <?php 
                                        $currently_selected = date('Y'); 
                                        $earliest_year = 2020; 
                                        $latest_year = date('Y'); 
                                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                            if($i == $currently_selected ){
                                                $sel ="selected"; }else{ $sel = "";   }
                                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                        } ?>
                                    </select>
                                    <label class="focus-label">Select Year</label>
                                </div>
                                <span class="formerror" id="attndyearerror"></span>
                            </div>

                            <div class="col-sm-6 col-md-3"> 
                                <div class="form-group form-focus select-focus">
                                <select class="select select2" style="width: 100%" name="attndmonth" id="attndmonth"> 
                                        <option value="">Select Month</option>
                                        <?php 
                                            //$months = date('m');
                                            date_default_timezone_set('Asia/Kolkata');
                                            for($i=1; $i<=12; $i++){ 
                                                $month = date('F', mktime(0, 0, 0, $i, 10)); 
                                                if($i == $months ){ $sel ="";//selected";
                                                }else{ $sel = ""; } ?>
                                                <option value="<?php echo $i ?>" <?php echo $sel; ?> ><?php echo $month; ?></option>
                                            <?php } ?>
                                    </select>
                                    <label class="focus-label">Select Month</label>
                                </div>
                                <span class="formerror" id="attndmontherror"></span>	
                            </div>

                            <div class="col-sm-6 col-md-3">  
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="attndempid" id="attndempid">
                                    <label class="focus-label">Employee Code</label>
                                </div>
                                <span class="formerror" id="attndempiderror"></span>
                            </div>
                            <div class="col-sm-6 col-md-3">  
                                <button id="searchemployeefilterdata"  class="btn btn-success btn-block"> Search </button>  
                            </div>     
                        </div>
                    </form>
                    <!-- /Search Filter -->
                    <div id="changeemplist"> </div>
            </div>
        </div>

<script type="text/javascript">

$("form#commonform").submit(function(e) {
    e.preventDefault();  
        var mnth = $("#attndmonth").val();
        // if (mnth == 0 || mnth == "") {
        //     $("#attndmonth").focus();
        //     $('#attndmontherror').html("Please Select Month");
        //     return false;
        // } else {
        //     $('#attndmontherror').html("");
        // }

        var year = $("#attndyear").val();
        if (year == 0 || year == "") {
            $("#attndyear").focus();
            $('#attndyearerror').html("Please Select Year");
            return false;
        } else {
            $('#attndyearerror').html("");
        }
        
        var empid = $("#attndempid").val();
        if(empid == ''){
            $("#attndempid").focus();
            $('#attndempiderror').html("Please Enter Employee Code ");
            return false;
        } else {
            $('#attndempiderror').html("");        
        }
      
        var mainurl = baseurl+'Attendance_controller/attendancemonthly_list';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'month': mnth,'year':year,'employeeid':empid },
            success: function (data) {
            //  console.log(data);
            //  alert(data);
               $("#changeemplist").html(data);
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5', footer: true }
                    ],
                });
            }
        });
});    

</script>	
