var sno = 2;
var srno = 2;
var strno = 2;
var sprno = 2;
var sknlgno = 2;
var snno = 2;
var snrfno = 2;
var lang_sno = 1;

$(document).ready(function () {

//------------------------------LANGUAGES
$('.add_lang_btn').click(function(e) {
    e.preventDefault();
    var id="#div_"+lang_sno
    lang_sno++;
    	
	var html_data = '<div class="row" id="div_'+lang_sno+'">';
	 	html_data+='<div class="col-md-3">';
			html_data+='<div class="form-group">';
				html_data+='<label>Language:</label>';
				html_data+='<select class="select2 form-control" name="emplanguage_'+lang_sno+'" id="emplanguage'+lang_sno+'">';
					html_data+='<option value="">Select Language</option>';
					for(index in languages){
					html_data+='<option value='+languages[index].mxlg_id+'>'+languages[index].mxlg_name+'</option>';
					}
				html_data+='</select>';
				html_data+='<span class="formerror" id="emplanguageerror_'+lang_sno+'"></span>';
			html_data+='</div>';
		html_data+='</div>'; 

		html_data+='<div class="col-md-2">';
			html_data+='<div class="form-group">';
				html_data+='<label>Speak:</label>';
				html_data+='<input class="form-control col-md-2" type="checkbox" name="empspeak_'+lang_sno+'" id="empspeak_'+lang_sno+'" value="1">';
			html_data+='</div>';
		html_data+='</div>';
		html_data+='<div class="col-md-2">';
			html_data+='<div class="form-group">';
				html_data+='<label>Read:</label>';
				html_data+='<input class="form-control col-md-2" type="checkbox" name="empread_'+lang_sno+'" id="empread_'+lang_sno+'" value="1">';
			html_data+='</div>';
		html_data+='</div>';
		html_data+='<div class="col-md-2">';
			html_data+='<div class="form-group">';
				html_data+='<label>Write:</label>';
				html_data+='<input class="form-control col-md-2" type="checkbox" name="empwrite_'+lang_sno+'" id="empwrite_'+lang_sno+'" value="1">';
			html_data+='</div>';
		html_data+='</div>';
		html_data+='<input type="hidden" name="lang_array[]" value="'+lang_sno+'">';
		html_data+='<div class="col-md-1">';
			html_data+='<div class="form-group">';
				html_data+='<label>&nbsp;</label>';
				html_data+='<button type="button" class="form-control btn btn-danger removelang_btn" id="add_remove_'+lang_sno+'"><i class="fa fa-minus"></i></button>';
			html_data+='</div>';
		html_data+='</div>';
	html_data+='</div>';

	html_data+='<span class="addknlgdetails"></span>';

    $('#lang_div').append(html_data);
    
});
$(document).on('click','.removelang_btn',function(e){
    e.preventDefault();
    var rmv_id = $(this).attr("id");
    var sp = rmv_id.split('_');
    $("#div_" + sp[2]).remove();
});

//------------------------------END LANGUAGES


$('.add_project_file').click(function(e) {
    e.preventDefault();
    $(".addfmdetails").append(
    	'<div id="del_'+sno+'" class="row">'
    		+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+	'<select class="form-control" name="emptitle[]" id="emptitle">'
            +		'<option value="">Select Type</option>'
			+		'<option value="MRS">Mrs</option>'
			+		'<option value="MR">Mr</option>'
			+		'<option value="MS">MS</option>'
			+		'<option value="LATE">Late</option>'
			+'	</select>'
			+'	</div>'
			+'</div>'
		+ '<div class="col-md-2">'
			+ '<div class="form-group">'
			+	'<select class="form-control" name="empfmrelation[]" id="empfmrelation">'
			+		'<option value="">Select Relation</option>'
			+		'<option value="Father">Father</option>'
			+		'<option value="Mother">Mother</option>'
			+		'<option value="Brother">Brother</option>'
			+		'<option value="Sister">Sister</option>'
			+		'<option value="Husband">Husband</option>'
			+		'<option value="Wife">Wife</option>'
			+		'<option value="Children">Children</option>'
			+	'</select>'
			+'</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+	'<div class="form-group">'
		+		'<input type="text" class="form-control" name="empfmname[]" id="empfmname" autocomplete="off" placeholder="Name as per aadhar">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+	'<div class="form-group">'
		+		'<input type="date" class="form-control" data-date-format="DD M YYYY" name="empfmage[]" id="empfmage" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
		+'		<button type="button" class="form-control btn btn-danger removefmdetails" id="'+sno+'">Remove</button>'
		+'	</div>'
		+'</div>'
		+'</div>'
    );
    sno ++;
    $('.removefmdetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    sno--;
	});
});


$('.add_ar_file').click(function(e) {
    e.preventDefault();
    $(".addardetails").append(
    	'<div id="del_'+srno+'" class="row">'
		+ '<div class="col-md-2">'
			+ '<div class="form-group">'
			+   '<label>Type:</label>'
			+	'<select class="form-control" name="empacrtype[]" id="empacrtype">'
			+	'<option value="">Select</option>'
			+	'<option value="General">General</option>'
			+	'<option value="Professional">Professional</option>'
			+	'<option value="NON Mertic">NON Mertic</option>'
			+	'<option value="Mertic">Mertic</option>'
			+	'<option value="SSC">SSC</option>'
			+	'<option value="Inter">Inter</option>'
			+	'<option value="Degree">Degree</option>'
			+	'<option value="Diploma">Diploma</option>'
			+	'<option value="PHD">PHD</option>'
			+	'<option value="Senior Secondary">Senior Secondary</option>'
			+	'</select>'
			+'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+	'<div class="form-group">'
		+   '<label>Year of Passing:</label>'
		+		'<input type="text" class="form-control" name="empacryop[]" id="empacryop" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+	'<div class="form-group">'
		+   '<label>Institution:</label>'
		+		'<input type="text" class="form-control" name="empacrinstitution[]" id="empacrinstitution" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+   '<label>Subject:</label>'
		+'		<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+   '<label>University:</label>'
		+'		<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
		 +   '<label>Marks%:</label>'
		+'		<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+   '<label>Image</label>'
		+'		<input type="file" class="form-control" name="empacrimage[]" id="empacrimage" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
	    +   '<label>&nbsp;</label>'
		
		+'		<button type="button" class="form-control btn btn-danger removefmdetails" id="'+srno+'"><i class="fa fa-minus"></i></button>'
		+'	</div>'
		+'</div>'
		+'</div>'
    );
    srno ++;
    $('.removefmdetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    srno--;
	});
});


