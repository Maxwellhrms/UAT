<div class="modal custom-modal fade" id="validatepassword" role="dialog" >
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" style="border: 1px solid #ab1010;">
			<div class="modal-body">
				<div class="form-header">
					<h3>Validate Password</h3>
					<h3 style="color: red" id="validatingpassworderror"></h3>
				</div>
				<input class="form-control floating" type="password" name="validatingpassword" id="validatingpassword" autocomplete='off'><br>
				<div class="modal-btn delete-action">
					<div class="row">
					    <button type="button" onclick="processeditattedance()" class="btn btn-primary">Validate & Proceed</button>
						<a style='display:none' id="passclose" href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>