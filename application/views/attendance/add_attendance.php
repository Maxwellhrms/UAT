				<!-- Page Wrapper -->
				<div class="page-wrapper">

				    <!-- Page Content -->
				    <div class="content container-fluid">
					<!-- <div class="spinner-border text-muted"></div> -->
				        <!-- Page Header -->
				        <div class="page-header">
				            <div class="row align-items-center">
				                <div class="col">
				                    <h3 class="page-title">Add Attendance</h3>
				                    <ul class="breadcrumb">
				                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
				                        <li class="breadcrumb-item active">Add Attendance</li>
				                    </ul>
				                </div>
				            </div>
				        </div>
				        <!-- /Page Header -->

				        <!-- Search Filter -->
				        <form id="create_attendance_form">
				            <div class="row filter-row">	                				                
				                <div class="col-sm-6 col-md-3">
				                    <div class="form-group form-focus select-focus">
                                    <?php  //echo $next_year = (date('Y')+1); ?>
				                        <select class="select2 form-control" name="attendance_year" id="attendance_year">
				                            <option value="">Select Year</option>
				                            <?php
                                                $currently_year = date('Y');                                            
                                                $next_year = (date('Y')+1);                                            
                                                echo '<option value="' .$next_year. '">' . $next_year . '</option>';
                                                echo '<option value="' .$currently_year. '">' . $currently_year . '</option>';                                            
                                            ?>
				                        </select>
				                        <label class="focus-label">Year</label>
				                        <span class="formerror" id="attendance_year_error"></span>
				                    </div>
				                </div>
				                <div class="col-sm-6 col-md-3">
				                    <button type="submit" class="btn btn-success btn-block"> Create Tables </button>
				                </div>
				            </div>
				        </form>
				        <!-- Search Filter -->
						<div id="attendancecheck">   </div>
				        <div class="row staff-grid-row" id="displayfilterdata">


				        </div>
				    </div>
				    <!-- /Page Content -->
				</div>
				<!-- /Page Wrapper -->

				
                    <script src="<?php echo base_url() ?>assets/js/formsjs/add_attendance.js"></script>