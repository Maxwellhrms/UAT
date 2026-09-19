<?php
$cron_jobs = $cronslist;

$grouped_crons = [];

foreach ($cron_jobs as $cron) {
    $grouped_crons[$cron['cron_category']][] = $cron;
}

function explain_cron_timing($cron_time){
    switch($cron_time){
        case '0 * * * *':
            return 'Runs every hour at 0th minute.<br>Example: 01:00 AM, 02:00 AM, 03:00 AM';
        case '30 0,10,14 * * *':
            return 'Runs daily 3 times.<br>12:30 AM, 10:30 AM, 02:30 PM';
        case '0 0,5 * * *':
            return 'Runs daily 2 times.<br>12:00 AM and 05:00 AM';
        case '0 19,20,22 * * *':
            return 'Runs daily in evening hours.<br>07:00 PM, 08:00 PM and 10:00 PM';
        case '45 9,10 * * *':
            return 'Runs daily before grace time validation.<br>09:45 AM and 10:45 AM';
        case '0 0 * * *':
            return 'Runs once daily at 12:00 AM midnight';
        case '0 0 1 * *':
            return 'Runs monthly on 1st day at 12:00 AM';
        case '10 1 1 * *':
            return 'Runs monthly on the 1st day at 01:10 AM.<br>Used for Short Leave (SHRT) processing and balance updates.';
        case '20 1 8 4 *':
            return 'Runs yearly on April 8th at 01:20 AM.<br>Used for year-end leave processing, leave balance carry-forward, annual leave resets, and other fiscal year closing activities.';
        case '20 2 1 * *':
            return 'Runs monthly on the 1st day at 02:20 AM.<br>Used for Optional Holiday (OH) allocation and balance updates.';
        case '10 2 1 * *':
            return 'Runs monthly on the 1st day at 02:10 AM.<br>Used for Optional Compensatory Holiday (OCH) processing and balance updates.';
        default:
            return 'Cron schedule configured.';
    }
}
?>

<!-- PAGE WRAPPER -->

