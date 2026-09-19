<?php $months = date('m'); ?>
                <div class="page-wrapper">
                    <div class="content container-fluid">
                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h3 class="page-title">Employee Info</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Employee Detailed Info</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Page Header -->

                    <form id="commonform" >
                        <div class="row filter-row">

                            <div class="col-sm-6 col-md-3"> 
                                <div class="form-group form-focus select-focus">
                                    <select class="select select2" style="width: 100%" name="selyear" id="selyear"> 
                                        <option value="">Select Year</option>
                                            <?php 
                                        $currently_selected = date('Y'); 
                                        $earliest_year = 2020; 
                                        $latest_year = date('Y'); 
                                        foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                            if($i == $currently_selected ){
                                                $sel ="selected"; }else{ $sel = "";   }
                                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                        // echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <label class="focus-label">Select Year</label>
                                </div>
                                <span class="formerror" id="attndyearerror"></span>
                            </div>
                            <div class="col-sm-6 col-md-3">  
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="empid" id="empid">
                                    <label class="focus-label">Employee Code</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">  
                                    <button id="searchemployeefilterdata"  class="btn btn-success btn-block"   > Search </button>  
                            </div>
                        </div>
                    </form>
                    <div id="empdetaillist"> </div>
                </div>
            </div>
            

     <script type="text/javascript">
                        
    $("form#commonform").submit(function(e) {    
        e.preventDefault(); 
        // alert("k");
        var selyear = $("#selyear").val();   
        var empid = $("#empid").val();
        var mainurl = baseurl+'developertools/employeedetails_list';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'selyear': selyear,'empid': empid },
            success: function (data) {
                // console.log(data);
                // alert(data);
                $("#empdetaillist").html(data);           
            }
        });          
    });
    
    </script>

						