//------------------------validating price AND PERCENTAGE-------------------
// function isNumber1(evt,txt){
$(".numbersonly_with_dot").bind("keypress", function (evt) {
    let txt = $(this).val();
    evt = (evt) ? evt : window.event;
    
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !=46) {
        return false;
    }

    if(charCode === 46 && txt.split('.').length === 2){
        return false;
    }
    //-NEW BY SHABABU(25-01-2022)
    if(txt.split('.').length === 2){//---->it Will Allow only 2 decimals only        
        if(parseInt(txt.substr(txt.indexOf("."), 3).length) == 3){
            return false;
        }       
    }
    //-NEW BY SHABABU(25-01-2022)
    return true;
});
// }
//-------------------------------------------------------------
    
//--------To Allows Only Numbers DONT ALLOWS .dot also
// function numbersonly(e){
    $(".numbersonly").bind("keypress", function (e) {
    e = (e) ? e : window.event;
    var charCode = (e.which) ? e.which : e.keyCode;    
    if (charCode != 8 && charCode != 0 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    });
// }
//--------END To Allows Only Numbers Prevents .dot also

//----------ALLOWS ALPHA NUMERIC
$(".alphanumeric").bind("keypress", function (e) {
    e = (e) ? e : window.event;
    var charCode = (e.which) ? e.which : e.keyCode;    
    if (charCode != 8 && charCode != 0 && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        return false;
    }
});
//----------END ALLOWS ALPHA NUMERIC
$(".datetimepicker").bind("keydown", function () {
    return false;
});
$(".yearmonth_disable_future_dates").bind("keydown", function () {
    return false;
});
//----DISABLING KEYPRESS DATES

//----END DISABLING KEYPRESS DATES


//------HINT POPOVER SCRIPT
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
//------HINT POPOVER SCRIPT

//CHECK VALID JSON OR NOT
function isValidJSONString(str) {
    // alert();
    try {
        JSON. parse(str);
    } catch (e) {
        return false;
    }
        return true;
}
//END CHECK VALID JSON OR NOT
function show_loader(){
    $('.loader').removeClass('ajax-loader-hide');
    $('.loader').addClass('ajax-loader');
}
function hide_loader(){
    $('.loader').removeClass('ajax-loader');
    $('.loader').addClass('ajax-loader-hide');
}


function openpopup(formId = '', url, DBId = '',hidejosn = ''){
    mainurl = baseurl+url;
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: {'id':DBId, 'jsonreject':hidejosn},
     success: function (data) {
        $('#popup_display').html(data);
        	if($('.select').length > 0) {
				$('.select').select2({
			        dropdownParent: $('.applymultiselect'),
			        width: '100%'
			    });
			}
			if($('.datetimepicker').length > 0) {
				$('.datetimepicker').datetimepicker({
					format: 'DD/MM/YYYY',
					icons: {
						up: "fa fa-angle-up",
						down: "fa fa-angle-down",
						next: 'fa fa-angle-right',
						previous: 'fa fa-angle-left'
					}
				});
			}
     }
    }); 
}

// function buildDynamicTable(formId, url,displayid='') {
//     // Get the form element and serialize its data
//     const form = $(`#${formId}`);
//     if (!form.length) {
//         console.error("Form not found: ", formId);
//         return;
//     }
//     const formData = form.serialize();
//     var placeid = 'display_datatables';
//     if(displayid !=''){
//        placeid = formId+'display_datatables'; 
//     }
    
//     const rptid = `dynamicTable${formId}`;
//     console.log(rptid);

//     // Build the AJAX request
//     $.ajax({
//         url: url,
//         type: 'POST',
//         data: formData,
//         dataType: 'json', // Expect JSON response
//         success: function (response) {
//             // Validate the response structure
//             if (!response.columns || !response.data) {
//                 console.error("Invalid response format");
//                 return;
//             }

//             // Generate the table dynamically
//             let tableHtml = `<table id="${rptid}" class="table table-striped custom-table mb-0 datatable display nowrap" style="width:100%">
//                                 <thead>
//                                     <tr>`;

