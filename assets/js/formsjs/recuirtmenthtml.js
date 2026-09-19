var sno = 2;
var srno = 2;
var sprno = 2;

$(document).ready(function () {

$('.add_project_file').click(function(e) {
    e.preventDefault();
    $(".addfmdetails").append(
    	'<div id="del_'+sno+'" class="row">'
		+ '<div class="col-md-3">'
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
		+		'<input type="text" class="form-control" name="empfmname[]" id="empfmname" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+	'<div class="form-group">'
		+		'<input type="text" class="form-control" name="empfmage[]" id="empfmage" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-3">'
		+'	<div class="form-group">'
		+'		<input type="text" class="form-control" name="empfmoccupation[]" id="empfmoccupation" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
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
		+		'<input type="text" class="form-control" name="empacryop[]" id="empacryop" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+	'<div class="form-group">'
		+		'<input type="text" class="form-control" name="empacrinstitution[]" id="empacrinstitution" autocomplete="off">'
		+	'</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<input type="text" class="form-control" name="empacrsubject[]" id="empacrsubject" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-2">'
		+'	<div class="form-group">'
		+'		<input type="text" class="form-control" name="empacruniversity[]" id="empacruniversity" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
		+'		<input type="text" class="form-control" name="empacrmarks[]" id="empacrmarks" autocomplete="off">'
		+'	</div>'
		+'</div>'
		+'<div class="col-md-1">'
		+'	<div class="form-group">'
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

});
