<?php if(!empty($popupdetails)){ ?>
    <?php 
    $headers = array_keys($popupdetails[0]); 
    $skiparray = array('CL','SL','EL','ML');
    ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle hrms_employee_table" id="hrmsEmployeeTable">
            <thead class="table-light">
                <tr>
                    <?php foreach($headers as $header){ ?>
                    <?php if($header == 'Employee Image'){ continue; } ?>
                        <th><?php echo $header; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="hrmsEmployeeTableBody">
                <?php foreach($popupdetails as $key => $val){ ?>
                    <tr>
                        <?php foreach($headers as $header){ ?>
                            <?php if($header == 'Employee Image'){ continue; } ?>
                            <td>
                                <?php
                                    $value = isset($val[$header]) ? $val[$header] : '';
                                    // Employee Name with Image
                                    if($header == 'Employee Name'){
                                        $image = !empty($val['Employee Image']) ? HRADMINROOTDOCUMENT.$val['Employee Image']: base_url('assets/images/default-user.png');
                                    ?>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="<?php echo $image; ?>" alt="Employee"style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:1px solid #ddd;">
                                            <span>
                                                <?php echo $value; ?>
                                            </span>
                                        </div>
                                <?php } elseif($header == 'Status'){
                                        if(strtolower($value) == 'present'){
                                            echo '<span class="badge bg-success">Present</span>';
                                        }
                                        elseif(strtolower($value) == 'absent'){
                                            echo '<span class="badge bg-danger">Absent</span>';
                                        }
                                        else{
                                            echo $value;
                                        }
                                    }else{
                                        echo $value;
                                    }
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }else{ ?>
    <div class="text-center p-5">
        <h5>No Employees Found</h5>
    </div>
<?php } ?>