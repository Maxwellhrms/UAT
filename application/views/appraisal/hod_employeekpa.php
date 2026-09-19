<form id="saveemployeekpa">
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
<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="kpa_datatable">
        <thead>
            <tr>
				<th>#</th>
				<th>Question</th>
				<th>Weightage Marks %</th>
	            <th>Monthly&nbspTargets</th>
                <th>Employee</th>
                <th>Manager</th>
                <th>Manager Review</th>
                <th>HOD</th>
                <th>HOD Review</th>
               </tr>
        </thead>
        <tbody>
            <?php 
        if(count($assigned) > 0){
            $sno = 1; foreach ($assigned as $key => $value) {
            $id = $value['mxap_assign_id'];
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

            // $employees = $userdata['employees'];
            // $quecategory = $userdata['quecategory'];
            // $department = $userdata['department'];
            // $year = $userdata['year'];
            // $months = $userdata['month'];

            $table = "<tr>";
            $table .= "<input type='hidden' name='question_id[]' class='form-control' value='$id'>";
            $table .= "<td>".$sno."</td>";
            $table .= "<td>".$value['mxap_question']."</td>";
            $table .= "<td>$weightmeasure</td>";
            $table .= "<td><select name='mxap_assign_monthlytarget[]' class='form-control' disabled=''>";
                foreach($kc as $kckey => $kcval){
                    if($kckey == $monthlytarget){
                        $sel = "selected";
                    }else{
                        $sel = "";
                    }
                $table .= "<option value='$kckey' $sel>$kcval</option>";
                }
            $table .="</select></td>";
            $table .= "<td><select name='mxap_assign_emp_noofaccounts[]' class='form-control' disabled=''>";
                foreach($kc as $kckeys => $kcvals){
                    if($kckeys == $empnoofaccounts){
                        $sel = "selected";
                    }else{
                        $sel = "";
                    }
                $table .= "<option value='$kckeys' $sel>$kcvals</option>";
                }
            $table .="</select></td>";
            $table .= "<td><select name='mxap_assign_manager_noofaccounts[]' class='form-control' disabled=''>";
                foreach($kc as $kckeymp => $kcvalmp){
                    if($kckeymp == $managernoofaccounts){
                        $sel = "selected";
                    }else{
                        $sel = "";
                    }
                $table .= "<option value='$kckeymp' $sel>$kcvalmp</option>";
                }
            $table .="</select></td>";
            $table .= "<td><input type='text' name='managerdesc[]' class='form-control' value='$managerdesc' disabled=''></td>";

            $table .= "<td><select name='mxap_assign_hod_noofaccounts[]' class='form-control' >";
                foreach($kc as $kckeymp => $kcvalmp){
                    if($kckeymp == $hodnoofaccounts){
                        $sel = "selected";
                    }else{
                        $sel = "";
                    }
                $table .= "<option value='$kckeymp' $sel>$kcvalmp</option>";
                }
            $table .="</select></td>";
            $table .= "<td><input type='text' name='hoddesc[]' class='form-control' value='$hoddesc' ></td>";

            $table .= "</tr>";
            echo $table;
            $sno++; }
        }
    ?>
        <button type="submit" class="btn btn-success">Save</button>
        </tbody>
    </table>
</div>
</form>
<script>
$(document).ready(function(){
    $("form#saveemployeekpa").submit(function (e) {
    e.preventDefault();   
        var mainurl = baseurl + 'Performanceappraisal/savehodkpa';
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