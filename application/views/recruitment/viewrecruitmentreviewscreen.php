<?php 
$processstatus = array("1"=> "Pending", "2"=>"In Process", "3"=> "Proceed For Next Round", "4"=> "Rejected", "5"=> "HR", "6"=> "Selected", "8" => "Back Ground Verification", "9" => "Black List", "10" => "Selected But Rejected By Candidate"); //Note "7" => "Scheduled" Not Adding here
$edtr = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
$work = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
$skills = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
$communications = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
$candiateenthusiasm = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
$interviewerreview = array("6"=> "N/A","1"=> "1","2"=> "2","3"=> "3","4"=> "4","5"=> "5");
?>
<form method="post" id="processreviwdata">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="form-group">
			<select name="processstatus" id="processstatus" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Status</option>
				<?php foreach($processstatus as $key1 => $value1){ 
					if($key1 == $review[0]->mx_rec_process_interviewe_status){
						$sel = "selected";
					}else{
						$sel = "";
					}
				?>
					<option value="<?php echo $key1; ?>" <?php echo $sel; ?> ><?php echo $value1; ?></option>
				<?php } ?>
				<option value="7" disabled="">Scheduled</option>
			</select>
			<span class="formerror" id="processstatuserror"></span>
		</div>
	</div>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Education/Training</label>
			<select name="edtr" id="edtr" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Education/Training</option>
				<?php foreach($edtr as $key2 => $value2){
					if($key2 == $review[0]->mx_rec_process_review_education_training){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $key2; ?>" <?php echo $sel; ?> ><?php echo $value2; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="edtrerror"></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Work Experience</label>
			<select name="workexperience" id="workexperience" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Work Experience</option>
					<?php foreach($work as $key3 => $value3){
					if($key3 == $review[0]->mx_rec_process_review_workexperince){
						$sel = "selected";
					}else{
						$sel = "";
					}
					 ?>
					<option value="<?php echo $key3; ?>" <?php echo $sel; ?> ><?php echo $value3; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="workexperienceerror"></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Skills (Technical)</label>
			<select name="skills" id="skills" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Skills (Technical)</option>
				<?php foreach($skills as $key4 => $value4){
					if($key4 == $review[0]->mx_rec_process_review_skills){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $key4; ?>" <?php echo $sel; ?> ><?php echo $value4; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="skillserror"></span>
			</div>
		
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Verbal Communication</label>
			<select name="verbalcommunication" id="verbalcommunication" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Communication</option>
				<?php foreach($communications as $key5 => $value5){
					if($key5 == $review[0]->mx_rec_process_review_communication){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $key5; ?>" <?php echo $sel; ?> ><?php echo $value5; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="verbalcommunicationerror"></span>
			</div>
		
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Candidate Enthusiasm</label>
			<select name="candidateenthusiasm" id="candidateenthusiasm" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Select Candidate Enthusiasm</option>
				<?php foreach($candiateenthusiasm as $key6 => $value6){
					if($key6 == $review[0]->mx_rec_process_review_candidate_intrest){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $key6; ?>" <?php echo $sel; ?> ><?php echo $value6; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="candidateenthusiasmerror"></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Interviewer Review</label>
			<select name="interviewerreview" id="interviewerreview" class="form-control select2" style="width: 100%;" autocomplete="off">
				<option value="">Interviewer Review</option>
				<?php foreach($interviewerreview as $key7 => $value7){
					if($key7 == $review[0]->mx_rec_process_review_interviewer_satisifaction){
						$sel = "selected";
					}else{
						$sel = "";
					}
				 ?>
					<option value="<?php echo $key7; ?>" <?php echo $sel; ?> ><?php echo $value7; ?></option>
				<?php } ?>
			</select>
			<span class="formerror" id="interviewerreviewerror"></span>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label>Comments</label>
			<textarea class="form-control" name="comments" id="comments" type="number" autocomplete="off" ><?php echo $review[0]->mx_rec_process_review_interviewer_comments ?></textarea>
			<span class="formerror" id="commentserror"></span>
		</div>
	</div>
</div>
<div class="submit-section">
	<input type="hidden" name="reviewuniqid" value="<?php echo $review[0]->mx_rec_process_id ?>">
	<input type="hidden" name="reviwapplicationid" value="<?php echo $review[0]->mx_rec_process_application_id ?>">
	<button class="btn btn-primary submit-btn" type="submit">Submit</button>
</div>
</form>
<script>
$("form#processreviwdata").submit(function(e) {
e.preventDefault();
	mainurl = baseurl+'recruitment/updaterecruitmentreview';

	var formData = new FormData(this);
	$.ajax({
	    url: mainurl,
	    type: 'POST',
	    data: formData,
	    success: function (data) {
	       // console.log(data);
	        if (data == 200) {
	            alert('Successfully');
	            setTimeout(function(){
	            window.location.reload();
	            }, 1000); 
	        } else {
	        	alert('Failed To Save Please TryAgain later');
	        }
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});

});  
</script>