$('.add_tr_file').click(function(e) {
    e.preventDefault();
    $(".addtrdetails").append(
    	'<div id="del_'+strno+'" class="row">'
		+ '<div class="col-md-3">'
			+ '<div class="form-group">'
			+   '<label>Name of the Course:</label>'
			+ '<input type="text" class="form-control" name="emptrcourse[]" id="empcourse" autocomplete="off">'
			+'</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+	'<div class="form-group">'
		+   '<label>Name of the Institution:</label>'
		+		'<input type="text" class="form-control" name="emptrinstitution[]" id="emptrinstitution" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+	'<div class="form-group">'
		+   '<label>From:</label>'
		+		'<input type="text" class="form-control datetimepicker" name="emptrfrom[]" id="emptrfrom" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+   '<label>To:</label>'
		+'		<input type="text" class="form-control datetimepicker" name="emptrto[]" id="emptrto" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		  +   '<label>Image:</label>'
		+'		<input type="file" class="form-control" name="emptrimage[]" id="emptrimage" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
		+ '<label>&nbsp;</label>'
		+'		<button type="button" class="form-control btn btn-danger removetrdetails" id="'+strno+'"><i class="fa fa-minus"></i></button>'
		+'	</div>'
		+'</div>'
		+'</div>'
    );
    strno ++;
    $('.removetrdetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    strno--;
	});
});

