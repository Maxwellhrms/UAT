    <?php
    $firstEmployee = reset($dashboard['employeeattendance']);
    $firstDay      = reset($firstEmployee);

    $year  = $firstDay['year'];
    $month = $firstDay['month'];

    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
    $attendanceData = $dashboard['employeeattendance'];
    ?>

    <div class="cal-card">

        <!-- HEADER -->
        <div class="cal-header">

<!--             <div>
                <button class="cal-btn">&#10094;</button>
                <button class="cal-btn ml-1">&#10095;</button>
            </div> -->

            <div class="cal-title">
                <?= date('F Y', strtotime("$year-$month-01")) ?>
            </div>

        </div>

        <div class="cal-wrapper">

            <div class="cal-table">

                <!-- TOP HEADER -->
                <div class="cal-row">

                    <!-- EMPLOYEE COLUMN -->
                    <div class="cal-name-col sticky-col">
                        <div class="cal-head-name">
                            Employees (<?php echo count($attendanceData); ?>)
                        </div>
                    </div>

                    <!-- DAYS -->
                    <div class="cal-days">

                        <?php for($d = 1; $d <= $totalDays; $d++): ?>

                            <?php
                            $date = "$year-$month-" . sprintf('%02d', $d);
                            $dayName = substr(date('D', strtotime($date)), 0, 2);

                            $isWeekend = (date('w', strtotime($date)) == 0);
                            ?>

                            <div class="cal-cell cal-head">

                                <div class="cal-day-name">
                                    <?= $dayName ?>
                                </div>

                                <strong>
                                    <?= $d ?>
                                </strong>

                            </div>

                        <?php endfor; ?>

                    </div>

                </div>

                <!-- EMPLOYEE ROWS -->
                <?php $sno = 1; foreach($attendanceData as $employeeCode => $days): ?>

                    <?php
                    $employee = reset($days);

                    $employeeName  = $employee['name'];
                    $companyname = $employee['companyname'];
                    $divisionname = $employee['divisionname'];
                    $statename = $employee['statename'];
                    $branchname = $employee['branchname'];
                    // $employeeImage = base_url('assets/img/user.jpg');
                    $employeeImage = !empty($employee['img']) ? HRADMINROOTDOCUMENT.$employee['img']: base_url('assets/img/user.jpg');
                    ?>

                    <div class="cal-row">

                        <!-- EMPLOYEE INFO -->
                        <div class="cal-name-col sticky-col">

                            <div class="cal-name">

                                <img src="<?= $employeeImage ?>" class="cal-avatar">

                                <div class="cal-emp-details">
                                    <div class="emp-name">
                                        <?= $employeeName ?>
                                    </div>

                                    <div class="emp-code">
                                        Employee Code:- <?= $employeeCode ?><br>
                                        Division:- <?= $divisionname ?><br>
                                        State:- <?= $statename ?><br>
                                        Branch:- <?= $branchname ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- DAY CELLS -->
                        <div class="cal-days">

                            <?php for($d = 1; $d <= $totalDays; $d++): ?>

                                <?php
                                $attendance = isset($days[$d]) ? $days[$d] : [];

                                $statusClass = isset($attendance['class'])
                                    ? $attendance['class']
                                    : 'default';

                                $firstHalf = isset($attendance['first_half'])
                                    ? $attendance['first_half']
                                    : '-';

                                $secondHalf = isset($attendance['second_half'])
                                    ? $attendance['second_half']
                                    : '-';

                                $firstPunch = isset($attendance['first_punch'])
                                    ? $attendance['first_punch']
                                    : '';

                                $secondPunch = isset($attendance['second_punch'])
                                    ? $attendance['second_punch']
                                    : '';
                                ?>

                                <div class="cal-cell">

                                    <div class="attendance-box <?= $statusClass ?>">

                                        <!-- STATUS -->
                                        <div class="attendance-status">
                                            <?= $firstHalf ?>/<?= $secondHalf ?>
                                        </div>

                                        <!-- FIRST PUNCH -->
                                        <?php if(!empty($firstPunch)): ?>
                                            <div class="attendance-time">
                                                IN : <?= explode(',', $firstPunch)[0] ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- SECOND PUNCH -->
                                        <?php if(!empty($secondPunch)): ?>
                                            <div class="attendance-time">
                                                OUT : <?= explode(',', $secondPunch)[0] ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endfor; ?>

                        </div>

                    </div>

                <?php $sno++; endforeach; ?>

            </div>

        </div>

    </div>