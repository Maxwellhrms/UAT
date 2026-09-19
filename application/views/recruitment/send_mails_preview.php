<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Send Bulk Email Preview</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Send Bulk Email</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Subscription Details</h4>
				</div>
				<div class="card-body">
                    <form id="updateconfig">
					<div class="form-group row">
						<div class="col-lg-3">
						    <label class="form-label">Type</label>
							<select class="form-control" name="type" id="type" style="width:100%">
								<option value="relocations" <?php if('relocations' == $userdata['type']){ echo'selected';}else{ echo'';} ?>>RELOCATIONS</option>
								<option value="logistics" <?php if('logistics' == $userdata['type']){ echo'selected';}else{ echo'';} ?>>LOGISTICS</option>
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
						
						<div class="col-lg-3">
						    <label class="form-label">Current Location</label>
							<select class="form-control" name="currentlocation" id="currentlocation" style="width:100%">
								<option value=""> All </option>
								<?php foreach($userinfo['currentlocation'] as $ckey => $cval){ ?>
								<option value="<?php echo $cval->currentlocation ?>" <?php if($cval->currentlocation == $userdata['currentlocation']){ echo'selected';}else{ echo'';} ?>><?php echo $cval->currentlocation ?></option>
								<?php } ?>
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
						
						<div class="col-lg-3">
						    <label class="form-label">Preferred Location</label>
							<select class="form-control" name="preferredlocation" id="preferredlocation" style="width:100%">
								<option value=""> All </option>
								<?php foreach($userinfo['preferredlocation'] as $ckey => $cval){ ?>
								<option value="<?php echo $cval->preferredlocation ?>" <?php if($cval->preferredlocation == $userdata['preferredlocation']){ echo'selected';}else{ echo'';} ?>><?php echo $cval->preferredlocation ?></option>
								<?php } ?>
							</select>
							<span class="formerror" id="typeerror"></span>
						</div>
					</div>
					<a type="button" class="btn btn-primary" onclick="filterdetails()">Search Details</a>
					</form>
					<br>
					<div id="Subscription_list"></div>
				</div>
			</div>
		</div>
	</div>

<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
				    
				    <h4 class="card-title mb-0">Select Mails From Below List To Send (Template : <b style="color:red"><?php echo $userinfo['template'][0]->email_title; ?></b>)
                        <button class="btn btn-primary float-end ms-3" style="float:right;"> <input type="checkbox" class="form-check-input" onclick='SelectAll(this);'> Select All</button>
                    </h4>
				</div>
				<div class="card-body">
				    <?php #echo '<pre>';print_r($userinfo['mails']); ?>
				    <form id="processformdata">
            <div class="table-responsive">
                <table class="datatable table table-stripped mb-0" id="dataTables-example">
            		<thead>
            			<tr>
            				<th>Type</th>
            				<th>Email</th>
            				<th>Name</th>
            				<th>Mobile</th>
            				<th>Current Location</th>
            				<th>Preferred Location</th>
            				<th>Current Company</th>
            			</tr>
            		</thead>
            		<tbody>
            		    <?php $i=1; foreach($userinfo['mails'] as $key => $val){ ?>
            		    <tr>
            		    <td><?php echo $val->type; ?></td>
            		    <td>
                        <input type="checkbox" class="form-check-input" id="sendmals_<?php echo $i; ?>" name="sendmails[]" value="<?php echo $val->email.'[~-~]'.$val->name.'[~-~]'.$val->mobile.'[~-~]'.$val->currentlocation.'[~-~]'.$val->preferredlocation.'[~-~]'.$val->currentcompany; ?>"> <?php echo $val->email; ?> 
						</td>
						<td><?php echo $val->name; ?></td>
						<td><?php echo $val->mobile; ?></td>
						<td><?php echo $val->currentlocation; ?></td>
						<td><?php echo $val->preferredlocation; ?></td>
						<td><?php echo $val->currentcompany; ?></td>
						</tr>
						<?php $i++;} ?>
                      
                    </tbody>
                	</table>
                </div>
                        <div class="text-right">
                            <input type="hidden" name="templateid" value="<?php echo $userdata['templateid']; ?>">
                            <input type="hidden" name="type" value="<?php echo $userdata['type']; ?>">
							<button type="button" id="sendbutton" class="btn btn-primary" onclick="sendmails()">Send</button>
							<button style="display:none" type="button" id="sendbuttondone" class="btn btn-primary">Processed Please Check the Mail logs</button>
						</div>
						</form>
				</div>
			</div>
		</div>
	</div>


	</div>			
</div>
<script>

function filterdetails(){
    var cr = $("#currentlocation").val();
    var pr = $("#preferredlocation").val();
    var ty = $("#type").val();
    var urldata = "<?php echo base_url().'recruitment/sendmailpreview?templateid='.$userdata['templateid'].'&type='?>"+ty+"&currentlocation="+cr+"&preferredlocation="+pr;
    window.location=urldata;
    
}

checked = false;
function SelectAll(source) {
checkboxes = document.getElementsByName('sendmails[]');
for(var i=0, n=checkboxes.length;i<n;i++) {
checkboxes[i].checked = source.checked;
}
}

function sendmails(){
    
    var checkboxs=document.getElementsByName("sendmails[]");
    var okay=false;
    for(var i=0,l=checkboxs.length;i<l;i++)
    {
        if(checkboxs[i].checked)
        {
            okay=true;
            break;
        }
    }
    if(okay){
    }else{ 
        alert("Please check a checkbox"); return false;
    }
    
    var mainurl = baseurl+'Recruitment/savesendmail';
    var formdata = $('#processformdata').serialize();
    $("#sendbutton").hide();
    $("#sendbuttondone").show();
    $.ajax({
        type : 'POST',
        url : mainurl,
        data : formdata,
        success: function (data) {
            // console.log(data);
            alert('Please check the Mail Responses in the log');
        },
    })
}
</script>