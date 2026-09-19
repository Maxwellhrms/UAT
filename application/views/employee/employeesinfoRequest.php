<!-- Search Filter -->
<?php $controller->commonFilters(array(
    'fromdatefilter' => 'Y',
    'todatefilter' => 'Y',
    'requeststatus' => 'Y',
    'companyfilter' => 'Y',
    'divisionfilter' => 'Y',
    'statefilter' => 'Y',
    'branchfilter' => 'Y',
    'employeecodeFilter' => 'Y',
    'FormId' => 'employeesinfoRequest',
    'CallFunction' => 'employeesinfoRequestlist'
)); ?>
<!-- Search Filter -->
<hr>
<!-- /Page Content -->
</div>


<div class="modal fade" id="employeeRequestModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Employee Request Details
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="employeeRequestModalBody">

                <div class="text-center">
                    <i class="fa fa-spinner fa-spin"></i> Loading...
                </div>

            </div>

        </div>
    </div>
</div>

<script>

$(document).on('click','.changeRequestStatus',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var status = $(this).data('status');
    var statusText = $(this).text().trim();
    if(
        confirm(
            'Are you sure you want to change status to '
            + statusText + ' ?'
        )
    )
    {
        $.ajax({

            url : "<?php echo base_url('employee/employeesinfoRequestinfosave'); ?>",
            type : "POST",
            dataType : "json",
            data : {
                id : id,
                status : status
            },
            beforeSend : function()
            {
                $('.changeRequestStatus').css(
                    'pointer-events',
                    'none'
                );
            },
            success : function(response)
            {
                if(response.statusCode == 200)
                {
                    alert(response.message);

                    location.reload();
                }
                else
                {
                    alert(response.errorMsg);
                }
            },
            error : function()
            {
                alert(
                    'Unable to process request'
                );
            },
            complete : function()
            {
                $('.changeRequestStatus').css(
                    'pointer-events',
                    'auto'
                );
            }
        });
    }
});


$(document).on('click','.viewEmployeeRequest',function(){

    var id = $(this).data('id');
    var employee_id = $(this).data('empid');

    $('#employeeRequestModal').modal('show');

    $.ajax({
        url : baseurl + 'employee/getEmployeeRequestDetails',
        type : 'POST',
        data : {
            id : id,
            employee_id : employee_id
        },

        success:function(response){

            $('#employeeRequestModalBody').html(response);

        }
    });

});

$(document).on('click','.close',function(){
    $('#employeeRequestModal').modal('hide');
});
</script>