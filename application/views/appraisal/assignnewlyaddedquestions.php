<?php
$assigned = array();
foreach ($allqu['assigned'] as $akey => $avalue) {
	array_push($assigned, $avalue['mxap_assign_queid']);
}
?>
		<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Assign New Appraisal Questions</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Assign Appraisal Questions</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
<form id="assignnewquestions">
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-review review-table mb-0" id="table_goals">
				<thead>
					<tr>
						<th>#</th>
						<th>Question</th>
						<th>Assign</th>
					</tr>
				</thead>
				<?php
		        // if($allqu > 0){
		        	$sno = 1; foreach ($allqu['all'] as $key => $value) {
		        		if(!in_array($value['mxap_id'], $assigned)){
		                $id = $value['mxap_id'];
			            $table = "<tr>";
			            $table .= "<td>".$sno."</td>";
			            $table .= "<td>".$value['mxap_question']."</td>";
			            $table .= "<td><select name='question_assign[]' class='form-control'><option value='0'>NO</option><option value='1'>YES</option></select></td>";
		                $table .= "<input type='hidden' name='question_id[]' value='$id'>";
			            $table .= "</tr>";
			            echo $table;
			            $sno++; 
		        	}
		        }
				?>
			</table>
			<br>
			<button type="submit" class="btn btn-success">Save</button>
		</div>
	</div>
</div>
</form>
</div>
</div>
<script>
$(document).ready(function(){


	$("form#assignnewquestions").submit(function (e) {
    e.preventDefault();  
		var mainurl ='<?php echo base_url() ?>Performanceappraisal/savenewlyaddedquestion';
		var formData = new FormData(this);
		formData.append("employeeid",'<?php echo $this->input->get('employeeid') ?>');
		formData.append("quecategory",'<?php echo $this->input->get('quecategory') ?>');
		formData.append("department",'<?php echo $this->input->get('department') ?>');
		formData.append("year",'<?php echo $this->input->get('year') ?>');
		formData.append("month",'<?php echo $this->input->get('month') ?>');
		$.ajax({
		    url: mainurl,
		    type: 'POST',
		    data: formData,
		    async:false,
		    success: function (data) {
            if (data == 200) {
                alert('Successfully Updated');
        	}
		    },
		    cache: false,
        	contentType: false,
        	processData: false
		});
  	});
});
</script>