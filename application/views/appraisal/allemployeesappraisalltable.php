<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0" id="appraisalTable">
        <thead class="table-dark">
            <tr>
                <th style="width:50px;">#</th>
				<th>Current Stage</th>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Month</th>
                <th>Employee</th>
                <th>Manager</th>
				<th>Manager Name</th>
                <th>HOD</th>
				<th>HOD Name</th>
                <th>HR</th>
				<th>HR Name</th>
                <th>Reviewer</th>
				<th>Reviewer Name</th>
            </tr>
        </thead>

        <tbody>

        <?php
        if(!empty($alldata))
        {
            $i=1;

            foreach($alldata as $row)
            {
        ?>

        <tr class="parent-row"
            data-employee="<?php echo $row['mxap_assign_employee_code'];?>"
            data-month="<?php echo $row['mxap_assign_year_month'];?>">

            <td class="text-center">
				<?php echo $i;?>
				<button
					type="button"
					class="btn btn-sm btn-outline-primary expandRow"
					data-employee="<?php echo $row['mxap_assign_employee_code'];?>"
					data-month="<?php echo $row['mxap_assign_year_month'];?>"
					data-category="<?php echo $userdata['quecategory'];?>">
					<i class="fa fa-plus"></i>
				</button>
			</td>

			<td>
                <span class="badge bg-info">
                    <?php echo $row['current_stage'];?>
                </span>
            </td>

            <td>
                <a target="_blank" href="<?php echo base_url('performanceappraisal/openappraisalpdf'); ?>?employeeid=<?php echo $row['mxap_assign_employee_code']; ?>">
                    <?php echo $row['mxap_assign_employee_code']; ?>
                </a>
            </td>

            <td>
                <?php echo $row['mxemp_emp_fname'];?>
            </td>

            <td>
                <?php echo $row['department_name'];?>
            </td>

            <td>
                <?php echo date('M-Y',strtotime($row['mxap_assign_year_month'].'-01'));?>
            </td>

            <td>
                <span class="badge bg-<?php echo ($row['emp_status']=='COMPLETED')?'success':'warning';?>">
                    <?php echo $row['emp_progress'];?>
                </span>
            </td>

            <td>
                <span class="badge bg-<?php echo ($row['manager_status']=='COMPLETED')?'success':'warning';?>">
                    <?php echo $row['manager_progress'];?>
                </span>
            </td>

			<td><strong><?php echo $row['manager_name'] . ' (' . $row['manager_id'] . ')'; ?></strong></td>

            <td>
                <span class="badge bg-<?php echo ($row['hod_status']=='COMPLETED')?'success':'warning';?>">
                    <?php echo $row['hod_progress'];?>
                </span>
            </td>

			<td><strong><?php echo $row['hod_name'] . ' (' . $row['hod_id'] . ')'; ?></strong></td>

            <td>
                <span class="badge bg-<?php echo ($row['hr_status']=='COMPLETED')?'success':'warning';?>">
                    <?php echo $row['hr_progress'];?>
                </span>
            </td>

			<td><strong><?php echo $row['hr_name'] . ' (' . $row['hr_id'] . ')'; ?></strong></td>

            <td>
                <span class="badge bg-<?php echo ($row['reviewer_status']=='COMPLETED')?'success':'warning';?>">
                    <?php echo $row['reviewer_progress'];?>
                </span>
            </td>

			<td><strong><?php echo $row['reviewer_name'] . ' (' . $row['reviewer_id'] . ')'; ?></strong></td>

        </tr>

        <?php
            $i++;
            }
        }
        else
        {
        ?>

        <tr>
            <td colspan="12" class="text-center">
                No Records Found
            </td>
        </tr>

        <?php } ?>

        </tbody>

    </table>
</div>