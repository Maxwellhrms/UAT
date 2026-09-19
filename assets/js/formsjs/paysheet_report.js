$("#esi_company_id").change(function () {
    var esi_comp_id = $(this).val();
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "") {
        //        load_esi_states(esi_comp_id, 0)
        load_esi_divisions(esi_comp_id, 0);
        load_emp_type(esi_comp_id, 0)
    } else {
        var option = "<option value=0>Select Division</option>";
        $("#esi_div_id").empty().append(option);

        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);


        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        var option = "<option value=0>Select Emp Type</option>";
        $("#emptype").empty().append(option);
    }
});

//------------------LOAD DIVISIONS
var esi_div_array = [];
var esi_selected_div;
function load_esi_divisions(esi_comp_id, esi_selected_div) {
    $.ajax({
        url: baseurl + "admin/getdivisions_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'type': "ESI" },
        success: function (data) {
            esi_div_array = JSON.parse(data);
        }
    });

    var option;
    //        console.log(states_array);
    if (esi_div_array.length > 0) {
        option = "<option value=0>Select Division</option>";
        for (index in esi_div_array) {
            var esi_div_array_index = esi_div_array[index];
            //                console.log(esi_selected_div +'---'+ esi_div_array_index.mxd_id);
            if (esi_selected_div == esi_div_array_index.mxd_id) {
                option += "<option value=" + esi_div_array_index.mxd_id + " selected>" + esi_div_array_index.mxd_name + "</option>"
            } else {
                option += "<option value=" + esi_div_array_index.mxd_id + ">" + esi_div_array_index.mxd_name + "</option>"
            }
            //                   console.log(option);
        }
    } else {
        option = "<option value=0>Select Division</option>";
    }

    $("#esi_div_id").empty().append(option);

    var option = "<option value=0>Select State</option>";
    $("#esi_state_id").empty().append(option);


    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);
}
//------------------END LOAD DIVISIONS

//---------------LOAD EMPLOYEE TYPE
var incentive_selected_emp_type;
function load_emp_type(cmp_id, incentive_selected_emp_type) {

    var option = '<option value="0">Select Emp Type</option>';
    if (cmp_id != 0 && cmp_id != "") {
        $.ajax({
            async: false,
            type: "POST",
            data: { cmp_id: cmp_id },
            url: baseurl + 'admin/getemployeetypemasterdetails',
            datatype: "html",
            success: function (data) {
                var emp_type_parse_data = JSON.parse(data);
                if (emp_type_parse_data.length > 0) {
                    for (index in emp_type_parse_data) {
                        var emp_type_index = emp_type_parse_data[index];
                        if (incentive_selected_emp_type == emp_type_index.mxemp_ty_id) {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' selected>' + emp_type_index.mxemp_ty_name + '</option>';
                        } else {
                            option += '<option value=' + emp_type_index.mxemp_ty_id + ' >' + emp_type_index.mxemp_ty_name + '</option>';
                        }
                    }
                }

            }
        });
    }
    $("#emptype").html(option);
}
//---------------END LOAD EMPLOYEE TYPE

$("#esi_div_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $(this).val();
    //        alert(comp_id);
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "") {
        load_esi_states(esi_comp_id, esi_div_id, 0);
    } else {
        var option = "<option value=0>Select State</option>";
        $("#esi_state_id").empty().append(option);

        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        // var option = "<option value=0>Select Emp Type</option>";
        // $("#emptype").empty().append(option);        
    }
});
//----------------LOAD STATES
var esi_states_array = [];
var esi_selected_state;
function load_esi_states(esi_comp_id, esi_div_id, esi_selected_state) {
    //    alert(esi_div_id);
    $.ajax({
        url: baseurl + "admin/getstates_based_on_branch_master",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'type': "ESI" },
        success: function (data) {
            esi_states_array = JSON.parse(data);
        }
    });

    var option;
    //        console.log(states_array);
    if (esi_states_array.length > 0) {
        option = "<option value=0>Select State</option>";
        for (index in esi_states_array) {
            var esi_states_array_index = esi_states_array[index];
            //                console.log(selected_state +'---'+ states_array_index.mxst_id);
            if (esi_selected_state == esi_states_array_index.mxst_id) {
                option += "<option value=" + esi_states_array_index.mxst_id + " selected>" + esi_states_array_index.mxst_state + "</option>"
            } else {
                option += "<option value=" + esi_states_array_index.mxst_id + ">" + esi_states_array_index.mxst_state + "</option>"
            }
            //                   console.log(option);
        }
    } else {
        option = "<option value=0>Select State</option>";
    }

    $("#esi_state_id").empty().append(option);

    var option = "<option value=0>Select Branch</option>";
    $("#esi_branch_id").empty().append(option);

    // var option = "<option value=0>Select Emp Type</option>";
    // $("#emptype").empty().append(option);    
}
//------------End Load States

