<style>
    #attndempid, label[for="attndempid"], .focus-label:contains("Employee Code") {
        display: none !important;
    }
    #commonform .col-md-3:has(#attndempid) {
        display: none !important;
    }
</style>

<?php echo $controller1->mastersfilters_paystructure($ym='Y',$cmp='Y',$div='Y',$stateid='Y',$branch='Y',$emplid='Y',$grade='N',$empjoin='N',$categ='N',$day='N',$from ='N',$to ='N',$emp_type='Y',$is_quaterly='N',$emp_status='N',$is_consolidated='Y'); ?>

<div id="excellist"> </div>
</div>
<script type="text/javascript">
    // alert('<?php //echo $excelheading; ?>');
    $("form#commonform").submit(function(e) {
        e.preventDefault();
        try {
            var is_finanical = ($("#is_finanical").is(":checked")) ? 1 : 0;
            var is_quaterly = ($("#is_quaterly").is(":checked")) ? 1 : 0;
            var is_consolidated = ($("#is_consolidated").is(":checked")) ? 1 : 0;

            $('#attndmontherror').html("");
            $('#cmpnameerror').html("");
            $('#emptype_error').html("");

            var mnth = "";
            if(is_finanical || is_consolidated) {
                mnth = $("#finacial_month_year").val();
                if (mnth == 0 || mnth == "") {
                    $("#finacial_month_year").focus();
                    $('#attndmontherror').html("Please Select Financial Year");
                    return false;
                }
            } else if(is_quaterly) {
                mnth = $("#quaterly_month_year").val();
                if (mnth == 0 || mnth == "") {
                    $("#quaterly_month_year").focus();
                    $('#attndquatererror').html("Please Select Quarterly");
                    return false;
                }
            } else {
                mnth = $("#attndyear").val();
                if (mnth == 0 || mnth == "") {
                    $("#attndyear").focus();
                    $('#attndmontherror').html("Please Select Month");
                    return false;
                }
            }

            var company_id = $("#esi_company_id").val();
            if (company_id == 0 || company_id == "") {
                $("#esi_company_id").focus();
                $('#cmpnameerror').html("Please Select Company Name");
                return false;
            }

            var emp_type = $("#emptype").val();
            if (emp_type == "" || emp_type == null) {
                $("#emptype").focus();
                $('#emptype_error').html("Please Select Employee Type");
                 alert("Please Select Employee Type");
                return false;
            }

            var postData = {
                'month_year': mnth,
                'companyid': company_id,
                'divisonid': $("#esi_div_id").val(),
                'stateid': $("#esi_state_id").val(),
                'branchid': $("#esi_branch_id").val(),
                'employeeid': $("#attndempid").val(),
                'statutory_type': emp_type,
                'filter': '1',
                'day': $("#day").val(),
                'is_finanical': is_finanical,
                'is_quaterly': is_quaterly,
                'is_consolidated': is_consolidated
            };

            var mainurl = baseurl + 'export/tds_report_list';
            show_loader();

            $.ajax({
                url: mainurl,
                type: "post",
                data: postData,
                success: function (response) {
                    var isValidJSON = isValidJSONString(response);
                    if(!isValidJSON) {
                        if ($.fn.DataTable.isDataTable('#dataTables-example2')) {
                            $('#dataTables-example2').DataTable().destroy();
                        }

                        $("#excellist").empty().html(response);

                        setTimeout(function(){
                            $('#dataTables-example2').DataTable({
                                "destroy": true,
                                "scrollX": true,
                                "lengthChange": true,
                                "pageLength": 25,
                                "paging": true,
                                "ordering": true,
                                "info": true,
                                "dom": 'lBfrtip',
                                "buttons": [
                                    {
                                        extend: 'excelHtml5',
                                        title: ($("#hidden_titlehead").length) ? $("#hidden_titlehead").val() : 'TDS_Report',
                                        filename: ($("#hidden_filename").length) ? $("#hidden_filename").val() : 'TDS_Report',
                                        //messageTop: ($("#hidden_excelheading").length) ? $("#hidden_excelheading").val() : '',
                                        messageTop: '',
                                        footer: true
                                    }
                                ],
                            });
                        }, 200);
                    } else {
                        $("#excellist").html('');
                    }
                    hide_loader();
                },
                error: function() {
                    alert("Server error occurred.");
                    hide_loader();
                }
            });
        } catch(err) {
            console.error(err);
            hide_loader();
        }
    });

    $(document).ready(function() {

        var hijackInterval = setInterval(function() {
            var $dropdown = $("#emptype");

            if ($dropdown.find('option').length > 3) {
                var emp_dir_ids = [];
                var professional_id = "";

                $dropdown.find('option').each(function() {
                    var val = $(this).val();
                    var text = $(this).text().toUpperCase();
                    if (val != "0" && val != "") {
                        if (text.includes("EMPLOYEE") || text.includes("DIRECTOR")) {
                            emp_dir_ids.push(val);
                        } else if (text.includes("PROFESSIONAL")) {
                            professional_id = val;
                        }
                    }
                });

                var newOptions = '<option value="">Select Employee Type</option>';
                if (emp_dir_ids.length > 0) {
                    newOptions += '<option value="' + emp_dir_ids.join(',') + '">Employees & Directors</option>';
                }
                if (professional_id !== "") {
                    newOptions += '<option value="' + professional_id + '">Professional</option>';
                }

                $dropdown.html(newOptions);

                if ($dropdown.hasClass("select2-hidden-accessible")) {
                    $dropdown.select2('destroy').select2();
                }

                $dropdown.closest('.form-group').find('.focus-label').text('Employee Type');
            }
        }, 500);
    });

</script>

                    