//             // Add columns to the table header
//             response.columns.forEach(col => {
//                 tableHtml += `<th>${col}</th>`;
//             });
//             tableHtml += `</tr></thead><tbody>`;

//             // Add data to the table body
//             response.data.forEach(row => {
//                 tableHtml += `<tr>`;
//                 response.columns.forEach(col => {
//                 	tableHtml += `<td>${row[col]}</td>`;
//                 });
//                 tableHtml += `</tr>`;
//             });

//             tableHtml += `</tbody></table>`;

//             // Replace the content of the display area with the table
//             $('#'+placeid).html(tableHtml);

//             const table_common = $(`#${rptid}`).DataTable({

//                 // Enable the length menu to control rows displayed per page
//                 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//                 // "scrollY": "300px",         // Optional: Enables vertical scrolling
//                 "scrollX": true,            // Optional: Enables horizontal scrolling
//                 "scrollCollapse": true,     // Optional: Adjust table height dynamically
//                 "dom": 'Blfrtip',            // Defines table controls placement (B = Buttons)
//                 "buttons": [
//                     { 
//                         extend: 'excel',    // Enables Excel export functionality
//                         text: 'Excel', // Custom button text (optional)
//                         title: response.reportName,
//                         exportOptions: {    // Configure export options if needed
//                             format: {
//                                 body: function(data, row, col, node) {
//                                     return data; // Format data during export (optional)
//                                 }
//                             }
//                         }
//                     },
//                     'csv',

//                 ]
//             });


//             // Append DataTable buttons to the wrapper
//             table_common.buttons().container()
//                  .appendTo(`#${rptid}_wrapper .col-md-6:eq(0)`);
//         },
//         error: function (xhr, status, error) {
//             console.error("AJAX error: ", error);
//         }
//     });
// }

function buildDynamicTable(formId, url, displayid = ''){
    // Get form
    const form = $(`#${formId}`);
    if (!form.length)
    {
        console.error("Form not found:", formId);
        return;
    }
    // Serialize form data
    const formData = form.serialize();
    // Display area
    var placeid = 'display_datatables';
    if(displayid != '')
    {
        placeid = formId + 'display_datatables';
    }
    // Dynamic table id
    const rptid = `dynamicTable${formId}`;

    // AJAX
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response)
        {
            // Validate response
            if (!response.columns || !response.data)
            {
                console.error("Invalid response format");
                return;
            }
            // TABLE HTML
            let tableHtml = `<table id="${rptid}"class="table table-striped custom-table mb-0 datatable display nowrap"style="width:100%"><thead><tr>`;


            // TABLE HEADERS
            response.columns.forEach(col => {
                tableHtml += `<th>${col}</th>`;
            });
            tableHtml += `</tr></thead><tbody>`;
            // TABLE BODY
            response.data.forEach(row => {
                tableHtml += `<tr>`;
                response.columns.forEach(col => {
                    tableHtml += `<td>${row[col]}</td>`;
                });
                tableHtml += `</tr>`;
            });
            tableHtml += `</tbody></table>`;
            // APPEND TABLE
            $('#' + placeid).html(tableHtml);
            // DATATABLE
            const table_common = $(`#${rptid}`).DataTable({
                destroy: true,
                responsive: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                scrollX: true,
                scrollCollapse: true,
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        title: response.reportName,
                        exportOptions: {
                            format: {
                                body: function(data, row, col, node)
                                {
                                    // REMOVE HTML TAGS
                                    return $('<div>').html(data).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        title: response.reportName,
                        exportOptions: {
                            format: {
                                body: function(data, row, col, node)
                                {
                                    // REMOVE HTML TAGS
                                    return $('<div>').html(data).text().trim();
                                }
                            }
                        }
                    }
                ]
            });

            // BUTTON POSITION
            table_common
                .buttons()
                .container()
                .appendTo(
                    `#${rptid}_wrapper .col-md-6:eq(0)`
                );

        },

        error: function(xhr, status, error)
        {
            console.error("AJAX Error:", error);
        }

    });
}
