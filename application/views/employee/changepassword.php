<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<div class="row">
			<div class="col-md-6 offset-md-3">
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Change Password</h3>
							<h4 style="color:red">HI <?php echo $this->session->userdata('user_name'); ?> (<?php echo $this->session->userdata('user_id'); ?>) You can Change Your Password</h4>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				
				<form id="changepasswordprocess">
					<div class="form-group">
						<label>Old password</label>
						<input type="password" name="oldpassword" id="oldpassword" class="form-control">
					</div>
					<div class="form-group">
						<label>New password</label>
						<input type="password" name="newpassword" id="newpassword" class="form-control">
					</div>
					<div class="form-group">
						<label>Confirm password</label>
						<input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
					</div>
					<span id="CheckPasswordMatch"></span>
					<div class="submit-section">
						<button type="button" class="btn btn-primary submit-btn" onclick="changepassword()">Update Password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
	
</div>
<!-- /Page Wrapper -->
<script>
	function changepassword(){
		var empcode = '<?php echo $this->session->userdata('user_id'); ?>';
		var oldpassword = $('#oldpassword').val();
		if(oldpassword == ""){
			alert("Please Enter Old Password");
			return false;
		}
		var newpassword = $('#newpassword').val();
		if(newpassword == ""){
			alert("Please Enter New Password");
			return false;
		}
		var confirmpassword = $('#confirmpassword').val();
		if(confirmpassword == ""){
			alert("Please Enter Confirm Password");
			return false;
		}
		if(newpassword != confirmpassword){
			alert("Password Not Matching");
			return false;
		}
	    $.ajax({
	      url: baseurl + 'Employee/updateemployeepassword',
	      type: 'POST',
	      data: { employeecode: empcode, cnfpswd : confirmpassword, oldpswd : oldpassword},
	      success: function (data) {
	        if (data == 200) {
	            alert('Successfully');
	            location.href = "<?php echo base_url() ?>admin/logout";
	        }else if(data == 2){
	        	alert('Entered Old Password Is Not Matching');
	        } else {
	        	alert('Failed Please TryAgain later');
	        }
	      },
	    });
	}
</script>
    <script>
    function checkPasswordMatch() {
        var password = $("#newpassword").val();
        var confirmPassword = $("#confirmpassword").val();
        if (password != confirmPassword){
            $("#CheckPasswordMatch").html("Passwords does not match!");
        }else{
            $("#CheckPasswordMatch").html("Passwords match.");
        }
    }
    $(document).ready(function () {
       $("#confirmpassword").keyup(checkPasswordMatch);
    });
    </script>