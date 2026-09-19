<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Email Logs</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">All Email Logs</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card mb-0">
				<div class="card-header">
					<h4 class="card-title mb-0">Email logs list</h4>
				</div>
				<div class="card-body">
					<form id="menudetails" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">Email Type <span class="text-danger">*</span></label>
									<select name="mailtype" id="mailtype" class="form-control select2" style="width: 100%" >
										<option value="">All</option>
                                        <?php foreach($type as $tkey => $tval){ ?>
                                        <option><?php echo $tval->email_type ?></option>
                                        <?php } ?>
									</select>
									<span class="formerror" id="mailtypeerror"></span>
							   </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">From Date <span class="text-danger">*</span></label>
									<input class="form-control datetimepicker" type="text" name="fromdate" id="fromdate" autocomplete="off" value="<?php echo $userdata['fromdate']; ?>">
									<span class="formerror" id="fromdateerror"></span>
							   </div>
							</div>
							
							
							<div class="col-sm-4">
								<div class="form-group">
									<label class="col-form-label">To Date <span class="text-danger">*</span></label>
									<input class="form-control datetimepicker" type="text" name="todate" id="todate" autocomplete="off" value="<?php echo $userdata['todate']; ?>">
									<span class="formerror" id="todateerror"></span>
							   </div>
							</div>

						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Email Logs List</h4>
			</div>
			<div class="card-body" id="displaymenushere">	
                <!--cut-->
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
                    		<thead>
                    			<tr>
                    				<th>Type</th>
                    				<th>Response</th>
                    				<th>To</th>
                    				<th>Sented By</th>
                    				<th>Sented Date</th>
                    				<th>Sented From Ip</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php 
                    			$sno = 1; foreach ($showlist as $key => $grvalue) { ?>
                    			<tr>
                    				<td><a href="<?php echo base_url().'Developertools/getdetailedemaillogs?id='.$grvalue->id ?>"><?php echo $grvalue->email_type; ?></td>
                    				<td><?php if($grvalue->email_response == '1'){ echo 'Sent';}else{ echo $grvalue->email_response; } ?></a></td>
                    				<td><?php $decodemail = json_decode($grvalue->email_sent); echo implode(",",$decodemail->to); ?></td>
                    				<td><?php echo $grvalue->createdby.' ('.$grvalue->createdempid.')'; ?></td>
                    				<td><?php echo $grvalue->createdtime; ?></td>
                    				<td><?php echo $grvalue->created_ip; ?></td>
                    			</tr>
                    			<?php $sno++; } ?>
                    		</tbody>
                    	</table>
                    </div>
                     <!--cut-->
			</div>
		</div>
	</div>
</div>


	</div>			
</div>