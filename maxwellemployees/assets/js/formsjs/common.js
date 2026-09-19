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

function buildDynamicTable(formId, url, displayid = '') {

    const form = $(`#${formId}`);
    if (!form.length) {
        console.error("Form not found: ", formId);
        return;
    }

    const formData = form.serialize();

    var placeid = 'display_datatables';
    if (displayid != '') {
        placeid = formId + 'display_datatables';
    }

    const rptid = `dynamicTable${formId}`;

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',

        success: function (response) {

            if (!response.columns || !response.data) {
                console.error("Invalid response format");
                return;
            }

            let tableHtml = `<table id="${rptid}" class="table table-striped custom-table mb-0 datatable display nowrap" style="width:100%">
                                <thead>
                                    <tr>`;

            // Table Headers
            response.columns.forEach(col => {
                tableHtml += `<th>${col}</th>`;
            });

            tableHtml += `</tr></thead><tbody>`;

            // Table Rows
            response.data.forEach(row => {
                tableHtml += `<tr>`;
                response.columns.forEach(col => {
                    tableHtml += `<td>${row[col] ?? ''}</td>`;
                });
                tableHtml += `</tr>`;
            });

            tableHtml += `</tbody></table>`;

            $('#' + placeid).html(tableHtml);

            //  Get dynamic exclude columns from backend
            const excludeCols = (response.hideInExport || []).map(c => c.toLowerCase());

            const table_common = $(`#${rptid}`).DataTable({

                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                scrollX: true,
                scrollCollapse: true,
                dom: 'Blfrtip',

                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        title: response.reportName,

                        exportOptions: {
                            columns: function (idx) {
                                const colName = response.columns[idx].toLowerCase();
                                return !excludeCols.includes(colName);
                            },
                            format: {
                                body: function (data) {
                                    return $('<div>').html(data).text().trim(); // ✅ remove HTML
                                }
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',

                        exportOptions: {
                            columns: function (idx) {
                                const colName = response.columns[idx].toLowerCase();
                                return !excludeCols.includes(colName);
                            },
                            format: {
                                body: function (data) {
                                    return $('<div>').html(data).text().trim();
                                }
                            }
                        }
                    }
                ]
            });

            // Attach buttons
            table_common.buttons().container()
                .appendTo(`#${rptid}_wrapper .col-md-6:eq(0)`);
        },

        error: function (xhr, status, error) {
            console.error("AJAX error: ", error);
        }
    });
}