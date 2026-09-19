		<!-- Page Wrapper -->
<div class="page-wrapper">
<!-- Page Content -->
         <div class="content container-fluid">
                           <!-- Page Header -->
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Options Table</h3>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Mobile User Permissions</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Page Header -->
                            <div class="row" style="margin-top: 10px;">
                            <div class="container">
                            <form id="myForm" action="<?php echo base_url()?>Options_table_controller/option_search">
                            <div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select select2" style="width: 100%" name="field_name" id="field_name"> 
                                    <option value=""> Select Option </option>
                                    <?php foreach ($options_table as $key => $opt_table) { ?>
                                        <option value="<?php echo $opt_table->field_name ?>"><?php echo $opt_table->field_name ?></option>
                                    <?php } ?>
								</select>
								<label class="focus-label">Select Option </label>
							</div>
							<span class="formerror" id="opt_table_err"></span>
							<button type="submit" class="btn btn-primary form-control" onclick="return validatedata()">GO</button>
                            </div>
						</div>
                            </div>
                            
                           </form>
                           


		</div>
        <script>
            $("#opt_table").change(function(){
    var baseUrl = '<?php echo base_url()?>';
    var optionValue = this.value;
    var finalUrl = baseUrl + "Options_table_controller/option_search?field_name=" + optionValue;
    $("#myForm").attr('action',finalUrl);
});
function validatedata(){
    var id = $("#field_name").val();
    var userid = "<?php echo $this->session->userdata('user_id') ?>";
    if(userid != '888666'){
        if(id == ""){
            alert("Please SelectOption Type");
            return false;
        }
    }
}
        </script>