<style>
    .select2-results__option small {
    display: block;
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

.select2-results__option--highlighted small {
    color: #ffffff !important;
}

.select2-results__option--highlighted {
    background: #4f8df7 !important;
}
</style>
<div class="card">
    <div class="card-header bg-primary text-white">
        Employee Authorizations
    </div>

    <div class="card-body">

        <table class="table table-bordered" id="authorizationTable">
            <thead>
                <tr>
                    <th width="35%">Employee</th>
                    <th width="20%">Action</th>
                    <th width="15%">Is Manager</th>
                    <th width="15%">Is HOD</th>
                    <th width="10%">Is HR</th>
                    <th width="15%">Remove</th>
                </tr>
            </thead>

            <tbody id="authorizationBody">

            <?php if(!empty($allemployeesauthorizations)){ ?>

                <?php foreach($allemployeesauthorizations as $auth){ ?>

                    <tr>

                    <input type="hidden"
                        class="authorization-id"
                        value="<?php echo $auth['mxauth_id'] ?? 0; ?>">

                        <td>
                            <select class="form-control employee-dropdown"
                                    name="employeeid[]">

                                <option value="">Select Employee</option>

                                <?php foreach($allemployees as $emp){ ?>

                                    <option value="<?php echo $emp['mxemp_emp_id']; ?>"
                                            data-department="<?php echo $emp['mxdpt_name']; ?>"
                                            data-division="<?php echo $emp['mxd_name']; ?>"
                                            data-branch="<?php echo $emp['mxb_name']; ?>"
                                            <?php echo ($auth['mxauth_employeeid'] == $emp['mxemp_emp_id']) ? 'selected' : ''; ?>>
                                        <?php echo $emp['employee_name'].' ('.$emp['mxemp_emp_id'].')'; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </td>

                        <td>
                            <select class="form-control" name="action[]">
                                <option value="add"
                                    <?php echo ($auth['mxauth_action']=='add')?'selected':''; ?>>
                                    Add
                                </option>

                                <option value="view"
                                    <?php echo ($auth['mxauth_action']=='view')?'selected':''; ?>>
                                    View
                                </option>
                            </select>
                        </td>

                        <td class="text-center">
                            <input type="checkbox"
                                class="manager-checkbox"
                                name="ismanager[]"
                                <?php echo ($auth['mxauth_ismanager']==1)?'checked':''; ?>>
                        </td>

                        <td class="text-center">
                            <input type="checkbox"
                                class="hod-checkbox"
                                name="ishod[]"
                                <?php echo ($auth['mxauth_ishod']==1)?'checked':''; ?>>
                        </td>

                        <td class="text-center">
                            <input type="checkbox"
                                class="hr-checkbox"
                                name="ishr[]"
                                <?php echo ($auth['mxauth_ishr']==1)?'checked':''; ?>>
                        </td>

                        <td class="text-center">
                            <button type="button"
                                    class="btn btn-danger remove-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <!-- Empty Row -->

            <?php } ?>

            </tbody>

        </table>

        <button type="button"
                class="btn btn-info"
                id="addAuthorizationRow">
            <i class="fa fa-plus"></i>
            Add Employee
        </button>

        <button type="button"
                class="btn btn-success float-right"
                id="saveAuthorization">
            Save Authorization
        </button>

    </div>
</div>

<script>
    $(document).ready(function () {

function formatEmployee(employee) {

    if (!employee.id) {
        return employee.text;
    }

    var department = $(employee.element).data('department') || '';
    var division   = $(employee.element).data('division') || '';
    var branch     = $(employee.element).data('branch') || '';

    return $(
        '<div>' +
            '<div><strong>' + employee.text + '</strong></div>' +
            '<small class="text-muted">' +
                'Department: ' + department + '<br>' +
                'Division: ' + division + '<br>' +
                'Branch: ' + branch +
            '</small>' +
        '</div>'
    );
}

    function initializeEmployeeSelect2(element) {

        $(element).select2({
            width: '100%',
            placeholder: 'Select Employee',
            allowClear: true,
            templateResult: formatEmployee,
            templateSelection: function(employee) {
                return employee.text || employee.id;
            }
        });

    }

    // First row
    initializeEmployeeSelect2('.employee-dropdown');

    // Add Employee
    $('#addAuthorizationRow').click(function () {

        var row = `
        <tr>

            <td>
                <select class="form-control employee-dropdown" name="employeeid[]">

                    <option value="">Select Employee</option>

                    <?php foreach($allemployees as $emp){ ?>

                        <option value="<?php echo $emp['mxemp_emp_id']; ?>"
                                data-department="<?php echo htmlspecialchars($emp['mxdpt_name']); ?>"
                                data-division="<?php echo htmlspecialchars($emp['mxd_name']); ?>"
                                data-branch="<?php echo htmlspecialchars($emp['mxb_name']); ?>">
                            <?php echo htmlspecialchars($emp['employee_name'].' ('.$emp['mxemp_emp_id'].')'); ?>
                        </option>

                    <?php } ?>

                </select>
            </td>

            <td>
                <select class="form-control" name="action[]">
                    <option value="add">Add</option>
                    <option value="view">View</option>
                </select>
            </td>

            <td class="text-center">
                <input type="checkbox"
                       class="manager-checkbox"
                       name="ismanager[]">
            </td>

            <td class="text-center">
                <input type="checkbox"
                       class="hod-checkbox"
                       name="ishod[]">
            </td>
            <td class="text-center">
                <input type="checkbox"
                    class="hr-checkbox"
                    name="ishr[]">
            </td>
            <td class="text-center">
                <button type="button"
                        class="btn btn-danger remove-row">
                    <i class="fa fa-trash"></i>
                </button>
            </td>

        </tr>`;

        $('#authorizationBody').append(row);

        initializeEmployeeSelect2(
            $('#authorizationBody tr:last .employee-dropdown')
        );

    });

    // Remove Row
    $(document).on('click', '.remove-row', function () {

        var row = $(this).closest('tr');
        var authorizationid = row.find('.authorization-id').val();

        if (authorizationid > 0) {

            if (!confirm('Are you sure you want to delete this authorization?')) {
                return false;
            }

            $.ajax({
                url: '<?php echo base_url() ?>Performanceappraisal/deleteappraisalAuthorization',
                type: 'POST',
                dataType: 'json',
                data: {
                    authorizationid: authorizationid
                },
                success: function (response) {

                    if (response.status == 1) {

                        row.remove();

                    } else {

                        alert(response.message);

                    }

                }
            });

        } else {

            row.remove();

        }

    });

    // Only One Manager
    $(document).on('change', '.manager-checkbox', function () {

        if ($(this).is(':checked')) {

            $('.manager-checkbox').not(this)
                .prop('checked', false);

        }

    });

    // Only One HOD
    $(document).on('change', '.hod-checkbox', function () {

        if ($(this).is(':checked')) {

            $('.hod-checkbox').not(this)
                .prop('checked', false);

        }

    });

    $(document).on('change', '.hr-checkbox', function () {

        if ($(this).is(':checked')) {

            $('.hr-checkbox').not(this)
                .prop('checked', false);

        }

    });

    // Save Validation
    $('#saveAuthorization').click(function () {
        if ($('.manager-checkbox:checked').length > 1) {
            alert('Only one Manager can be selected');
            return false;
        }

        if ($('.hod-checkbox:checked').length > 1) {
            alert('Only one HOD can be selected');
            return false;
        }

        if ($('.hr-checkbox:checked').length > 1) {

            alert('Only one HR can be selected');
            return false;

        }

        var authorizationData = [];

        $('#authorizationBody tr').each(function () {

            authorizationData.push({
                employeeid: $(this).find('.employee-dropdown').val(),
                action: $(this).find('select[name="action[]"]').val(),
                ismanager: $(this).find('.manager-checkbox').is(':checked') ? 1 : 0,
                ishod: $(this).find('.hod-checkbox').is(':checked') ? 1 : 0,
                ishr: $(this).find('.hr-checkbox').is(':checked') ? 1 : 0,
                department:  $('#department').val(),
                assignedemployee: $('#employees').val(),
                financialyear: $('#financialyear').val(),
                authorizationid: $(this).find('.authorization-id').val(),
            });

        });

        $.ajax({
            url: '<?php echo base_url() ?>Performanceappraisal/saveappraisalAuthorizations',
            type: 'POST',
            dataType: 'json',
            data: {
                authorizationData: authorizationData
            },
            success: function(response){

                if(response.status == 1){
                    alert(response.message);
                }else{
                    alert(response.message);
                }

            }
        });

    });

});
</script>