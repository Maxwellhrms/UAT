<form id="editlegalform">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6"> 
					<div class="form-group form-focus select-focus">
						<input class="form-control datetimepicker" type="text" name="hearingdate" id="hearingdate" value="<?php echo date('d-m-Y', strtotime($info[0]->mx_ntf_hearing_date)) ?>"> 
						<label class="focus-label">First Hearing Date</label>
						<span class="formerror" id="hearingdate_error"></span>
					</div>
				</div>
				
				<div class="col-md-6"> 
					<div class="form-group form-focus select-focus">
					    <?php 
					    if(!empty($info[0]->mx_ntf_followup_date) && $info[0]->mx_ntf_followup_date != '0000-00-00' ){
					        $followupdate = date('d-m-Y', strtotime($info[0]->mx_ntf_followup_date));
					    }else{
					        $followupdate = '';
					    }?>
						<input class="form-control datetimepicker" type="text" name="followupdate" id="followupdate"  value="<?php echo $followupdate; ?>"> 
						<label class="focus-label">Follow UpDate (Next Hearing Date)</label>
						<span class="formerror" id="followupdate_error"></span>
					</div>
				</div>

				<div class="col-md-6"> 
				<div class="form-group form-focus select-focus">
						<input class="form-control" type="text" name="from" id="from"  value="<?php echo $info[0]->mx_ntf_filedby ?>"> 
						<label class="focus-label">Filed BY</label>
						<span class="formerror" id="from_error"></span>
					</div>
				</div>

				<div class="col-md-6"> 
					<div class="form-group form-focus select-focus">
						<input class="form-control" type="text" name="to" id="to"  value="<?php echo $info[0]->mx_ntf_filedto ?>"> 
						<label class="focus-label">Filed To</label>
						<span class="formerror" id="to_error"></span>
					</div>
				</div>
				
				<div class="col-md-6"> 
					<div class="form-group form-focus select-focus">
						<input class="form-control" type="text" name="referenceno" id="referenceno"  value="<?php echo $info[0]->mx_ntf_refrencce ?>"> 
						<label class="focus-label">Reference No</label>
						<span class="formerror" id="referenceno_error"></span>
					</div>
				</div>

				<div class="col-md-6"> 
					<div class="form-group form-focus ">
						<select style="width: 100%" name="ntfstatus" id="ntfstatus"> 
							<option value="">Select Notification status</option>
							<option value="1" <?php if($info[0]->mx_ntf_notification == 1){ echo 'selected';}else{echo '';} ?>>ON</option>
							<option value="2" <?php if($info[0]->mx_ntf_notification == 2){ echo 'selected';}else{echo '';} ?>>OFF</option>
						</select>
					</div>
					<span class="formerror" id="ntfstatus_error"></span>
				</div>
				
				<div class="col-md-6"> 
					<div class="form-group form-focus">
					    <label>Year / Monthly</label>
						<select style="width: 100%" name="ym" id="ym"> 
                            <option value=""> Year/Monthly </option>
                            <option value="13" <?php if($info[0]->mx_ntf_ym == 13){ echo 'selected';}else{echo '';} ?> >Every Monthly</option>
			                <option value="14" <?php if($info[0]->mx_ntf_ym == 14){ echo 'selected';}else{echo '';} ?> >Every Yearly</option>
						</select>
					</div>
					<span class="formerror" id="ymerror"></span>
				</div>
				
				<div class="col-md-6"> 
					<div class="form-group form-focus">
					    <label>Delete</label>
						<select style="width: 100%" name="ntf_delete" id="ntf_delete"> 
                            <option value=""> Delete / Active </option>
                            <option value="1" <?php if($info[0]->mx_ntf_status == 1){ echo 'selected';}else{echo '';} ?> >Active</option>
			                <option value="0" <?php if($info[0]->mx_ntf_status == 0){ echo 'selected';}else{echo '';} ?> >Delete</option>
						</select>
					</div>
					<span class="formerror" id="ntf_deleteerror"></span>
				</div>
				
				<div class="col-md-6"> 
					<div class="form-group form-focus">
					    <label>Deactive for Cron</label>
						<select style="width: 100%" name="ntf_cron" id="ntf_cron"> 
                            <option value=""> Delete / Active </option>
                            <option value="1" <?php if($info[0]->mx_ntf_notallow_cron == 1){ echo 'selected';}else{echo '';} ?> >Deactive</option>
			                <option value="0" <?php if($info[0]->mx_ntf_notallow_cron == 0){ echo 'selected';}else{echo '';} ?> >Active</option>
						</select>
					</div>
					<span class="formerror" id="ntf_cronerror"></span>
				</div>
				
				<div class="col-md-12"> 
					<div class="form-group form-focus select-focus" style="height: 100px;">
						<textarea style="height: 100px;" class="form-control" name="msg" id="msg" rows="4" cols="50"> <?php echo $info[0]->mx_ntf_description ?></textarea>
						<label class="focus-label">Message</label>
						<span class="formerror" id="msg_error"></span>
					</div>
				</div>

					<div class="row col-md-12">
						<?php foreach ($info['documents'] as $filekey => $filevalue) { ?>
						<section class="row">
						<div class="col-sm-10">
							<div class="form-group">
								<label>Upload Files</label>
								<input class="form-control filetypeschecker" type="file" name="file[]" id="upfile_<?php echo $filevalue->doc_id; ?>" onclick="updatecheckfiles('<?php echo $filevalue->doc_id; ?>')">
								<input class="form-control" type="hidden" name="doc_uniqueid[]" id="doc_uniqueid" value="<?php echo $filevalue->doc_id; ?>">
								<span style="color:red" id="updisplay_<?php echo $filevalue->doc_id; ?>"></span>
								<?php
								$filepath = ROOTDOCUMENT.$filevalue->doc_url;
								if(file_exists($filepath)){ $filesize = filesize($filepath);  echo getfileSizes($filesize); if(!empty($filevalue->doc_url)){ $filename = explode('/',$filevalue->doc_url);
								echo ' - '.end($filename);}?> <span> <a href="<?php echo base_url().'Admin/downloadfiles?filename='.$filevalue->doc_id ?>"><img src="<?php echo base_url() ?>assets/img/attachment.png" alt=""></span></a><?php }else{echo "file not available";} ?>
								
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="button" class="form-control btn btn-danger" onclick="deletefile('<?php echo $filevalue->doc_id ?>')">
									<span class="action-circle large delete-btn" title="Delete Task"><i class="material-icons">delete</i></span>
								</button>
							</div>
						</div>
						</section>
						<?php } ?>
					</div>

			<div class="text-right">
			    <input type="hidden" name="appid" id="appid" value="<?php echo $info[0]->mx_ntf_appid ?>">
			    <input type="hidden" name="id" id="id" value="<?php echo $info[0]->mx_ntf_id ?>">
				<button type="submit" class="btn btn-primary">Update Details</button>
			</div>
			</div>
		</div>
	</div>
