<!-- Search Filter -->
<?php $controller->commonFilters(array(
    'fromdatefilter' => 'Y',
    'todatefilter' => 'Y',
    'companyfilter' => 'Y',
    'divisionfilter' => 'Y',
    'statefilter' => 'Y',
    'branchfilter' => 'Y',
    'employeecodeFilter' => 'Y',
    'issynced' => 'Y',
    'FormId' => 'employeesslhistory',
    'CallFunction' => 'employeeesslhistory_list'
)); ?>
<!-- Search Filter -->
<hr>
<!-- <a class="btn btn-primary" href="https://maxwellhrms.in/cron/get_essl_attendance_cron" target="_blank">Get Essl Attendance</a>
<a class="btn btn-primary" href="https://maxwellhrms.in/cron/essl_attendance_cron" target="_blank">Update Attendance</a> -->

<button type="button" class="btn btn-primary" id="getEsslAttendance">
    Get Essl Attendance
</button>

<button type="button" class="btn btn-success" id="updateAttendance">
    Update Attendance
</button>

<a type="button" class="btn btn-info" href="https://maxwellhrms.in/cron/cron_get_attendance_before_grace_time" target="_blank">
    Mark Pr's onTime
</a>
<hr>
<!-- /Page Content -->
</div>

<script>
$(document).ready(function () {

    function triggerAttendanceCron(url, button) {

        let fromdate = $('#fromdate').val();

        if (fromdate == '') {
            alert('Please select from date');
            return false;
        }

        let originalText = $(button).html();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                attendance: fromdate
            },
            beforeSend: function () {
                $(button).prop('disabled', true).html('Processing...');
            },
            success: function (response) {

                console.log(response);

                alert('Process completed successfully');

            },
            error: function (xhr) {

                console.log(xhr.responseText);

                alert('Something went wrong');

            },
            complete: function () {
                $(button).prop('disabled', false).html(originalText);
            }
        });
    }

    $('#getEsslAttendance').click(function () {

        triggerAttendanceCron(
            baseurl+'cron/get_essl_attendance_cron',
            this
        );

    });

    $('#updateAttendance').click(function () {

        triggerAttendanceCron(
            baseurl+'cron/essl_attendance_cron',
            this
        );

    });

});
</script>