$("#esi_state_id").change(function () {
    var esi_comp_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $(this).val();
    if (esi_comp_id != 0 && esi_comp_id != "" && esi_div_id != 0 && esi_div_id != "" && esi_state_id != 0 && esi_state_id != "") {
        load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, 0);
    } else {
        var option = "<option value=0>Select Branch</option>";
        $("#esi_branch_id").empty().append(option);

        // var option = "<option value=0>Select Emp Type</option>";
        // $("#emptype").empty().append(option);

    }
});
//-----------------LOADING BRANCHES
var esi_branches_array = [];
var esi_selected_branch;
function load_esi_branches(esi_comp_id, esi_div_id, esi_state_id, esi_selected_branch) {

    $.ajax({
        url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
        type: "post",
        async: false,
        data: { 'comp_id': esi_comp_id, 'div_id': esi_div_id, 'state_id': esi_state_id, 'type': 'ESI' },
        success: function (data) {
            //                    console.log(data);
            esi_branches_array = JSON.parse(data);

        }
    });


    var option;
    if (esi_branches_array.length > 0) {
        option = "<option value=0>Select Branch</option>";
        for (index in esi_branches_array) {
            var esi_branches_array_index = esi_branches_array[index];
            if (esi_selected_branch == esi_branches_array_index.mxb_id) {
                option += "<option value=" + esi_branches_array_index.mxb_id + " selected>" + esi_branches_array_index.mxb_name + "</option>"
            } else {
                option += "<option value=" + esi_branches_array_index.mxb_id + ">" + esi_branches_array_index.mxb_name + "</option>"
            }
            //                   console.log(option);
        }
        // load_emp_type(esi_comp_id, 0);
    } else {
        option = "<option value=0>Select Branch</option>";
    }

    $("#esi_branch_id").empty().append(option);
}
//-----------------END LOADING BRANCHES



