<table class="table table-striped custom-table mb-0 datatable">
    <thead>
        <tr >
            <th>#</th>
            <th>Letter Status</th>
            <th>Type Of Letter</th>
            <th>Employee Code</th>
            <th>Person Name</th>
            <th>Letterno</th>
            <th>Application Date</th>
            <th>Effective Date</th>
            <th>Designation</th>
            <th>Place Of Posting</th>
            <th>Salary</th>
            <th>Basic</th>
            <th>HRA</th>
            <th>Created by</th>
            <th>Created Time</th>
            <th>Modify</th>
        </tr>
    </thead>
    <tbody>
        <?php $snoc = 1; foreach ($list['emailstemplates'] as $ckey => $cvalue) { ?>
        <tr>
            <td><?php echo $snoc; ?></td>
            <td><?php echo $app_status[$cvalue->letter_status]; ?></td>
            <td><?php echo $type[$cvalue->typeofletter]; ?></td>
            <td><?php echo $cvalue->employeecode; ?></td>
            <td><?php echo $cvalue->personname; ?></td>
            <td><?php echo $cvalue->letterno; ?></td>
            <td><?php echo $cvalue->appdate; ?></td>
            <td><?php echo $cvalue->effectivedate; ?></td>
            <td><?php echo $cvalue->designation; ?></td>
            <td><?php echo $cvalue->placeofposting; ?></td>
            <td><?php echo $cvalue->salary; ?></td>
            <td><?php echo $cvalue->basic; ?></td>
            <td><?php echo $cvalue->hra; ?></td>
            <td><?php echo $cvalue->createdby; ?></td>
            <td><?php echo $cvalue->createdtime; ?></td>
            <td>
                <a type="button" data-bs-toggle="modal" data-bs-target="#add_client_popup" onclick="letterform('<?php echo $cvalue->id ?>')" class="float-end btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <?php if($cvalue->lt_status == 1){ ?>
                <a style="margin-right: 10px;" type="button" onclick="deleteemailtemplateinfobyid('<?php echo $cvalue->id ?>','DeActivate')" class="float-end btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                <?php }else{ ?>
                <a style="margin-right: 10px;" type="button" onclick="deleteemailtemplateinfobyid('<?php echo $cvalue->id ?>','Activate')" class="float-end btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php $snoc++; } ?>
    </tbody>
</table>