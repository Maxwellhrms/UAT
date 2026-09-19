//--------FOR SUBMIT 
$(document).ready(function () {


    $("form#add_employee_attendance_form").submit(function (e) {
        e.preventDefault();

        var attendance_year = $("#attendance_year").val();
        if (attendance_year == "") {
            $("#attendance_year").focus();
            $('#attendance_year_error').html("Please Select Attendance Year...");
            return false;
        } else {
            $('#attendance_year_error').html("");
        }





        // if (page_type == 1) {
        var mainurl = baseurl + 'attendance_controller/add_employee_attandance_tables_in_db';
        // } else if (page_type == 2) {
        // var mainurl = baseurl + 'admin/update_deduction_type';
        // }

        var formData = new FormData(this);
        $.ajax({
            url: mainurl,
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                console.log(data);
                // return false;
                if (data == 200) {
                    alert('Successfully Created Employee Data In the Attendance Tables.....');
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else if (data == 420) {
                    alert('Failed To Save Please TryAgain later');
                    return false;
                }
                else if (data == 520) {
                    alert('Somethig Went Wrong in Attendance Year...');
                    return false;
                } else if (data == 425) {
                    alert('No Employees Found In the Employee Info Table...');
                    return false;
                } else if (data == 120) {
                    alert("Data Already Exist You Cant Add Employee Attendance Data Again....");
                    return false;
                } else if (data == 143) {
                    alert("One Of The Month Table not exists Please Check Once......");
                    return false;
                } else if (data = 600) {
                    alert("Table Not Exist Create Table Before Adding Data in the Table......");
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

    });

    //----------------NEW BY CHANDANA
    // alert();
    $("#attendance_year").change(function () {
        getAttendance_table();
    });
    function getAttendance_table() {
        var year = $("#attendance_year").val();
        $.ajax({
            url: baseurl + 'attendance_controller/getattendancetable',
            type: 'POST',
            data: { year: year },
            async: false,
            success: function (data) {
                //console.log(data);
                $('#attendancecheck').html(data);
            }
        });
    }

    $(document).on("click", ".create_tab", function () {
        var yd = $('#cretab').val();
        $.ajax({
            url: baseurl + 'attendance_controller/createspecificattendancetable ',
            type: 'POST',
            data: { year: yd },
            async: false,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    alert("Table Created Successfully....");
                    getAttendance_table();
                    return false;
                } else {
                    alert('Failed To Create Table.....');
                    setTimeout(function () {
                        window.location.reload();
                    }, 100);
                }
            }
        });

    });

    //----------------END NEW BY CHANDANA

    $(document).on("click", ".create_attend_tab", function () {
        var yearmonth = $(this).val();
        createattandancetable(yearmonth)
    });
    function createattandancetable(yearmonth) {
        $.ajax({
            url: baseurl + 'attendance_controller/attendancemonthyear',
            type: 'POST',
            data: { year: yearmonth },
            async: false,
            success: function (data) {
                // console.log(data);
                // alert(data)
                if (data == 200) {
                    alert('Successfully Attandence inserted ....');
                    getAttendance_table()
                }
            }
        });
    }




});
    //--------FOR SUBMIT