//-----------------paysheeet generate
function processpaysheet_bkp(button) {

    var yearmonth = $("#yearmonth").val();
    if (yearmonth == 0 || yearmonth == "") {
        $("#yearmonth").focus();
        $('#yearmontherror').html("Please Select Date");
        return false;
    } else {
        $('#yearmontherror').html("");
    }
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
   /* if (esi_div_id == 0 || esi_div_id == "") {
        $("#esi_div_id").focus();
        $('#esi_div_id_error').html("Please Select Division Name");
        return false;
    } else {
        $('#esi_div_id_error').html("");
    } */

    var esi_state_id = $("#esi_state_id").val();
    /* if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    } */

    var esi_branch_id = $("#esi_branch_id").val();
    /* if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }*/

    var emptype = $("#emptype").val();
    if (emptype == 0 || emptype == "") {
        $("#emptype").focus();
        $('#emptypeerror').html("Please Select Employee Type");
        return false;
    } else {
        $('#emptypeerror').html("");
    }
    
    
    
    let export_type = button.getAttribute('data-type');
    
    
    $.ajax({
        url: baseurl + 'Export_paysheet/checkDataExist',
        type: 'POST',
        async:false,
        
        data: { date: yearmonth, company: esi_company_id, divison: esi_div_id, state: esi_state_id, branch: esi_branch_id, emptype: emptype},
        success: function (data, status, xhr) {
            var parsedData = JSON.parse(data);
            // console.log(parsedData);
            if(parsedData.status == 0){
                alert(parsedData.message);
                return false;
            }else{
                mainurl = baseurl + 'Export_paysheet/generate_paysheet';
                $.ajax({
                    url: mainurl,
                    type: 'POST',
                    xhrFields: {responseType: 'blob'},// Ensure the response is treated as a binary blob
                    data: { date: yearmonth, company: esi_company_id, divison: esi_div_id, state: esi_state_id, branch: esi_branch_id, emptype: emptype,export_type:export_type },
                    success: function (data, status, xhr) {
                        // Check the response type
                        const contentType = xhr.getResponseHeader('Content-Type');
                
                        if (contentType && contentType.indexOf('application/json') !== -1) {
                            console.log("1");
                            // Handle JSON response (e.g., error)
                            const reader = new FileReader();
                            reader.onload = function () {
                                const response = JSON.parse(reader.result);
                                if (response.status === 0) {
                                    alert(response.message); // Show error message
                                }
                            };
                            reader.readAsText(data); // Read the blob as text
                        } else if (contentType && (contentType.indexOf('application/pdf') !== -1 || contentType.indexOf('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') !== -1)) {
                            console.log("2");
                            console.log(" EXPORT TYPE : ", export_type);
                            // Handle file download (PDF or Excel)
                            let filename = "paysheet"; // Default filename
                            if (export_type == 'pdf') {
                                filename += ".pdf";
                            } else {
                                filename += ".xlsx";
                            }
                
                            // Extract filename from the Content-Disposition header
                            const disposition = xhr.getResponseHeader('Content-Disposition');
                            if (disposition && disposition.indexOf('filename=') !== -1) {
                                filename = disposition.split('filename=')[1].split(';')[0].trim();
                                filename = filename.replace(/['"]/g, ''); // Remove quotes
                            }
                
                            // Create a link element
                            const url = window.URL.createObjectURL(data);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = filename; // Set the filename
                            document.body.appendChild(a);
                            a.click(); // Trigger the download
                            document.body.removeChild(a); // Clean up
                            window.URL.revokeObjectURL(url); // Release the object URL
                        } else {
                            console.log("3");
                            // Handle unexpected response type
                            console.error('Unexpected response type:', contentType);
                            alert('Unexpected response from the server. Please try again.');
                        }
                    },
                    // success: function (data, status, xhr) {
                    //     console.log(data);
                       
                    //     // Extract filename from the response headers
                    //     if(export_type == 'pdf'){
                    //         var filename = "paysheet.pdf"; // Default filename
                    //     }else{
                    //         var filename = "paysheet.xlsx"; // Default filename
                    //     }
                    //     var disposition = xhr.getResponseHeader('Content-Disposition');
                    //     if (disposition && disposition.indexOf('filename=') !== -1) {
                    //         // Extract filename from the header
                    //         filename = disposition.split('filename=')[1].split(';')[0].trim();
                    //         // Remove quotes if present
                    //         filename = filename.replace(/['"]/g, '');
                    //     }
                        
                    //     // Create a link element
                    //     var url = window.URL.createObjectURL(data);
                    //     var a = document.createElement('a');
                    //     a.href = url;
                    //     a.download = filename; // Set the filename
                    //     document.body.appendChild(a);
                    //     a.click(); // Trigger the download
                    //     document.body.removeChild(a); // Clean up
                    //     window.URL.revokeObjectURL(url); // Release the object URL
                    // },
                       
                    
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
    
   
    
}


//--------------end paysheeet generate


// ----------------- UDPATED BY VARAPRASAD ----------------------- //
function processpaysheet_bkp2(button) {

    var yearmonth = $("#yearmonth").val();
    if (yearmonth == 0 || yearmonth == "") {
        $("#yearmonth").focus();
        $('#yearmontherror').html("Please Select Date");
        return false;
    } else {
        $('#yearmontherror').html("");
    }
    var esi_company_id = $("#esi_company_id").val();
    if (esi_company_id == 0 || esi_company_id == "") {
        $("#esi_company_id").focus();
        $('#cmpnameerror').html("Please Select Company Name");
        return false;
    } else {
        $('#cmpnameerror').html("");
    }
    var esi_div_id = $("#esi_div_id").val();
    /* if (esi_div_id == 0 || esi_div_id == "") {
         $("#esi_div_id").focus();
         $('#esi_div_id_error').html("Please Select Division Name");
         return false;
     } else {
         $('#esi_div_id_error').html("");
     } */

    var esi_state_id = $("#esi_state_id").val();
    /* if (esi_state_id == 0 || esi_state_id == "") {
        $("#esi_state_id").focus();
        $('#esi_state_id_error').html("Please Select State");
        return false;
    } else {
        $('#esi_state_id_error').html("");
    } */

    var esi_branch_id = $("#esi_branch_id").val();
    /* if (esi_branch_id == 0 || esi_branch_id == "") {
        $("#esi_branch_id").focus();
        $('#esi_branch_id_error').html("Please Select Branch");
        return false;
    } else {
        $('#esi_branch_id_error').html("");
    }*/

    var emptype = $("#emptype").val();
    if (emptype == 0 || emptype == "") {
        $("#emptype").focus();
        $('#emptypeerror').html("Please Select Employee Type");
        return false;
    } else {
        $('#emptypeerror').html("");
    }

    var esi_branch_id = $("#esi_branch_id").val();

    let export_type = button.getAttribute('data-type');

    var paysheet_category = $('input[name="paysheet_type"]:checked').val();


    $.ajax({
        url: baseurl + 'Export_paysheet/checkDataExist',
        type: 'POST',
        async:false,

        data: { date: yearmonth, company: esi_company_id, divison: esi_div_id, state: esi_state_id, branch: esi_branch_id, emptype: emptype},
        success: function (data, status, xhr) {
            var parsedData = JSON.parse(data);
            // console.log(parsedData);
            if(parsedData.status == 0){
                alert(parsedData.message);
                return false;
            }else{
                var downloadUrl = (export_type === 'pdf')
                    ? baseurl + 'Export_paysheet/generate_paysheet_pdf_pure'
                    : baseurl + 'Export_paysheet/generate_paysheet';

                // Create a temporary form to submit the POST data
                var mapForm = document.createElement("form");
                mapForm.target = "_blank"; // Opens in new tab/triggers download
                mapForm.method = "POST";
                mapForm.action = downloadUrl;

                var inputs = {
                    date: yearmonth,
                    company: esi_company_id,
                    divison: esi_div_id,
                    state: esi_state_id,
                    branch: esi_branch_id,
                    emptype: emptype,
                    export_type: export_type,
                    paysheet: paysheet_category,
                };

                Object.keys(inputs).forEach(function(key) {
                    var mapInput = document.createElement("input");
                    mapInput.type = "hidden";
                    mapInput.name = key;
                    mapInput.value = inputs[key];
                    mapForm.appendChild(mapInput);
                });

                document.body.appendChild(mapForm);
                mapForm.submit();
                document.body.removeChild(mapForm);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });



}

function processpaysheet(button) {
    var yearmonth = $("#yearmonth").val();
    var esi_company_id = $("#esi_company_id").val();
    var esi_div_id = $("#esi_div_id").val();
    var esi_state_id = $("#esi_state_id").val();
    var esi_branch_id = $("#esi_branch_id").val();
    var emptype = $("#emptype").val();
    let export_type = button.getAttribute('data-type');

    // Get the radio value
    var paysheet_category = $('input[name="paysheet_type"]:checked').val();

    // Validation
    if (!yearmonth || !esi_company_id || !emptype) {
        alert("Please select Month, Company, and Employee Type");
        return false;
    }

    $.ajax({
        url: baseurl + 'Export_paysheet/checkDataExist',
        type: 'POST',
        data: {
            date: yearmonth,
            company: esi_company_id,
            divison: esi_div_id,
            state: esi_state_id,
            branch: esi_branch_id,
            emptype: emptype,
            paysheet: paysheet_category // Pass the radio choice here
        },
        success: function (response) {
            var parsedData = JSON.parse(response);

            if (parsedData.status == 1) {
                // DATA EXISTS - Now and ONLY now do we open the new tab
                var downloadUrl = (export_type === 'pdf')
                    ? baseurl + 'Export_paysheet/generate_paysheet_pdf_pure'
                    : baseurl + 'Export_paysheet/generate_paysheet';

                var mapForm = document.createElement("form");
                mapForm.target = "_blank";
                mapForm.method = "POST";
                mapForm.action = downloadUrl;

                var inputs = {
                    date: yearmonth,
                    company: esi_company_id,
                    divison: esi_div_id,
                    state: esi_state_id,
                    branch: esi_branch_id,
                    emptype: emptype,
                    export_type: export_type,
                    paysheet: paysheet_category // Send to export too
                };

                Object.keys(inputs).forEach(function(key) {
                    var mapInput = document.createElement("input");
                    mapInput.type = "hidden";
                    mapInput.name = key;
                    mapInput.value = inputs[key];
                    mapForm.appendChild(mapInput);
                });

                document.body.appendChild(mapForm);
                mapForm.submit();
                document.body.removeChild(mapForm);
            } else {
                // NO DATA - Show alert on current page, no tab opens
                alert(parsedData.message);
            }
        },
        error: function () {
            alert("Error verifying data existence.");
        }
    });
}
