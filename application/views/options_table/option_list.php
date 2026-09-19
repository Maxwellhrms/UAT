<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">

                <div class="col">
                    <h3 class="page-title">Options Table</h3>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>admin/dashboard">
                                Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Mobile User Permissions
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->


        <div class="row" style="margin-top: 10px;">

            <div class="container">

                <!-- ========================= -->
                <!-- ADD NEW OPTION BUTTON -->
                <!-- ========================= -->

                <button type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#myModal">
                    New Option
                </button>


                <!-- ========================= -->
                <!-- CREATE OPTION MODAL -->
                <!-- ========================= -->

                <div class="modal fade"
                     id="myModal"
                     tabindex="-1"
                     role="dialog"
                     aria-hidden="true">

                    <div class="modal-dialog"
                         role="document">

                        <div class="modal-content">

                            <form method="post"
                                  id="create_option"
                                  enctype="multipart/form-data">

                                <!-- Modal Header -->
                                <div class="modal-header">

                                    <h4 class="modal-title">
                                        Create new option
                                    </h4>

                                    <button type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close">

                                        <span aria-hidden="true">
                                            &times;
                                        </span>

                                    </button>

                                </div>


                                <!-- Modal Body -->
                                <div class="modal-body">

                                    <div class="form-group">

                                        <label for="field_name">
                                            Option Name:
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               id="field_name"
                                               disabled>

                                    </div>


                                    <div class="form-group">

                                        <span style="color:red;">
                                            Note: value must not be 0 or empty
                                        </span>

                                        <br>

                                        <label for="fied_value">
                                            Value:
                                        </label>

                                        <input type="text"
                                               class="form-control numeric"
                                               id="fied_value"
                                               onkeypress="return /[0-9a-zA-Z]/i.test(event.key)">

                                        <span id="fied_value_err"
                                              style="color:red;">
                                        </span>

                                    </div>


                                    <div class="form-group">

                                        <label for="descr">
                                            Description:
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               id="descr">

                                    </div>

                                </div>


                                <!-- Modal Footer -->
                                <div class="modal-footer">

                                    <button type="button"
                                            class="btn btn-danger"
                                            data-dismiss="modal">
                                        Close
                                    </button>

                                    <button type="submit"
                                            id="submit"
                                            class="btn btn-info">
                                        Submit
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
                <!-- END CREATE OPTION MODAL -->


            </div>


            <!-- ========================= -->
            <!-- OPTIONS LIST -->
            <!-- ========================= -->

            <div class="col-sm-12">

                <div class="card mb-0">

                    <div class="card-header">

                        <h4 class="card-title mb-0">
                            Option Table List
                        </h4>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="datatable table table-stripped mb-0"
                                   id="dataTables-example">

                                <thead>

                                    <tr>

                                        <th>Sno</th>

                                        <th>Option Name</th>

                                        <th>Value</th>

                                        <th>Description</th>

                                        <th>Status</th>

                                        <th>Action</th>

                                        <!-- Hidden ID -->
                                        <th style="display:none;">
                                            ID
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php

                                    $status = array(
                                        '1' => 'ACTIVE',
                                        '0' => 'INACTIVE'
                                    );

                                    $sno = 1;

                                    foreach ($option_list as $key => $value) {

                                    ?>

                                        <tr>

                                            <td>
                                                <?php echo $sno; ?>
                                            </td>


                                            <td>
                                                <?php echo $value->field_name; ?>
                                            </td>


                                            <td>
                                                <?php echo $value->field_value; ?>
                                            </td>


                                            <td>
                                                <?php echo $value->descr; ?>
                                            </td>


                                            <td>

                                                <?php

                                                echo isset(
                                                    $status[$value->options_status]
                                                )
                                                    ? $status[$value->options_status]
                                                    : '';

                                                ?>

                                            </td>


                                            <td>

                                                <!-- EDIT BUTTON -->
                                            <button type="button"
                                                    class="btn btn-primary edit"
                                                    data-toggle="modal"
                                                    data-target="#myModalupdate">
                                                Edit
                                            </button>

                                            </td>


                                            <!-- Hidden ID -->
                                            <td style="display:none;">

                                                <?php echo $value->id; ?>

                                            </td>

                                        </tr>

                                    <?php

                                        $sno++;

                                    }

                                    ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- END ROW -->


        <!-- ========================= -->
        <!-- UPDATE OPTION MODAL -->
        <!-- ========================= -->

        <div class="modal fade"
             id="myModalupdate"
             tabindex="-1"
             role="dialog"
             aria-hidden="true">

            <div class="modal-dialog"
                 role="document">

                <div class="modal-content">

                    <form method="post"
                          id="update_option"
                          enctype="multipart/form-data">


                        <!-- Modal Header -->
                        <div class="modal-header">

                            <h4 class="modal-title">
                                Update option
                            </h4>

                            <button type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close">

                                <span aria-hidden="true">
                                    &times;
                                </span>

                            </button>

                        </div>


                        <!-- Modal Body -->
                        <div class="modal-body">


                            <!-- Option Name -->
                            <div class="form-group"
                                 style="display:none;">

                                <label for="up_field_name">
                                    Option Name:
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="up_field_name">

                            </div>


                            <!-- Value -->
                            <div class="form-group">

                                <span style="color:red;">
                                    Note: value must not be 0 or empty
                                </span>

                                <br>

                                <label for="up_fied_value">
                                    Value:
                                </label>

                                <input type="text"
                                       class="form-control numeric"
                                       id="up_fied_value"
                                       disabled>

                                <span id="up_fied_value_err"
                                      style="color:red;">
                                </span>

                            </div>


                            <!-- Description -->
                            <div class="form-group">

                                <label for="up_descr">
                                    Description:
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="up_descr">

                            </div>


                            <!-- Status -->
                            <div class="form-group">

                                <label for="up_options_status">
                                    Status:
                                </label>

                                <select class="form-control"
                                        id="up_options_status">
                                </select>

                            </div>

                        </div>


                        <!-- Modal Footer -->
                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-danger"
                                    data-dismiss="modal">
                                Close
                            </button>

                            <button type="button"
                                    id="up_submit"
                                    class="btn btn-info"
                                    onclick="return update_form(this.value)">
                                Submit
                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>
        <!-- END UPDATE OPTION MODAL -->


    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->


