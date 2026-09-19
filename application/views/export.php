<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter Export Example</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
     
    <div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">First Name</th>
                <th class="header">Last Name</th>                           
                <th class="header">Email</th>                      
                <th class="header">DOB</th>
                <th class="header">Contact Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($export_list) && !empty($export_list)) {
                foreach ($export_list as $key => $list) {
                    ?>
                    <tr>
                        <td><?php echo $list->first_name; ?></td>   
                        <td><?php echo $list->last_name; ?></td> 
                        <td><?php echo $list->email; ?></td>                       
                        <td><?php echo $list->dob; ?></td>
                        <td><?php echo $list->contact_no; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">There is no employee.</td>    
                </tr>
            <?php } ?>
 
        </tbody>
    </table>
    <a class="pull-right btn btn-primary btn-xs" href="export/generateXls"><i class="fa fa-file-excel-o"></i> Export Data</a>
    </div> 
 
</body>
</html>