		<style>
			#displaydata td,
#displaydata th{
    vertical-align:middle;
}

#displaydata input,
#displaydata select{
    height:40px;
    border-radius:8px;
}

#displaydata td:nth-child(1){
    width:60px;
    text-align:center;
}

#displaydata td:nth-child(2){
    width:40%;
}

#displaydata td:nth-child(3){
    width:20%;
}

#displaydata td:nth-child(4){
    width:15%;
}

#displaydata td:nth-child(5){
    width:15%;
}

#displaydata td:nth-child(6){
    width:80px;
    text-align:center;
}

#displaydata td{
    padding:12px;
}
		</style>
		<form id="processapprisalquestions">
					<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Appraisal Questions</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active">Appraisal Questions</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<div class="row filter-row">

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="department" id="department" onchange="getdetails()"> 
									<option value="">Select Department</option>
							        <?php foreach ($depart as $key => $value) {
							            echo "<option value=".$value->mxdpt_id.">".$value->mxdpt_name."</option>";
							        } ?>
								</select>
								<label class="focus-label">Select Department</label>
							</div>
							<span class="formerror" id="departmenterror"></span>
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="quecategory" id="quecategory" onchange="getdetails()"> 
									<option value="">Select Category</option>
									<?php foreach($catg as $ckey => $cval){ 
										echo "<option value=".$ckey." >".$cval."</option>";
									} ?>
								</select>
								<label class="focus-label">Select Category</label>
							</div>
							<span class="formerror" id="quecategoryerror"></span>
							
						</div>

						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="questatus" id="questatus" onchange="getdetails()"> 
									<option value="">Select Status</option>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
								<label class="focus-label">Select Status</label>
							</div>
							<span class="formerror" id="questatuserror"></span>
							
						</div>
   
                    </div>

					<!-- /Search Filter -->
					
					<div id="displayappersialquestions"></div>

<section class="review-section">
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th style="width:60px;">#</th>

                            <th>Question</th>

                            <th>KPI</th>

                            <th>Type</th>

                            <th>Formal Type</th>

                            <th style="width:100px;">Action                                 
								<button
                                    type="button"
                                    class="btn btn-primary btn-add-row">

                                    <i class="fa fa-plus"></i>

                                </button></th>

                        </tr>

                    </thead>

                    <tbody id="displaydata">

                    </tbody>

                </table>

                <br>

                <button type="submit" class="btn btn-success">
                    Save
                </button>

            </div>

        </div>
    </div>
</section>


                </div>
		</form>
				<!-- /Page Content -->	
<script>
	var performanceOptions = '<?php echo $controller->display_options('performance',''); ?>';
	var performanceformulas = '<?php echo $controller->display_options('performanceformulas',''); ?>';
$(function () {

$(document).on("click", ".btn-add-row", function () {

    $("#displaydata").prepend(GetDynamicTextBox());

});

    $(document).on("click",".comments_remove",function(){

        $(this).closest("tr").prev().find('td:last-child').html(
            '<button type="button" class="btn btn-danger" class="comments_remove"><i class="fa fa-trash"></i></button>'
        );

        $(this).closest("tr").remove();

        // Reorder serial numbers
        $('table.table-review tbody tr').each(function(index){
            $(this).find('td:first').text(index + 1);
        });
    });

	function GetDynamicTextBox(){

		var rowsLength = $("#displaydata tr").length + 1;

		return `
			<tr>

				<td class="text-center">
					${rowsLength}
				</td>

				<td>
					<input
						type="text"
						name="question[]"
						class="form-control"
						placeholder="Enter Question">
				</td>

				<td>
					<input
						type="text"
						name="kpi[]"
						class="form-control"
						placeholder="Enter KPI">
				</td>

				<td>
					<select
						name="type[]"
						class="form-control">
						${performanceOptions}
					</select>
				</td>

				<td>
					<select
						name="formulatype[]"
						class="form-control">
						${performanceformulas}
					</select>
				</td>

				<td class="text-center">

					<button
						type="button"
						class="btn btn-danger comments_remove">

						<i class="fa fa-trash"></i>

					</button>

				</td>

				<td style="display:none;">
					<input
						type="hidden"
						name="id[]">
				</td>

			</tr>
		`;
	}
});

$(document).ready(function(){

    $("form#processapprisalquestions").submit(function (e) {

        e.preventDefault();

        var department = $("#department").val();

        if (department == "") {
            $("#department").focus();
            $('#departmenterror').html("Please Select Department...");
            return false;
        } else {
            $('#departmenterror').html("");
        }

        var quecategory = $("#quecategory").val();

        if (quecategory == "") {
            $("#quecategory").focus();
            $('#quecategoryerror').html("Please Select Category...");
            return false;
        } else {
            $('#quecategoryerror').html("");
        }

        var mainurl = baseurl + 'Performanceappraisal/savequestion';

        var formData = new FormData(this);

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {

                if (data == 200) {

                    alert('Successfully Created');

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });

});

function getdetails(){

    var department = $("#department").val();
    var quecategory = $("#quecategory").val();
	var questatus = $("#questatus").val();

    if(department != "" && quecategory != ""){

        var mainurl = '<?php echo base_url() ?>Performanceappraisal/filterappraisalquestion';

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: {
                department : department,
                quecategory : quecategory,
				questatus : questatus
            },
            success: function (data) {
                $('#displaydata').html(data);
            }
        });

    }else{
        return false;
    }
}

function deleteque(id){

    var result = confirm("Want to delete?");

    if (result) {

        var mainurl = '<?php echo base_url() ?>Performanceappraisal/updateappraisalquestion';

        $.ajax({
            url: mainurl,
            type: 'POST',
            data: {
                id : id
            },
            success: function (data) {

                alert('Successfully Deleted');

                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        });
    }
}
</script>