<!-- ========================= -->
<!-- URL PARAMETER SCRIPT -->
<!-- ========================= -->

<script>

var url_string = window.location.href;

var url = new URL(url_string);

var field_name = url.searchParams.get("field_name");

$('#field_name').val(field_name);

</script>


<!-- ========================= -->
<!-- NUMERIC INPUT VALIDATION -->
<!-- ========================= -->

<script>

var specialKeys = new Array();

specialKeys.push(8); // Backspace


$(function () {

    $(".numeric").bind("keypress", function (e) {

        var keyCode = e.which
            ? e.which
            : e.keyCode;

        var ret =
            (
                (keyCode > 64 && keyCode < 91) ||
                (keyCode > 96 && keyCode < 123) ||
                keyCode == 8 ||
                keyCode == 32 ||
                (keyCode >= 48 && keyCode <= 57) ||
                specialKeys.indexOf(keyCode) != -1
            );

        return ret;

    });


    $(".numeric").bind("paste", function (e) {

        return false;

    });


    $(".numeric").bind("drop", function (e) {

        return false;

    });


    $(".numeric").bind("cut", function (e) {

        return false;

    });


    $(".numeric").bind("copy", function (e) {

        return false;

    });

});

</script>


<!-- ========================= -->
<!-- CREATE OPTION -->
<!-- ========================= -->

<script>

$(document).on('submit', '#create_option', function (e) {

    e.preventDefault();

    var f_name = $('#field_name').val();

    var f_val = $('#fied_value').val();

    var f_decr = $('#descr').val();

    f_val = f_val.trim();


    // Clear previous error
    $('#fied_value_err').html('');


    if (f_val == 0) {

        $('#fied_value_err').html(
            'pls enter a value'
        );

        return false;

    }
    else if (f_val == '') {

        $('#fied_value_err').html(
            'space not allowed'
        );

        return false;

    }
    else {

        $.ajax({

            type: "post",

            url: "<?php echo base_url(); ?>Options_table_controller/option_create",

            data: {

                f_name: f_name,

                f_val: f_val,

                f_decr: f_decr

            },

            success: function (data) {
                if (data == 'already exist') {

                    $('#fied_value_err').html(
                        'value already exist'
                    );

                }
                else {

                    location.reload();

                }

            },

            error: function (xhr, status, error) {

                console.log('Create Error:', error);

            }

        });

    }

});

</script>


<!-- ========================= -->
<!-- UPDATE OPTION -->
<!-- ========================= -->

<script>

function update_form(opt_val) {

    var f_id = opt_val;

    var f_name = $('#up_field_name').val();

    var f_val = $('#up_fied_value').val();

    var f_decr = $('#up_descr').val();

    var f_status =
        $('#up_options_status :selected').val();

    f_val = f_val.trim();


    // Clear previous error
    $('#up_fied_value_err').html('');


    if (f_val == 0) {

        $('#up_fied_value_err').html(
            'pls enter a value'
        );

        return false;

    }
    else if (f_val == '') {

        $('#up_fied_value_err').html(
            'space not allowed'
        );

        return false;

    }
    else {

        $.ajax({

            type: "post",

            url: "<?php echo base_url(); ?>Options_table_controller/option_update",

            data: {

                f_name: f_name,

                f_val: f_val,

                f_decr: f_decr,

                f_status: f_status,

                f_id: f_id

            },

            success: function (data) {
                if (data == 'already exist') {

                    $('#up_fied_value_err').html(
                        'value already exist'
                    );

                }
                else {

                    location.reload();

                }

            },

            error: function (xhr, status, error) {

                console.log('Update Error:', error);

            }

        });

    }

}


<!-- ========================= -->
<!-- EDIT BUTTON -->
<!-- ========================= -->

$(document).on('click', '.edit', function (e) {

    e.preventDefault();

    var row = $(this).closest('tr');

    var up_field_name = row.find('td').eq(1).text().trim();
    var up_fied_value = row.find('td').eq(2).text().trim();
    var up_descr = row.find('td').eq(3).text().trim();
    var up_options_status = row.find('td').eq(4).text().trim();
    var up_id = row.find('td').eq(6).text().trim();

    $('#up_field_name').val(up_field_name);
    $('#up_fied_value').val(up_fied_value);
    $('#up_descr').val(up_descr);
    $('#up_submit').val(up_id);

    $('#up_options_status').empty();

    if (up_options_status == 'ACTIVE') {

        $('#up_options_status').append(
            '<option value="1" selected>Active</option>'
        );

        $('#up_options_status').append(
            '<option value="0">Inactive</option>'
        );

    } else {

        $('#up_options_status').append(
            '<option value="1">Active</option>'
        );

        $('#up_options_status').append(
            '<option value="0" selected>Inactive</option>'
        );
    }

});


$('#myModalupdate').on('hidden.bs.modal', function () {

    $('.modal-backdrop').remove();

    $('body').removeClass('modal-open');

    $('body').css('padding-right', '');

});

</script>