$('.add_pre_file').click(function(e) {
    e.preventDefault();
    $(".addpredetails").append(
    	'<div id="del_'+sprno+'" class="row">'
			+'<div class="col-md-4">'
			+'	<div class="form-group">'
			+'		<label>Period From - To:</label>'
			+'		<input type="text" class="form-control" name="emppreviousprediofromto[]" id="emppreviousprediofromto" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-4">'
			+'	<div class="form-group">'
			+'		<label>Name & Orgination:</label>'
			+'		<textarea class="form-control" name="emppreviousorgnation[]" id="emppreviousorgnation"></textarea>'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+'		<label>Desg Joining Time:</label>'
			+'		<input type="text" class="form-control" name="emppreviousdesgjointime[]" id="emppreviousdesgjointime" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+'		<label>Desg Leaving Time:</label>'
			+'		<input type="text" class="form-control" name="emppreviousleavingtime[]" id="emppreviousleavingtime" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-4">'
			+'	<div class="form-group">'
			+'		<label>Reported To (Desgn):</label>'
			+'		<input type="text" class="form-control" name="emppreviousreportedto[]" id="emppreviousreportedto" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+'		<label>Salary per month:</label>'
			+'		<input type="text" class="form-control" name="empprevioussalarypermonth[]" id="empprevioussalarypermonth" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+'		<label>Other Benfits:</label>'
			+'		<input type="text" class="form-control" name="emppreviousotherbenfits[]" id="emppreviousotherbenfits" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-2">'
			+'	<div class="form-group">'
			+'		<label>Reason For Change:</label>'
			+'		<input type="text" class="form-control" name="emppreviousreasonchange[]" id="emppreviousreasonchange" autocomplete="off">'
			+'	</div>'
			+'</div>'
			+'<div class="col-md-1">'
			+'	<div class="form-group">'
			+'		<label>&nbsp;</label>'
		+'		<button type="button" class="form-control btn btn-danger removepredetails" id="'+sprno+'"><i class="fa fa-minus"></i></button>'
			+'	</div>'
			+'</div>'
		+'</div>'
    );
    sprno ++;
    $('.removepredetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    sprno--;
	});
});



$('.add_knlg_file').click(function(e) {
    e.preventDefault();
		var html_knlg = '<div id="del_'+sknlgno+'" class="row">';
		html_knlg += '<div class="col-md-3">';
		html_knlg +='	<div class="form-group">';
		html_knlg +='		<select class="form-control select2" name="emplanguage[]" id="emplanguage[]">';
		html_knlg +='			<option value="">Select Language</option>';
		
		// console.log(languages);
					for(index in languages){
		html_knlg +='			<option value='+languages[index].mxlg_id+'>'+languages[index].mxlg_name+'</option>';
					}
		html_knlg +='		</select>';
		html_knlg +='	</div>';
		html_knlg +='</div>';
		html_knlg +='<div class="col-md-3">';
			html_knlg +='<div class="form-group">';
				html_knlg +='<label>Language Type:</label>';
				html_knlg +='<select class="form-control select2" multiple="multiple" name="lgtypes[]" id="lgtypes[]" style="width: 100%;">';
					html_knlg +='<option value="">Select Types</option>';
						html_knlg +='<option value="Speak">Speak</option>';
						html_knlg +='<option value="Read">Read</option>';
						html_knlg +='<option value="Write">Write</option>';
				html_knlg +='</select>';
				html_knlg +='<span class="formerror" id="lgtypeserror"></span>';
			html_knlg +='</div>';
		html_knlg +='</div>';
		html_knlg +='<div class="col-md-1">';
		html_knlg +='	<div class="form-group">';
		html_knlg +='		<button type="button" class="form-control btn btn-danger removeknlgdetails" id="'+sknlgno+'"><i class="fa fa-minus"></i></button>';
		html_knlg +='	</div>';
		html_knlg +='</div>';
		html_knlg +='</div>';
    

    $(".addknlgdetails").append(html_knlg);
    	
    sknlgno ++;
    $('.removeknlgdetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    sknlgno--;
	});
});

