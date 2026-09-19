$(document).ready(function () {

	//----------GET HEAD OFFICE DIVISION BASED ON COMPANY

	$(document).on('change', ".cmp_data", function () {
		var hod_comp_id = $(this).find(':selected').data("cmpid")
		//  ---------added chandana 23-04-2021-----------
		var url = $(location).attr('href');
		var parts = url.split("/");
		var last_part = parts[parts.length-2];
		if(last_part == 'edithod'){
			var hod_comp_id = $(this).val();
		}
		//  --------- end added chandana 23-04-2021-----------
		
		var id = $(this).attr("id");
		var ex = id.split('_');
		var data_id = ex[1];

		if (hod_comp_id != 0 && hod_comp_id != "") {
			// load_hod_branches(hod_comp_id, data_id, 0);
			load_hod_divisions(hod_comp_id, data_id, 0);
		} else {
			//-------------------NEW BY SHABABU
			option = "<option value='' data-divisionid=''>Select Division</option>";
			$("#cmpdivision_" + data_id).empty().append(option);
			//-------------------NEW BY SHABABU
			option = "<option value='' data-branchid=''>Select Branch</option>";
			$("#cmpbranch_" + data_id).empty().append(option);

			var option = "<option value='' data-deptid=''>Select Department</option>";
			$("#department_" + data_id).empty().append(option);


			var option = "<option value='' data-hodempid=''>Select HOD Emp Code</option>";
			$("#employees_" + data_id).empty().append(option);
		}
	});
	//--------------NEW BY SHABABU
	var hod_div_array = [];
	var hod_selected_div;
	function load_hod_divisions(comp_id, data_id, selected_div) {
		$.ajax({
			url: baseurl + "admin/getdivisions_based_on_branch_master",
			type: "post",
			async: false,
			data: { 'comp_id': comp_id },
			success: function (data) {
				//                    console.log("ESI DIVISIONS");
				console.log(data);
				//                    console.log("END ESI DIVISIONS");
				hod_div_array = JSON.parse(data);
				//                            console.log(states_array);

			}
		});

		var option;
		//        console.log(states_array);
		if (hod_div_array.length > 0) {
			option = "<option value=0>Select Division</option>";
			for (index in hod_div_array) {
				var hod_div_array_index = hod_div_array[index];
				//                console.log(esi_selected_div +'---'+ hod_div_array_index.mxd_id);
				if (selected_div == hod_div_array_index.mxd_id) {
					option += "<option value=" + hod_div_array_index.mxd_id + "~" + hod_div_array_index.mxd_name + " data-divisionid=" + hod_div_array_index.mxd_id + " selected>" + hod_div_array_index.mxd_name + "</option>"
				} else {
					option += "<option value=" + hod_div_array_index.mxd_id + "~" + hod_div_array_index.mxd_name + " data-divisionid=" + hod_div_array_index.mxd_id + ">" + hod_div_array_index.mxd_name + "</option>"
				}
				//                   console.log(option);
			}
		} else {

			option = "<option value='' data-divisionid=''>Select Division</option>";

		}

		$("#cmpdivision_" + data_id).empty().append(option);


		option = "<option value='' data-branchid=''>Select Branch</option>";
		$("#cmpbranch_" + data_id).empty().append(option);

		var option = "<option value='' data-deptid=''>Select Department</option>";
		$("#department_" + data_id).empty().append(option);


		var option = "<option value='' data-hodempid=''>Select HOD Emp Code</option>";
		$("#employees_" + data_id).empty().append(option);
	}
	//--------------NEW BY SHABABU
	//-----------END GET HEAD OFFICE DIVISION BASED ON THE COMP
	//-----------GET BRANCHES BASED ON THE DIVISION
	$(document).on('change', ".division_data ", function () {

		var id = $(this).attr("id");
		var ex = id.split('_');
		var data_id = ex[1];

		var hod_comp_id = $("#cmpname_" + data_id).find(":selected").data("cmpid");
		var hod_div_id = $(this).find(':selected').data("divisionid");
        //  ---------added chandana 23-04-2021-----------
		var url = $(location).attr('href');
		var parts = url.split("/");
		var last_part = parts[parts.length-2];
		if(last_part == 'edithod'){
			var hod_comp_id = $('#cmpname_1').val();
			var hod_div_id = $('#cmpdivision_1').val();
		}
		//  --------- end added chandana 23-04-2021-----------
		
		if (hod_comp_id != 0 && hod_comp_id != "" && hod_div_id != 0 || hod_div_id != "") {
			load_hod_branches(hod_comp_id, hod_div_id, data_id, 0);

		} else {

			option = "<option value='' data-branchid=''>Select Branch</option>";
			$("#cmpbranch_" + data_id).empty().append(option);

			var option = "<option value='' data-deptid=''>Select Department</option>";
			$("#department_" + data_id).empty().append(option);


			var option = "<option value='' data-hodempid=''>Select HOD Emp Code</option>";
			$("#employees_" + data_id).empty().append(option);
		}
	});
	//-----------END GET BRANCHES BASED ON THE DIVISION





	var hod_branch_array = [];
	var hod_selected_branch;
	function load_hod_branches(hod_comp_id, hod_div_id, data_id, hod_selected_div) {
		$.ajax({
			url: baseurl + "admin/getbranches_based_on_eligibility_state_wise",
			type: "post",
			async: false,
			// data: { 'comp_id': hod_comp_id, 'is_headoffice': 1 },
			data: { 'comp_id': hod_comp_id, 'div_id': hod_div_id, 'is_headoffice': 1 },
			success: function (data) {
				console.log(data);
				//return false;
				hod_branch_array = JSON.parse(data);
			}
		});
		//return false;
		var option;
		if (hod_branch_array.length > 0) {
			option = "<option value='' data-branchid=''>Select Branch</option>";
			for (index in hod_branch_array) {
				var hod_branch_array_index = hod_branch_array[index];
				if (hod_selected_div == hod_branch_array_index.mxd_id) {
					option += "<option value=" + hod_branch_array_index.mxb_id + "~" + hod_branch_array_index.mxb_name + " selected data-branchid=" + hod_branch_array_index.mxb_id + ">" + hod_branch_array_index.mxb_name + "</option>"
				} else {
					option += "<option value=" + hod_branch_array_index.mxb_id + "~" + hod_branch_array_index.mxb_name + " data-branchid=" + hod_branch_array_index.mxb_id + ">" + hod_branch_array_index.mxb_name + "</option>"
				}
				console.log(option);
			}
		} else {
			option = "<option value='' data-branchid=''>Select Branch</option>";
		}

		$("#cmpbranch_" + data_id).empty().append(option);

		var option = "<option value='' data-deptid=''>Select Department</option>";
		$("#department_" + data_id).empty().append(option);


		var option = "<option value='' data-hodempid=''>Select HOD Emp Code</option>";
		$("#employees_" + data_id).empty().append(option);
	}
	//----------END GET HEAD OFFICE BRANCH ON COMPANY
	//---------GET DEPARTMENTS BASED ON THE BRANCH
	// $(".branch_data").change(function () {
	$(document).on('change', ".branch_data", function () {
		// var branch_id = $(this).val();

		// alert(branch_id);

		var attr_id = $(this).attr("id");
		var sp = attr_id.split('_');
		var id_no = sp[1];

		var cmp_id = $("#cmpname_" + id_no).find(":selected").data("cmpid");
		var div_id = $("#cmpdivision_" + id_no).find(":selected").data("divisionid");
		var branch_id = $(this).find(":selected").data('branchid');
        //  ---------added chandana 23-04-2021-----------
		var url = $(location).attr('href');
		var parts = url.split("/");
		var last_part = parts[parts.length-2];
		if(last_part == 'edithod'){
			var cmp_id = $('#cmpname_1').val();
			var div_id = $('#cmpdivision_1').val();
			var branch_id = $('#cmpbranch_1').val();
		}
		//  --------- end added chandana 23-04-2021-----------


		if (branch_id != "" && branch_id != null && cmp_id != "" && cmp_id != null && div_id != "" || div_id != null || div_id != 0) {
			//            alert(branch_name);

			$.ajax({
				url: baseurl + 'admin/get_departments_based_on_auth_type',
				type: 'POST',
				data: { comp_id: cmp_id, 'div_id': div_id, branch_id: branch_id, without_authtype: "yes" },
				success: function (data) {
					console.log(data);
					// return false;
					var parse_data = JSON.parse(data);
					if (parse_data.length > 0) {
						$("#department_" + id_no).empty();
						$("#employees_" + id_no).empty();
						$("#department_" + id_no).append('<option value="" data-deptid="">Select Department</option>');
						for (index in parse_data) {
							var dept_data = parse_data[index];
							var dept_code = dept_data['mxdpt_id'];
							var dept_name = dept_data['mxdpt_name'];
							$("#department_" + id_no).append('<option value="' + dept_code + '~' + dept_name + '" data-deptid="' + dept_code + '">' + dept_name + '</option>');
						}

					} else {
						$("#department_" + id_no).empty();
						$("#employees_" + id_no).empty();
						alert("There Is No Department Found In the Selected Branch");
						return false;

					}
				}
			});

		} else {
			$("#department_" + id_no).empty();
			$("#employees_" + id_no).empty();
			return false;
		}

	});
	//----------END GET DEPARTMENTS
	//----------GET EMPLOYEES BASED ON THE DEPT NAME
	$(document).on('change', '.dept_data', function () {
		// $(".dept_data").change(function () {

		var dept_attr_id = $(this).attr("id");
		var sp = dept_attr_id.split('_');
		var id_no = sp[1];

		var dept_id = $(this).find(":selected").data('deptid');
		// alert(dept_id);
		var branch_id = $("#cmpbranch_" + id_no).find(":selected").data('branchid');
		// alert(branch_id);
		var comp_id = $("#cmpname_" + id_no).find(":selected").data("cmpid")
        //  ---------added chandana 23-04-2021-----------
		var url = $(location).attr('href');
		var parts = url.split("/");
		var last_part = parts[parts.length-2];
		if(last_part == 'edithod'){
			var comp_id = $('#cmpname_1').val();
			//var div_id = $('#cmpdivision_1').val();
			var branch_id = $('#cmpbranch_1').val();
			var dept_id = $('#department_1').val();
		}
       //  --------- end added chandana 23-04-2021-----------
       		if (branch_id != "" && branch_id != null && comp_id != "" && comp_id != null) {
			if (dept_id != "" && dept_id != null) {
				$.ajax({
					url: baseurl + 'admin/get_employee_info_based_on_departments',
					type: 'POST',
					data: { comp_id: comp_id, branch_id: branch_id, dept_id: dept_id, without_authtype: 'yes' },
					success: function (data) {
						console.log(data);
						var parse_data = JSON.parse(data);
						if (parse_data.length > 0) {
							$("#employees_" + id_no).empty();
							$("#employees_" + id_no).append('<option value="">Select Authorisation</option>');
							for (index in parse_data) {
								var auth_data = parse_data[index];
								var auth_emp_code = auth_data['mxemp_emp_id'];
								var auth_emp_name = auth_data['mxemp_emp_lname'] + " " + auth_data['mxemp_emp_fname'];
								var auth_comp_code = auth_data['mxemp_emp_comp_code'];
								var auth_comp_name = auth_data['mxcp_name'];
								var auth_branch_code = auth_data['mxemp_emp_branch_code'];
								var auth_branch_name = auth_data['mxb_name'];
								var auth_dept_code = auth_data['mxemp_emp_dept_code'];
								var auth_dept_name = auth_data['mxdpt_name'];
								var auth_desg_code = auth_data['mxemp_emp_desg_code'];
								var auth_desg_name = auth_data['mxdesg_name'];
								var auth_state_id = auth_data['mxemp_emp_state_code'];
								var auth_state_name = auth_data['mxst_state'];
								var auth_div_id = auth_data['mxemp_emp_division_code'];
								var auth_div_name = auth_data['mxd_name'];
								var opt_data = auth_emp_code + " - " + auth_emp_name + " - " + auth_desg_name
								var opt_val = auth_emp_code + "~" + auth_emp_name + '~' + auth_comp_code + "~" + auth_comp_name + "~" + auth_branch_code + "~" + auth_branch_name + "~" + auth_dept_code + "~" + auth_dept_name + '~' + auth_state_id + '~' + auth_state_name + '~' + auth_div_id + '~' + auth_div_name
								$("#employees_" + id_no).append('<option value="' + opt_val + '">' + opt_data + '</option>');
							}

						} else {
							$("#employees_" + id_no).empty();
							alert("There Is No Employees in selected Department");
							return false;

						}
					}
				});
			} else {
				$("#employees_" + id_no).empty();
			}
		} else {
			alert("Please Select Company Name Transfer From AND Branch Transfer To....");
			$("#employees_" + id_no).empty();
		}
	});
	//----------END GET EMPLOYEES BASED ON THE DEPT NAME



	var hods = 1;
	var strno = 2;
	//-----ADD
	$('.add_hods').click(function (e) {
		e.preventDefault();

		var html_data = "";
		// alert(strno);
		html_data = '<div id="del_' + strno + '" class="row">';
		html_data += '	<div class="col-sm-3">'
		html_data += '		<div class="form-group">'
		html_data += '			<label class="col-form-label">Company <span class="text-danger">*</span></label>'
		html_data += '			<select type="text" class="form-control select2 cmp_data" placeholder="Company name" name="cmpname[]" id="cmpname_' + strno + '" autocomplete="off">'
		html_data += '			<option value="" data-cmpid="">Select Company</option>';
		if (cmp_master.length > 0) {
			cmp_master_parsed = JSON.parse(cmp_master);
			for (index in cmp_master_parsed) {
				html_data += '<option value="' + cmp_master_parsed[index].mxcp_id + '~' + cmp_master_parsed[index].mxcp_name + '" data-cmpid="' + cmp_master_parsed[index].mxcp_id + '">' + cmp_master_parsed[index].mxcp_name + '</option>';
			}
		}
		html_data += '          </select>'
		html_data += '	   </div>'
		html_data += '	</div>'
		html_data += '<div class="form-group">'
		html_data += '<label class="col-form-label">Division <span class="text-danger">*</span></label>'
		html_data += '<select type="text" class="form-control select2 division_data" placeholder="Company Division" name="cmpdivision[]" id="cmpdivision_' + strno + '" autocomplete="off"></select>'
		html_data += '<span class="formerror" id="cmpdiverror_' + strno + '"></span>'
		html_data += '</div>'
		html_data += '	<div class="col-sm-3">'
		html_data += '		<div class="form-group">'
		html_data += '			<label class="col-form-label">Branch <span class="text-danger">*</span></label>'
		html_data += '			<select type="text" class="form-control select2 branch_data" placeholder="Company Branch" name="cmpbranch[]" id="cmpbranch_' + strno + '" autocomplete="off"></select>'
		html_data += '			<span class="formerror" id="cmpbrancherror_' + strno + '"></span>'
		html_data += '	   </div>'
		html_data += '	</div>'
		html_data += '	<div class="col-sm-3">'
		html_data += '		<div class="form-group">'
		html_data += '			<label class="col-form-label">Department <span class="text-danger">*</span></label>'
		html_data += '			<select type="text" class="form-control select2 dept_data" placeholder="Department" name="department[]" id="department_' + strno + '" autocomplete="off"></select>'
		html_data += '			<span class="formerror" id="departmenterror_' + strno + '"></span>'
		html_data += '	   </div>'
		html_data += '	</div>'

		html_data += '	<div class="col-sm-3">'
		html_data += '		<div class="form-group">'
		html_data += '			<label class="col-form-label">Empolyees <span class="text-danger">*</span></label>'
		html_data += '			<select type="text" class="form-control select2 emp_data" placeholder="Empolyees" name="employees[]" id="employees_' + strno + '" autocomplete="off"></select>'
		html_data += '			<span class="formerror" id="employeeserror_' + strno + '"></span>'
		html_data += '	   </div>'
		html_data += '	</div>'
		html_data += '	<div class="col-sm-11"></div>'
		html_data += '<div class="col-md-1">'
		html_data += '	<div class="form-group">'
		html_data += '		<button type="button" class="form-control btn btn-danger removetrdetails" id="' + strno + '"><i class="fa fa-minus"></i></button>'
		html_data += '	</div>'
		html_data += '</div>'
		html_data += '</div>'

		$(".addhodsdetails").append(html_data);
		strno++;
		$('.removetrdetails').click(function (e) {
			e.preventDefault();
			var id = $(this).attr("id");
			$("#del_" + id).remove();
			strno--;
		});
		$('.select2').select2();
	});
	//--------END ADD

	//-----SAVE
	$("form#processhoddetails").submit(function (e) {
		e.preventDefault();
		// alert("hi");
		// return false;
		$(".cmp_data").each(function () {
			var cmp_data = $(this).val();
			if (cmp_data == "" || cmp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				$("#cmpname_" + id_no).focus();
				$('#cmpnameerror_' + id_no).html("Please Select Company Name...");
				return false;
				// break;
			}
		});
		//--------------NEW BY SHABABU
		var flag = 0;
		$(".division_data").each(function () {
			var cmp_data = $(this).val();
			if (cmp_data == "" || cmp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#cmpdivision_" + id_no).focus();
				$('#cmpdiverror_' + id_no).html("Please Select Division Name...");
				return false;
				// break;
			}
		});
		//--------------END NEW BY SHABABU
		// alert("Working");
		// return false;
		$(".branch_data").each(function () {
			var branch_data = $(this).val();
			if (branch_data == "" || branch_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#cmpbranch_" + id_no).focus();
				$('#cmpbrancherror_' + id_no).html("Please Select Branch Name...");
				return false;
				// break;
			}
		});
		$(".dept_data").each(function () {
			var dept_data = $(this).val();
			if (dept_data == "" || dept_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#department_" + id_no).focus();
				$('#departmenterror_' + id_no).html("Please Select Department Name...");
				return false;
				// break;
			}
		});
		$(".emp_data").each(function () {
			var emp_data = $(this).val();
			if (emp_data == "" || emp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#employees_" + id_no).focus();
				$('#employeeserror_' + id_no).html("Please Select HOD Employee Name...");
				return false;
				// break;
			}
		});


		if(flag == 1){
			return false;	
		}



		mainurl = baseurl + 'admin/savehoddetails';
		var formData = new FormData(this);
		$.ajax({
			url: mainurl,
			type: 'POST',
			data: formData,
			success: function (data) {
				console.log(data);
				if (data == 200) {
					alert('Successfully');
					setTimeout(function () {
						window.location.reload();
					}, 1000);
				} else if (data == 240) {
					alert("No Employee Details Found In The Transfers Table");
					return false;
				} else {
					alert('Failed To Save Please TryAgain later');
					return false;
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
	//-----END SAVE

// -------------------Added chandana 16-05-2021-------------------
	
	//-----------------edit saving ----------------
	
	$("form#eidtprocesshoddetails").submit(function (e) {
		e.preventDefault();
		$(".cmp_data").each(function () {
			var cmp_data = $(this).val();
			if (cmp_data == "" || cmp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				$("#cmpname_" + id_no).focus();
				$('#cmpnameerror_' + id_no).html("Please Select Company Name...");
				return false;
			}
		});
	
		var flag = 0;
		$(".division_data").each(function () {
			var cmp_data = $(this).val();
			if (cmp_data == "" || cmp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var cid_no = ex[1];
				flag = 1;
				$("#cmpdivision_" + id_no).focus();
				$('#cmpdiverror_' + id_no).html("Please Select Division Name...");
				return false;
			}
		});

		$(".branch_data").each(function () {
			var branch_data = $(this).val();
			if (branch_data == "" || branch_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var did_no = ex[1];
				flag = 1;
				$("#cmpbranch_" + id_no).focus();
				$('#cmpbrancherror_' + id_no).html("Please Select Branch Name...");
				return false;
			}
		});

		$(".dept_data").each(function () {
			var dept_data = $(this).val();
			if (dept_data == "" || dept_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#department_" + id_no).focus();
				$('#departmenterror_' + id_no).html("Please Select Department Name...");
				return false;
			}
		});

		$(".emp_data").each(function () {
			var emp_data = $(this).val();
			if (emp_data == "" || emp_data == 0) {
				var id = $(this).attr("id")
				var ex = id.split("_");
				var id_no = ex[1];
				flag = 1;
				$("#employees_" + id_no).focus();
				$('#employeeserror_' + eid_no).html("Please Select HOD Employee Name...");
				return false;
			}
		});

		if(flag == 1){
			return false;	
		}
		mainurl = baseurl + 'admin/editsavehoddetails';
		var formData = new FormData(this);
		$.ajax({
			url: mainurl,
			type: 'POST',
			data: formData,
			success: function (data) {
			if (data == 200) {
					alert("Sucessfully Updated ");
					setTimeout(function(){
						window.location.href = baseurl + "admin/hodsmaster"; 
					}, 100);
			} else {
					alert('Failed To Update Please TryAgain later');
					return false;
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

	//-----------------edit saving ----------------

	//  ----------------active & inactive script ---------------

    $(document).on('click', '.submit_btn', function () {
			var btn_name_id = $(this).attr("name");
			var btn_val_attr = $(this).val();
			if (btn_val_attr == "Active") {
				deactivate(btn_name_id);
			} else {
				activate(btn_name_id);
			}
			return false;
		});

	function deactivate(id) {
		var	mainurl = baseurl + 'admin/hodmaststatus';
			var status='deactivate';
				$.ajax({
					type: "POST",
					url: mainurl,
					data: {id:id, status: status},
					success: function (data4) {
						//alert(data4);
						//var id = "#submit_" + id;
						//$(id).replaceWith(data4);
						 setTimeout(function () {
						 	window.location.reload();
						 }, 10);
					}
			});
	}
	
	function activate(id) {
			var mainurl = baseurl + 'admin/hodmaststatus';
		    var status='active';
				$.ajax({
					type: "POST",
					url: mainurl,
					data: {id: id, status: status},
					success: function (data2) {
						//alert(data2)
						//var id = "#submit_" + id;
						// $(id).replaceWith(data2);
						 setTimeout(function () {
						 	window.location.reload();
						 }, 10);
					}
				});
			}
	//  ----------------active & inactive script ---------------

    // ------------------ End chandana 18-04-2021 ------------




});