</form>
<script>
    	if ($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa fa-angle-down",
				next: 'fa fa-angle-right',
				previous: 'fa fa-angle-left'
			}
		});
	}
$("form#editlegalform").submit(function(e) {
	e.preventDefault();  

	mainurl = baseurl+'admin/updatelegalnotifications';

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

function updatecheckfiles(id){
var fileid = id;
  $('#upfile_'+fileid).on('change', function() {
      var displaysize = formatBytes(this.files[0].size);
      // console.log(displaysize);
      if (this.files[0].size > 2097152) {
          alert("Try to upload file less than 2MB!");
          $('#updisplay_'+fileid).html('Error Invalid File Size '+displaysize);
      } else {
          $('#updisplay_'+fileid).html(displaysize);
          // console.log(this.files[0].size);
          // $('#GFG_DOWN').text(this.files[0].size + "bytes");
      }
  });
}

function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

function deletefile(id){
   
     let text = "Do Really Want Delete File";
     if (!confirm(text) == true) {
       return false;
     }
     
   $.ajax({
       method: "POST",
       url: baseurl+"admin/deletefile",
       data:{'id': id}, 
    
   }).done(function( data ) {
       var result = $.parseJSON(data);
           if(result.respone == 200){
               alert('Successfully');
               $('#li_'+id).hide();
           }

   });
}
</script>