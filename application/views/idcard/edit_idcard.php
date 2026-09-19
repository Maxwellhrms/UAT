<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Create ID Card</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">ID Cards</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

  
    
        <div class="tab-content">

        <!-- ID Card Tab -->
        <div id="idcard_tab" class="pro-overview tab-pane fade show active">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <!--<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#incomeaddnew">Add New</button>-->
            <div id="incomeaddnew" class="collapse show">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">ADD ID CARD</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="#" id="idcard_form">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Company</label>
                                                <div class="col-lg-9">
                                                    <input type="hidden" name="idcard_id" value="<?php echo $idcard_id; ?>">
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="idcard_cmp_id" id="idcard_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            if($idcards_data[0]->mxemp_idcard_cmp_id == $companies->mxcp_id ){
                                                                echo "<option value=" . $companies->mxcp_id . " selected>" . $companies->mxcp_name . "</option>";
                                                            }else{
                                                                echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                        <!--<option value="1">New Text</option>-->
                                                        <!--<option value="2">Old Text</option>-->
                                                    </select>
                                                    <span class="formerror" id="idcard_cmp_id_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-xl-6">-->
                                        <!--    <div class="form-group row" style="margin-top: 10px;">-->
                                        <!--        <label class="col-lg-3 col-form-label">Email From</label>-->
                                        <!--        <div class="col-lg-9">-->
                                        <!--            <input type="text" name="email_from" id="email_from" class="form-control m-b-20" value="<?php echo $idcards_data[0]->mxemp_idcard_email_from; ?>" placeholder="enter email address">-->
                                        <!--            <span class="formerror" id="email_from_error"></span>-->


                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Message Subject</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="msg_subject" id="msg_subject" class="form-control m-b-20" value="<?php echo $idcards_data[0]->mxemp_idcard_msg_subject; ?>">
                                                    <span class="formerror" id="msg_subject_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Message Description</label>
                                                <div class="col-lg-9">
                                                    <textarea name="msg_desc" id="msg_desc" rows="5" cols="5" class="form-control" placeholder="Enter Message Description"><?php echo $idcards_data[0]->mxemp_idcard_msg_description; ?></textarea>
                                                    <span class="formerror" id="msg_desc_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Email Subject</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="email_subject" id="email_subject" class="form-control m-b-20" value="<?php echo $idcards_data[0]->mxemp_idcard_email_subject; ?>">
                                                    <span class="formerror" id="email_subject_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Email Description</label>
                                                <div class="col-lg-9">
                                                    <textarea name="email_desc" id="email_desc" rows="5" cols="5" class="form-control" placeholder="Enter Email Description"><?php echo $idcards_data[0]->mxemp_idcard_email_description; ?></textarea>
                                                    <span class="formerror" id="email_desc_error"></span>


                                                </div>
                                            </div>
                                        </div>
             <!--                           <div class="col-xl-6">-->
             <!--                               <div class="form-group row">-->
             <!--                                   <label class="col-lg-3 col-form-label">ID Card Image</label>-->
             <!--                                   <div class="col-lg-9">-->
             <!--                                       <img id="blah1" src="<?php echo base_url() . $idcards_data[0]->mxemp_idcard_img_path; ?>" hieght="160px" width="160px">-->
													<!--<input id="pic" name="file" class='pis' onchange="readURL(this,'img1');" type="file">-->
             <!--                                       <span class="formerror" id="pic_error"></span>-->
             <!--                                   </div>-->
             <!--                               </div>-->


             <!--                           </div>-->
                                        
                                    </div>
                                    
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" id="inc_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
         


        </div>
        <!-- /ID Card Tab -->



    </div>
    </div>
</div>
<script>
    // var income_type = "<?php echo $this->uri->segment(3); ?>"

    // if (income_type == "deduction_type") {
    //     $("#income_li").removeClass("active");
    //     $("#income_tab").removeClass("show active");

    //     $("#deduction_li").addClass("active");
    //     $("#deduction_tab").addClass("show active");

    // }
    function readURL(input, img) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				if (img == 'img1') {
					$('#blah1').attr('src', e.target.result);
				}
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(".idcard_image").click(function(){
	    var idcard_image_path = $(".idcard_image").attr("src");
	    $(".modal_id_card_image").attr("src",idcard_image_path);
	    $("#image_modal").modal("show");
	});
</script>
<script>
    var page_type = 2;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/add_idcard.js"></script>
