<label>Unpay Salary Months</label>
<div class="form-group row">
        <!--MONTH LOOP -->
        <?php
        if($resign_status == 'N'){ //----->For Noice Period Employees Only we will build unpay sal
            $start_date = date('01-m-Y',strtotime($resign_date));
            $unpay_sal_date = date('Ym',strtotime($start_date));
            $unpay_sal_date_my = date('m-Y',strtotime($start_date));
            $end_date = date('01-m-Y',strtotime($relieve_date));
            
            while (strtotime($start_date) <= strtotime($end_date)) {
                // echo $start_date."<br>";
                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input inc_type" type="checkbox" name="unpay_months[]" value="<?php echo $unpay_sal_date; ?>">
                    <label class="form-check-label">
                        <?php echo $unpay_sal_date_my; ?>
                    </label>
                </div>
                <?php
                $unpay_sal_date = date ("Ym", strtotime("+1 month", strtotime($start_date)));
                $unpay_sal_date_my = date ("m-Y", strtotime("+1 month", strtotime($start_date)));
                $start_date = date ("d-m-Y", strtotime("+1 month", strtotime($start_date)));
            }
        }
        ?>
        
        <!--END MONTH LOOP-->
        <span class="formerror" id="variablepay_error"></span>
</div>