<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Custom Validations</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">All Custom Validations</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fa fa-calendar-check-o"></i>
            Leave Validation Settings
        </h5>
    </div>

    <div class="card-body">

        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link active"
                   data-toggle="tab"
                   href="#leaveRules">
                    Leave Rules
                </a>
            </li>

        </ul>

        <div class="tab-content mt-3">

            <div class="tab-pane fade show active" id="leaveRules">
<div id="responseMessage"></div>
                <form id="leaveValidationForm">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="thead-light">

                                <tr>

                                    <th width="120">
                                        Leave Type
                                    </th>

                                    <th width="150">
                                        Past Days Allowed
                                    </th>

                                    <th width="150">
                                        Future Days Allowed
                                    </th>

                                    <th width="150">
                                        Combination
                                    </th>

                                    <th>
                                        Allowed Leave Types
                                    </th>

                                </tr>

                            </thead>

<tbody>

<?php

$leavetypes = array(
    'SHRT',
    'CL',
    'SL',
    'EL',
    'PH',
    'OH'
);

foreach($leavetypes as $leave){

    $rule = isset($leavedetails[$leave])
        ? $leavedetails[$leave]
        : [];

    $selectedLeaves = !empty($rule['allow_combination_type'])
        ? explode(',', $rule['allow_combination_type'])
        : [];

?>

<tr>

    <td width="120">

        <strong><?php echo $leave; ?></strong>

        <input type="hidden"
               name="leave_type[]"
               value="<?php echo $leave; ?>">

    </td>

    <td width="150">

        <input type="number"
               min="0"
               class="form-control"
               name="from_days[]"
               value="<?php echo isset($rule['from_days']) ? $rule['from_days'] : 0; ?>">

        <small class="text-muted">
            Past Days
        </small>

    </td>

    <td width="150">

        <input type="number"
               min="0"
               class="form-control"
               name="to_days[]"
               value="<?php echo isset($rule['to_days']) ? $rule['to_days'] : 0; ?>">

        <small class="text-muted">
            Future Days
        </small>

    </td>

    <td width="150">

        <select class="form-control"
                name="allow_combination[]">

            <option value="0"
                <?php echo (
                    isset($rule['allow_combination'])
                    && $rule['allow_combination'] == 0
                ) ? 'selected' : ''; ?>>
                No
            </option>

            <option value="1"
                <?php echo (
                    isset($rule['allow_combination'])
                    && $rule['allow_combination'] == 1
                ) ? 'selected' : ''; ?>>
                Yes
            </option>

        </select>

    </td>

    <td>

        <select
            class="form-control select2"
            multiple
            name="allow_combination_type_<?php echo $leave; ?>[]">

            <?php
            foreach($leavetypes as $type){

                if($type == $leave){
                    continue;
                }
            ?>

                <option
                    value="<?php echo $type; ?>"
                    <?php echo in_array($type,$selectedLeaves)
                        ? 'selected'
                        : ''; ?>>

                    <?php echo $type; ?>

                </option>

            <?php } ?>

        </select>

        <?php if(!empty($selectedLeaves)){ ?>

            <small class="text-success">
                Selected :
                <?php echo implode(', ', $selectedLeaves); ?>
            </small>

        <?php } ?>

    </td>

</tr>

<?php } ?>

</tbody>

                        </table>

                    </div>

                    <div class="text-right">

                        <button type="submit"
                                class="btn btn-success">

                            <i class="fa fa-save"></i>
                            Save Validation Rules

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

	</div>			
</div>
<!-- /Main Wrapper -->
 <script>
$(document).on('submit','#leaveValidationForm',function(e){

    e.preventDefault();

    var form = $(this);
    var submitBtn = form.find('button[type="submit"]');

    submitBtn.prop('disabled',true);
    submitBtn.html(
        '<i class="fa fa-spinner fa-spin"></i> Saving...'
    );

    $.ajax({

        url : "<?php echo base_url('Developertools/saveLeaveValidationRules'); ?>",

        type : "POST",

        data : form.serialize(),

        dataType : "json",

        success : function(response){

            submitBtn.prop('disabled',false);
            submitBtn.html(
                '<i class="fa fa-save"></i> Save Validation Rules'
            );

            if(response.status){

                $('#responseMessage').html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        response.message+
                        '<button type="button" class="close" data-dismiss="alert">'+
                            '<span>&times;</span>'+
                        '</button>'+
                    '</div>'
                );
                setTimeout(function(){

                    window.location.reload();

                }, 1000);
            }else{

                $('#responseMessage').html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        response.message+
                        '<button type="button" class="close" data-dismiss="alert">'+
                            '<span>&times;</span>'+
                        '</button>'+
                    '</div>'
                );

            }

        },

        error : function(xhr){

            submitBtn.prop('disabled',false);
            submitBtn.html(
                '<i class="fa fa-save"></i> Save Validation Rules'
            );

            $('#responseMessage').html(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    'Something went wrong while saving.'+
                    '<button type="button" class="close" data-dismiss="alert">'+
                        '<span>&times;</span>'+
                    '</button>'+
                '</div>'
            );

            console.log(xhr.responseText);

        }

    });

});
 </script>