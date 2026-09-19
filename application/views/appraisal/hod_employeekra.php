<form id="saveemployeekra">
	<?php
	   	$employees = $userdata['employees'];
     	$quecategory = $userdata['quecategory'];
    	$department = $userdata['department'];
    	$year = $userdata['year'];
    	$months = $userdata['month'];
        echo "<input type='hidden' name='employees' class='form-control' value='$employees'>";
        echo "<input type='hidden' name='quecategory' class='form-control' value='$quecategory'>";
        echo "<input type='hidden' name='department' class='form-control' value='$department'>";
        echo "<input type='hidden' name='year' class='form-control' value='$year'>";
        echo "<input type='hidden' name='month' class='form-control' value='$months'>";
	?>
        <?php 
        if(count($assigned) > 0){
            $sno = 1; foreach ($assigned as $key => $value) {
            $id = $value['mxap_assign_id'];
            $question = $value['mxap_question'];
            $unitmeasure = $value['mxap_assign_unitmeasure'];
            $weightmeasure = $value['mxap_assign_weightage'];
            $monthlytarget = $value['mxap_assign_monthlytarget'];

            $empnoofaccounts = $value['mxap_assign_emp_noofaccounts'];
            $empclientname = $value['mxap_assign_emp_client_name'];
            $empdesc = $value['mxap_assign_emp_description'];
            $empachivement = $value['mxap_assign_emp_achievement'];

            $managernoofaccounts = $value['mxap_assign_manager_noofaccounts'];
            $managerclientname = $value['mxap_assign_manager_client_name'];
            $managerdesc = $value['mxap_assign_manager_review'];
            $managerachivement = $value['mxap_assign_manager_actual_assesment'];

            $hodnoofaccounts = $value['mxap_assign_hod_noofaccounts'];
            $hodclientname = $value['mxap_assign_hod_client_name'];
            $hoddesc = $value['mxap_assign_hod_review'];
            $hodachivement = $value['mxap_assign_hod_actual_assesment'];

if($sno == 1){
    $show = 'show';
}else{
    $show = '';
}
$table = "<div class='container-fluid'>";
$table .= "<div id='accordion_$key'>";
  
$table .= "    <div class='card'>";
$table .= "      <div class='card-header'>";
$table .= "        <a class='card-link' data-toggle='collapse' href='#collapseOne_$key'>$question";
$table .= "          <a style='float:right'><b>Unit Of Measure : $unitmeasure | Weightage Marks : $weightmeasure | Monthly Target : $monthlytarget</b></a>";
$table .= "        </a>";
$table .= "      </div>";
$table .= "      <div id='collapseOne_$key' class='collapse $show' data-parent='#accordion_$key'>";
$table .= "        <div class='card-body'>";
$table .= "<input type='hidden' name='question_id[]' class='form-control' value='$id'>";
$table .= "  <table class='table table-hover'>
    <thead>
      <tr>
        <th><span style='color:red'>Employee</span><br>No&nbspof&nbspAccounts&nbspTarget</th>
        <th><span style='color:red'>Employee</span><br>Clients&nbspNames</th>
        <th><span style='color:red'>Employee</span><br>Description</th>
        <th><span style='color:red'>Employee</span><br>Actual Achievement</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>$empnoofaccounts</td>
        <td>$empclientname</td>
        <td>$empdesc</td>
        <td>$empachivement</td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th><span style='color:red'>Manager</span><br>No&nbspof&nbspAccounts&nbspTarget</th>
        <th><span style='color:red'>Manager</span><br>Clients&nbspNames</th>
        <th><span style='color:red'>Manager</span><br>Review</th>
        <th><span style='color:red'>Manager</span><br>Actual Assesment</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>$managernoofaccounts</td>
        <td>$managerclientname</td>
        <td>$managerdesc</td>
        <td>$managerachivement</td>
      </tr>
    </tbody>

    <thead>
      <tr>
        <th><span style='color:red'>HOD</span><br>No&nbspof&nbspAccounts&nbspTarget</th>
        <th><span style='color:red'>HOD</span><br>Clients&nbspNames</th>
        <th><span style='color:red'>HOD</span><br>Review</th>
        <th><span style='color:red'>HOD</span><br>Actual Assesment</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type='text' name='hodnoofaccounts[]' class='form-control' value='$hodnoofaccounts' autocomplete='off'></td>
        <td><input type='text' name='hodclientname[]' class='form-control' value='$hodclientname' autocomplete='off'></td>
        <td><input type='text' name='hoddesc[]' class='form-control' value='$hoddesc' autocomplete='off'></td>
        <td><input type='text' name='hodachivement[]' class='form-control' value='$hodachivement' autocomplete='off'></td>
      </tr>
    </tbody>

  </table>";
$table .= "        </div>";
$table .= "      </div>";
$table .= "    </div>";
    
$table .= "  </div>";
$table .= "</div>";

            echo $table;
            $sno++; }
        }
        ?>
<button type="submit" class="btn btn-success">Save</button>
</form>
<script>
$(document).ready(function(){
	$("form#saveemployeekra").submit(function (e) {
    e.preventDefault();   
		var mainurl = baseurl + 'Performanceappraisal/savehodapprovedkra';
      	var formData = new FormData(this);
    	$.ajax({
        url: mainurl,
        type: 'POST',
        data: formData,
        async:false,
        success: function (data) {
        	//console.log(data);
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