// ESI NOMINEE
$('.add_esi_file').click(function(e) {
    e.preventDefault();
    $(".addesidetails").append(
    	'<hr>'
    	+'<div id="del_'+snno+'" class="row">'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<label>Nominee Type:</label>'
		+'		<select class="form-control" name="esinomineerelationtype[]" id="esinomineerelationtype">'
		+'			<option value="">Type</option>'
		+'			<option value="ESI">ESI</option>'
		+'			<option value="PF">PF</option>'
		+'			<option value="GRATUITY">GRATUITY</option>'
		+'		</select>'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<label>Nominee Relation:</label>'
		+'		<select class="form-control" name="esinomineerelation[]" id="esinomineerelation">'
		+'			<option value="">Relation</option>'
		+'			<option value="Father">Father</option>'
		+'			<option value="Mother">Mother</option>'
		+'			<option value="Brother">Brother</option>'
		+'			<option value="Sister">Sister</option>'
		+'			<option value="Husband">Husband</option>'
		+'			<option value="Wife">Wife</option>'
		+'			<option value="Children">Children</option>'
		+'		</select>'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<label>Name:</label>'
		+'		<input type="text" class="form-control" name="esinomineename[]" id="esinomineename" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
		+'		<label>Age:</label>'
		+'		<input type="text" class="form-control" name="esinomineeage[]" id="esinomineeage" autocomplete="off">'
		+'	</div>'
		+'</div>'

		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<label>Mobile:</label>'
		+'		<input type="number" class="form-control" name="esinomineemobile[]" id="esinomineemobile" autocomplete="off">'
		+'	</div>'
		+'</div>'

		+'<div class="col-md-4">'
		+'	<div class="form-group">'
		+'		<label>Address</label>'
		+'		<textarea class="form-control" name="esinomineeaddress[]" id="esinomineeaddress"></textarea>'
		+'	</div>'
		+'</div>'

		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<label>Nominee %:</label>'
		+'		<input type="number" class="form-control" name="esinomineepercent[]" id="esinomineepercent" autocomplete="off">'
		+'	</div>'
		+'</div>'

		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<label>Image</label>'
		+'		<input type="file" class="form-control" name="esinomineeimage[]" id="esinomineeimage" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<button type="button" class="form-control btn btn-danger removenomineeesidetails" id="'+snno+'">Remove</button>'
		+'	</div>'
		+'</div>'
		+'</div>'
    );
    snno ++;
    $('.removenomineeesidetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    snno--;
	});
});
// ESI NOMINEE
// REFRENCE
$('.add_refrence_file').click(function(e) {
    e.preventDefault();
    $(".addrefrencedetails").append(
    	'<hr>'
    	+'<div id="del_'+snrfno+'" class="row">'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<label>Company Type:</label>'
		+'		<select class="form-control" name="refrencecmptype[]" id="refrencecmptype">'
		+'			<option value="">Type</option>'
		+'			<option value="MAXWELL">MAXWELL</option>'
		+'			<option value="ARC">ARC</option>'
		+'			<option value="WEBSITES">WEBSITES</option>'
		+'			<option value="NAUKRI">NAUKRI</option>'
		+'			<option value="WALKIN">WALKIN</option>'
		+'			<option value="JOBPORTAL">JOB PORTAL</option>'
		+'			<option value="LINKEDIN">LINKEDIN</option>'
		+'			<option value="OTHERS">OTHERS</option>'
		+'		</select>'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<label>Refrence Name:</label>'
		+'		<input type="text" class="form-control" name="refrencename[]" id="refrencename" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<label>Relation With Candidate:</label>'
		+'		<input type="text" class="form-control" name="refrencenwcnd[]" id="refrencenwcnd" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<label>Mobile:</label>'
		+'		<input type="number" class="form-control" name="refrencemobile[]" id="refrencemobile" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<button type="button" class="form-control btn btn-danger removerefdetails" id="'+snrfno+'">Remove</button>'
		+'	</div>'
		+'</div>'
		+'</div>'
    );
    snrfno ++;
    $('.removerefdetails').click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#del_" + id).remove();
    snrfno--;
	});
});
// REFRENCE

});
