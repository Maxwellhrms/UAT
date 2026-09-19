<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Loan Request List</h4>
			</div>
			<div class="card-body">	

				<div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example1">
						<thead>
							<tr>
								<th>Loan ID</th>
								<th>Employee Code</th>
								<th>Employee Name</th>
								<th>Loan Type</th>
								<th>Tenure Months</th>
								<th>Applied Amount</th>
								<th>Category</th>
								<th>Applied Date</th>
								<th>Status</th>
								<th>More</th>
							</tr>
						</thead>
						<tbody>
						<?php if(count($loandata)>0){ ?>
							<tr>
								<?php foreach ($loandata as $key => $listview) { ?>
								<td><?php echo $listview->mx_loan_id ?></td>
								<td><?php echo $listview->mx_loan_empcode ?></td>
								<td><?php echo $listview->employeename ?></td>
								<td><?php echo $listview->mx_loan_emp_loan_type ?></td>
								<td><?php echo $listview->mx_loan_tenure_months ?></td>
								<td><?php echo $listview->mx_loan_amount_appliedby_employee ?></td>
								<td><?php echo $listview->mx_loan_category ?></td>
								<td><?php echo $listview->mx_loan_applied_date ?></td>
								<td><?php if($listview->mx_loan_status == 1){ echo 'PENDING'; }elseif($listview->mx_loan_status == 2){ echo 'REJECTED'; }else{ echo 'APPROVED'; } ?></td>
								<td><a href='<?php echo base_url() ?>Loan_controller/editemployeeloandetails?emp=<?php echo $listview->mx_loan_empcode ?>&id=<?php echo $listview->mx_loan_pri_id ?>' class='btn btn-info'>View</a></td>
							</tr>
								<?php } ?>
								<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>