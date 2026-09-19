<?php if (count($common) > 0) { ?>
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="dataTables-example1" style="border-collapse: collapse; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="17" class="text-center" style="border:none; padding-bottom: 20px;">
                                    <h3 class="mb-0">MAXWELL LOGISTICS PVT. LIMITED</h3>
                                    <h4 style="margin-top:0;">LEAVE REGISTER</h4>
                                </th>
                            </tr>
                            <tr style="background: #f9f9f9;">
                                <th colspan="2" style="border: 1px solid #000;">Name of Employee:</th>
                                <th colspan="4" style="border: 1px solid #000; font-weight: normal;"><?= $header['employee_name'] ?></th>
                                <th colspan="2" style="border: 1px solid #000;">Designation:</th>
                                <th colspan="3" style="border: 1px solid #000; font-weight: normal;"><?= $header['designation'] ?></th>
                                <th colspan="3" style="border: 1px solid #000;">Employee Code:</th>
                                <th colspan="3" style="border: 1px solid #000; font-weight: normal;"><?= $header['employee_code'] ?></th>
                            </tr>
                            <tr style="background: #f9f9f9;">
                                <th colspan="2" style="border: 1px solid #000;">Date of Joining:</th>
                                <th colspan="4" style="border: 1px solid #000; font-weight: normal;"><?= $header['doj'] ?></th>
                                <th colspan="2" style="border: 1px solid #000;">Date of Birth:</th>
                                <th colspan="3" style="border: 1px solid #000; font-weight: normal;"><?= $header['dob'] ?></th>
                                <th colspan="3" style="border: 1px solid #000;">Branch:</th>
                                <th colspan="3" style="border: 1px solid #000; font-weight: normal;"><?= $header['branch'] ?></th>
                            </tr>
                            <tr>
                                <th rowspan="2" style="border: 1px solid #000;">YEAR</th>
                                <th rowspan="2" style="border: 1px solid #000;">MONTH</th>
                                <th colspan="3" class="text-center" style="border: 1px solid #000;">ATTENDANCE</th>
                                <th colspan="2" class="text-center" style="border: 1px solid #000;">C.L.</th>
                                <th colspan="2" class="text-center" style="border: 1px solid #000;">P.L. (EL)</th>
                                <th colspan="2" class="text-center" style="border: 1px solid #000;">S.L.</th>
                                <th rowspan="2" style="border: 1px solid #000;">MATR.</th>
                                <th rowspan="2" style="border: 1px solid #000;">LOP</th>
                                <th rowspan="2" style="border: 1px solid #000;">ABST.</th>
                                <th rowspan="2" style="border: 1px solid #000;">SHRT.</th>
                                <th rowspan="2" style="border: 1px solid #000;">TOTAL DAYS PAID</th>
                                <th rowspan="2" style="border: 1px solid #000; width: 250px;">Remarks</th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #000;">PRST</th>
                                <th style="border: 1px solid #000;">W.OFF</th>
                                <th style="border: 1px solid #000;">PH</th>
                                <th style="border: 1px solid #000;">USED</th>
                                <th style="border: 1px solid #000;">AVAIL</th>
                                <th style="border: 1px solid #000;">USED</th>
                                <th style="border: 1px solid #000;">AVAIL</th>
                                <th style="border: 1px solid #000;">USED</th>
                                <th style="border: 1px solid #000;">AVAIL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $prevYearBF = isset($encashment['el_balance_cf']) && ($prev_year_el > $encashment['el_balance_cf']) ? 30 : $prev_year_el;

                            // Initialize Totals
                            $total_prst = 0; $total_woff = 0; $total_ph = 0;
                            $total_cl_used = 0; $total_el_used = 0; $total_sl_used = 0;
                            $total_matr = 0; $total_lop = 0; $total_abst = 0; $total_shrt = 0; $total_paid = 0;
                            ?>
                            <tr style="background-color: #ffc0cb;">
                                <td colspan="2" style="border: 1px solid #000;"><strong>Balance B/F.</strong></td>
                                <td colspan="3" style="border: 1px solid #000;"></td>
                                <td colspan="2" style="border: 1px solid #000;"></td>
                                <td style="border: 1px solid #000; text-align: center; color: red;"><strong></strong></td>
                                <td style="border: 1px solid #000;"><?=$prevYearBF?></td>
                                <td colspan="2" style="border: 1px solid #000;"></td>
                                <td colspan="5" style="border: 1px solid #000;"></td>
                                <td style="border: 1px solid #000;"></td>
                            </tr>

                            <?php $row_idx = 0; foreach ($common as $row): $row_idx++;
                                // Accumulate Totals
                                $total_prst += $row['Present'];
                                $total_woff += $row['W.Off'];
                                $total_ph   += $row['Holidays'];
                                $total_cl_used += $row['CL_Used'];
                                $total_el_used += $row['PL_Used'];
                                $total_sl_used += $row['SL_Used'];
                                $total_matr += $row['Matr'];
                                $total_lop  += $row['LOP'];
                                $total_abst  += $row['Abst'];
                                $total_shrt += $row['Shrt'];
                                $total_paid += $row['Total_Paid'];
                                ?>
                                <tr>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Year'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Month'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= number_format($row['Present'], 1) ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['W.Off'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Holidays'] ?></td>

                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['CL_Used'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['CL_Avail'] ?></td>

                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['PL_Used'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['PL_Avail'] ?></td>

                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['SL_Used'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['SL_Avail'] ?></td>

                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Matr'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['LOP'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Abst'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center;"><?= $row['Shrt'] ?></td>
                                    <td style="border: 1px solid #000; text-align: center; font-weight: bold;"><?= $row['Total_Paid'] ?></td>
                                    <td style="padding: 0; vertical-align: top; border: 1px solid #000; width: 250px;">
                                        <?php
                                        $remark_label = ""; $remark_val = ""; $bg = "";
                                        if ($row_idx == 1) { $remark_label = ""; }
                                        elseif ($row_idx == 2) { $remark_label = "Balance B/F: "; $remark_val = $prevYearBF; $bg = "#ffc0cb"; }
                                        elseif ($row_idx == 3) { $remark_label = ""; }
                                        elseif ($row_idx == 4) { $remark_label = ""; }
                                        elseif ($row_idx == 5) { $remark_label = ""; }
                                        elseif ($row_idx == 6) {
                                            $remark_label = "Balance C/F: ";
                                            $remark_val = $lastEL;
                                            $bg = "#fff9c4";
                                        }
                                        elseif ($row_idx == 9) { $remark_label = "Leave Encashed On"; }
                                        elseif ($row_idx == 10) {
                                            $remark_label = "Amount Paid Rs.";
                                            $remark_val = isset($encashment['leave_encashment_amount']) ? number_format($encashment['leave_encashment_amount'], 0) : "0.00";
                                        }
                                        elseif ($row_idx == 11) {
                                            $remark_label = "Leave Amount Carry Forward:";
                                            $remark_val = isset($encashment['leave_amount_carry_forward']) ? number_format($encashment['leave_amount_carry_forward'], 0) : "0.00";
                                        }
                                        ?>
                                        <div style="display: flex; min-height: 25px; height: 100%; background: <?=$bg?>;">
                                            <div style="flex: 0 0 70%; padding: 2px; border-right: 1px solid #000; font-size: 11px;">
                                                <strong><?= $remark_label ?: "-" ?></strong>
                                            </div>
                                            <div style="flex: 1; padding: 2px; text-align: center; font-size: 11px;">
                                                <?= $remark_val ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr style="font-weight: bold; background: #f1f1f1;">
                                <td colspan="2" style="border: 1px solid #000; text-align: right;">Total >>></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= number_format($total_prst, 1) ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_woff ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_ph ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_cl_used ?></td>
                                <td style="border: 1px solid #000; text-align: center;"></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_el_used ?></td>
                                <td style="border: 1px solid #000; text-align: center; background: #fff9c4;"><?= $row['lastEL'] ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_sl_used ?></td>
                                <td style="border: 1px solid #000; text-align: center;"></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_matr ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_lop ?></td>
                                <td style="border: 1px solid #000; text-align: center;""><?= $total_abst ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_shrt ?></td>
                                <td style="border: 1px solid #000; text-align: center;"><?= $total_paid ?></td>
                                <td style="border: 1px solid #000;"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>