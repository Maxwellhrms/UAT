<div class="table-responsive">
    <table class="datatable table table-stripped mb-0" id="dataTables-example1">
        <thead>
            <tr>
                <th>Type</th>
                <th>Application</th>
                <th>Category</th>
                <th>Company</th>
                <th>Division</th>
                <th>State</th>
                <th>Branch</th>
                <th>Refrence</th>
                <th>Hearing Date</th>
                <th>Reminder Date</th>
                <th>Follow up Date</th>
                <th>Filed By</th>
                <th>Filed To</th>
                <th>Message</th>
                <th>Created by</th>
                <th>Created Time</th>
                <th>Modified by</th>
                <th>Modified Time</th>
               </tr>
        </thead>
        <tbody>
		    <?php foreach($info as $key => $val){ ?>
			<tr>
			    <td><?php echo $val->mx_ntf_type ?></td>
				<td><?php echo $val->mx_ntf_appid ?></td>
				<td><?php echo $val->mx_ntf_category ?></td>
				<td><?php echo $val->mxcp_name ?></td>
				<td><?php echo $val->mxd_name ?></td>
				<td><?php echo $val->mxst_state ?></td>
				<td><?php echo $val->mxb_name ?></td>
				<td><?php echo $val->mx_ntf_refrencce  ?></td>
				<td><?php echo $val->mx_ntf_hearing_date ?></td>
				<?php $reminder = config('notification_reminder'); if($val->mx_ntf_followup_date == ''){$rm = $val->mx_ntf_hearing_date;}else{ $rm = $val->mx_ntf_followup_date; } ?>
				<td><?php echo date('d-m-Y', strtotime($rm. ' -'. $reminder[0]->notification_reminder .'days')); ?></td>
				<td><?php echo $val->mx_ntf_followup_date ?></td>
				<td><?php echo $val->mx_ntf_filedby ?></td>
				<td><?php echo $val->mx_ntf_filedto ?></td>
				<td><?php echo $val->mx_ntf_description ?></td>
				<td><?php echo $val->mx_ntf_createdby ?></td>
				<td><?php echo $val->mx_ntf_createdtime ?></td>
				<td><?php echo $val->mx_ntf_modifyby ?></td>
				<td><?php echo $val->mx_ntf_modifiedtime ?></td>
				
			</tr>
			<?php } ?>

        </tbody>
    </table>
</div>