<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Crons List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Crons List Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h6 class="text-muted">Total Cron Jobs</h6>
                        <h3><?php echo count($cron_jobs); ?></h3>
                    </div>
                </div>
            </div>


            <div class="col-md-3 mb-3">
                <div class="card border-success">
                    <div class="card-body">
                        <h6 class="text-muted">Active Jobs</h6>
                        <h3 class="text-success">
                            <?php
                            echo count(array_filter($cron_jobs,function($row){
                                return $row['cron_status'] == 'Active';
                            }));
                            ?>
                        </h3>
                    </div>
                </div>
            </div>


            <div class="col-md-3 mb-3">
                <div class="card border-danger">
                    <div class="card-body">
                        <h6 class="text-muted">Inactive Jobs</h6>

                        <h3 class="text-danger">
                            <?php
                            echo count(array_filter($cron_jobs,function($row){
                                return $row['cron_status'] == 'Inactive';
                            }));
                            ?>
                        </h3>
                    </div>
                </div>
            </div>


            <div class="col-md-3 mb-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h6 class="text-muted">Categories</h6>
                        <h3><?php echo count($grouped_crons); ?></h3>
                    </div>
                </div>
            </div>
        </div>


        <!-- ACCORDION -->

        <div class="accordion" id="cronAccordion">
            <?php
            $i = 0;
            foreach($grouped_crons as $category => $jobs){
                $collapse_id = 'collapse_'.$i;
                if($category == 'Attendance'){
                    $btn_class = 'btn-primary';
                    $icon = 'fa-user-clock';
                }
                elseif($category == 'Leave'){
                    $btn_class = 'btn-success';
                    $icon = 'fa-calendar-alt';
                }
                elseif($category == 'Notification'){
                    $btn_class = 'btn-warning';
                    $icon = 'fa-bell';
                }
                elseif($category == 'Transfer'){
                    $btn_class = 'btn-info';
                    $icon = 'fa-exchange-alt';
                }
                elseif($category == 'Resignation'){
                    $btn_class = 'btn-danger';
                    $icon = 'fa-user-times';
                }
                else{
                    $btn_class = 'btn-dark';
                    $icon = 'fa-cogs';
                }
            ?>

            <div class="card mb-3">
                <div class="card-header p-0">
                    <button class="btn <?php echo $btn_class; ?> btn-block text-left p-3" type="button" data-toggle="collapse" data-target="#<?php echo $collapse_id; ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas <?php echo $icon; ?> mr-2"></i>
                                <?php echo $category; ?> Cron Jobs
                            </div>
                            <span class="badge badge-light">
                                <?php echo count($jobs); ?> Jobs
                            </span>
                        </div>
                    </button>
                </div>


                <div id="<?php echo $collapse_id; ?>" class="collapse <?php echo ($i == 0) ? 'show' : ''; ?>" data-parent="#cronAccordion">
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($jobs as $cron){ ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border">
                                    <div class="card-body">
                                        <!-- TITLE -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0"><?php echo $cron['cron_name']; ?></h5>
                                            <?php if($cron['cron_status'] == 'Active'){ ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Inactive</span>
                                            <?php } ?>
                                        </div>


                                        <!-- DESCRIPTION -->
                                        <p class="text-muted"><?php echo $cron['cron_description']; ?></p>
                                        <!-- TABLE -->

                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th width="35%"> Cron Timing</th>
                                                <td>
                                                    <strong><?php echo $cron['cron_timing']; ?></strong>
                                                    <hr class="mt-2 mb-2">
                                                    <small class="text-muted">
                                                        <?php
                                                        echo explain_cron_timing(
                                                            $cron['cron_timing']
                                                        );
                                                        ?>
                                                    </small>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th>Frequency</th>
                                                <td>
                                                    <span class="badge badge-info">
                                                        <?php echo ucfirst($cron['cron_frequency']); ?>
                                                    </span>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th>Cron URL</th>
                                                <td><code><?php echo $cron['cron_url']; ?></code></td>
                                            </tr>
                                            <tr>
                                                <th>Server Command</th>
                                                <td style="word-break: break-all;"><small><?php echo $cron['cron_server_url']; ?></small></td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>
                                                    <?php
                                                    if (!empty($cron['latest_run_times'])) {

                                                        $dates = explode(',', $cron['latest_run_times']);

                                                        $formatted_dates = array_map(function($date){
                                                            return date('d-M-Y h:i A', strtotime(trim($date)));
                                                        }, $dates);

                                                        echo implode('<br>', $formatted_dates);

                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>


                                        <!-- BUTTONS -->

                                        <div class="mt-3">
                                            <button class="btn <?php echo $btn_class; ?> btn-sm" data-toggle="modal" data-target="#triggerCronModal<?php echo $cron['cron_id']; ?>">
                                                <i class="fas fa-play"></i>
                                                Trigger Now
                                            </button>
                                            <!-- <button class="btn btn-outline-dark btn-sm"><i class="fas fa-history"></i> Logs</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- MODAL -->

                            <div class="modal fade" id="triggerCronModal<?php echo $cron['cron_id']; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Trigger Cron Job</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>

                                        <!-- FORM -->
                                        <form class="runCronForm" id="runCronForm<?php echo $cron['cron_id']; ?>">
                                            <input type="hidden" name="cron_id" value="<?php echo $cron['cron_id']; ?>">
                                            <input type="hidden" name="cron_name" value="<?php echo $cron['cron_name']; ?>">
                                            <input type="hidden" name="cron_url" value="<?php echo $cron['cron_url']; ?>">

                                            <div class="modal-body">
                                                <div class="alert alert-info">
                                                    <strong>Cron Name :</strong>
                                                    <?php echo $cron['cron_name']; ?>
                                                    <br>
                                                    <strong>Category :</strong>
                                                    <?php echo $cron['cron_category']; ?>
                                                    <br>
                                                    <strong>Schedule :</strong>
                                                    <?php echo $cron['cron_timing']; ?>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Employee Code</label>
                                                            <input type="text" name="employeeid" id="employeeid" class="form-control" placeholder="Enter Employee Code">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> Date</label>
                                                            <input type="text" name="attendance" id="attendance" class="form-control datetimepicker">
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="forceRun<?php #echo $cron['cron_id']; ?>" name="force_run" value="1">
                                                        <label class="custom-control-label" for="forceRun<?php #echo $cron['cron_id']; ?>">Force Run This Cron</label>
                                                    </div>
                                                </div> -->


                                                <div class="form-group">
                                                    <label>Server Command</label>
                                                    <textarea class="form-control" rows="3" readonly><?php echo $cron['cron_server_url']; ?></textarea>
                                                </div>

                                                <!-- RESPONSE -->
                                                <div class="cronResponse mt-3"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary runCronBtn"><i class="fas fa-play"></i>Run Cron</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++;} ?>
        </div>
    </div>
</div>


<!-- AJAX -->

<script>
$(document).on('submit','.runCronForm',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = form.serialize();
    var cronUrl = form.find('input[name="cron_url"]').val();
    var submitBtn = form.find('.runCronBtn');
    var responseDiv = form.find('.cronResponse');
    submitBtn.prop('disabled',true);
    submitBtn.html(
        '<i class="fas fa-spinner fa-spin"></i> Running...'
    );
    responseDiv.html('');
    $.ajax({
        url : baseurl + cronUrl,
        type : 'POST',
        data : formData,
        dataType : 'json',
        success:function(response){
            if(response.status == true){
                responseDiv.html(
                    '<div class="alert alert-success">'+
                      '<strong>'+response.message+'</strong><hr>'+
                        '<b>Description :</b> '+response.description+'<br>'+
                        '<b>Updated :</b> '+response.data.updated+'<br>'+
                        '<b>Inserted :</b> '+response.data.inserted+'<br>'+
                        '<b>Failed :</b> '+response.data.failed+
                    '</div>'
                );
            }else{
                responseDiv.html(
                    '<div class="alert alert-danger">'+
                        response.message+
                    '</div>'
                );
            }
        },
        error:function(){
            responseDiv.html(
                '<div class="alert alert-danger">'+
                    'Something went wrong while processing cron.'+
                '</div>'
            );
        },
        complete:function(){
            submitBtn.prop('disabled',false);
            submitBtn.html(
                '<i class="fas fa-play"></i> Run Cron'
            );
        }
    });
});
</script>

<!-- /PAGE WRAPPER -->