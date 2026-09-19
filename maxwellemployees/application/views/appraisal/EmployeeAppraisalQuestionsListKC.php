<form id="saveemployeekpa">

<div class="accordion" id="kcAccordion">

<?php
$sno = 1;

foreach($assigned as $row){

$id = $row['mxap_assign_id'];
?>

<div class="accordion-item appraisal-item">

    <h2 class="accordion-header">

        <button class="accordion-button question-btn <?php echo ($sno>1?'collapsed':''); ?>"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#kc_<?php echo $id; ?>">

            <div class="w-100 d-flex justify-content-between align-items-center">

                <div>

                    <div>
                        <?php echo $sno; ?>.
                        <?php echo $row['mxap_question']; ?>
                    </div>

                </div>

                <div>

                    <span class="badge bg-primary">
                        Weightage :
                        <?php echo $row['mxap_assign_weightage']; ?>
                    </span>

                    <span class="badge bg-success">
                        Monthly Target :
                        <?php echo $kc[$row['mxap_assign_monthlytarget']]; ?>
                    </span>

                </div>

            </div>

        </button>

    </h2>

    <div id="kc_<?php echo $id; ?>"
         class="accordion-collapse collapse <?php echo ($sno==1?'show':''); ?>">

        <div class="accordion-body">

            <input type="hidden"
                   name="question_id[]"
                   value="<?php echo $id; ?>">

            <!-- Employee -->

            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button employee-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#emp_<?php echo $id; ?>">

                            👤 Employee Assessment

                        </button>

                    </h2>

                    <div id="emp_<?php echo $id; ?>"
                         class="accordion-collapse collapse show">

                        <div class="accordion-body role-card">

                            <div class="row">

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Employee Rating
                                    </label>

                                    <select name="mxap_assign_emp_noofaccounts[]"
                                            class="form-select"
                                            >

                                        <?php foreach($kc as $key=>$value){ ?>

                                        <option value="<?php echo $key; ?>"
                                        <?php echo ($key==$row['mxap_assign_emp_noofaccounts'])?'selected':''; ?>>

                                            <?php echo $value; ?>

                                        </option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Manager -->

            <?php if(in_array('MANAGER', $employeerole)){ ?>

            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button collapsed manager-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#mgr_<?php echo $id; ?>">

                            👨‍💼 Manager Review

                        </button>

                    </h2>

                    <div id="mgr_<?php echo $id; ?>"
                         class="accordion-collapse collapse">

                        <div class="accordion-body role-card">

                            <div class="row g-3">

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Manager Rating
                                    </label>

                                    <select name="mxap_assign_manager_noofaccounts[]"
                                            class="form-select">

                                        <?php foreach($kc as $key=>$value){ ?>

                                        <option value="<?php echo $key; ?>"
                                        <?php echo ($key==$row['mxap_assign_manager_noofaccounts'])?'selected':''; ?>>

                                            <?php echo $value; ?>

                                        </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <div class="col-md-8">

                                    <label class="form-label">
                                        Manager Review
                                    </label>

                                    <input type="text"
                                           name="managerdesc[]"
                                           class="form-control"
                                           value="<?php echo $row['mxap_assign_manager_review']; ?>">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>

            <!-- HOD -->

            <?php if(in_array('HOD', $employeerole)){ ?>

            <div class="accordion role-accordion">

                <div class="accordion-item border-0">

                    <h2 class="accordion-header">

                        <button type="button"
                                class="accordion-button collapsed hod-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#hod_<?php echo $id; ?>">

                            🏢 HOD Review

                        </button>

                    </h2>

                    <div id="hod_<?php echo $id; ?>"
                         class="accordion-collapse collapse">

                        <div class="accordion-body role-card">

                            <div class="row g-3">

                                <div class="col-md-4">

                                    <label class="form-label">
                                        HOD Rating
                                    </label>

                                    <select name="mxap_assign_hod_noofaccounts[]"
                                            class="form-select">

                                        <?php foreach($kc as $key=>$value){ ?>

                                        <option value="<?php echo $key; ?>"
                                        <?php echo ($key==$row['mxap_assign_hod_noofaccounts'])?'selected':''; ?>>

                                            <?php echo $value; ?>

                                        </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <div class="col-md-8">

                                    <label class="form-label">
                                        HOD Review
                                    </label>

                                    <input type="text"
                                           name="hoddesc[]"
                                           class="form-control"
                                           value="<?php echo $row['mxap_assign_hod_review']; ?>">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php
$sno++;
}
?>

</div>

<div class="mt-3 text-end">
<?php if(count($assigned) > 0) { ?>
<button type="submit"
        id="saveKpaBtn"
        class="btn btn-success">

    Save Key Competencies

</button>
<?php } ?>
</div>

</form>

<script>

$(document).ready(function(){

    $("#saveemployeekpa").on("submit", function(e){

        e.preventDefault();

        var formData = new FormData(this);

        var $btn = $("#saveKpaBtn");

        $.ajax({

            url : "<?php echo base_url('Employee/saveemployeekc'); ?>",

            type : "POST",

            data : formData,

            dataType : "json",

            cache : false,

            contentType : false,

            processData : false,

            beforeSend : function(){

                $btn.prop("disabled", true);

                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Saving...'
                );

            },

            success : function(response){

                $btn.prop("disabled", false);

                $btn.html("Save Key Competencies");

                if(response.status == 1){

                    alert(response.message);

                }else{

                    alert(response.message);

                }

            },

            error : function(xhr){

                $btn.prop("disabled", false);

                $btn.html("Save Key Competencies");

                console.log(xhr.responseText);

                alert("Something went wrong.");

            }

        });

    });

});

</script>