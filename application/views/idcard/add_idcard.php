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

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#idcard_tab" data-toggle="tab" class="nav-link active" id="idcard_li">ID Card</a></li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="tab-content">

        <!-- ID Card Tab -->
        <div id="idcard_tab" class="pro-overview tab-pane fade show active">
            <?php if($this->session->userdata('user_role_add') == 1){ ?>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#incomeaddnew">Add New</button>
            <div id="incomeaddnew" class="collapse">
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
                                                    <select class="select2 form-control" data-placeholder="Select Company" name="idcard_cmp_id" id="idcard_cmp_id" style="width: 100%;">
                                                        <option value="0">Select Company</option>
                                                        <?php
                                                        foreach ($cmpmaster as $companies) {
                                                            echo "<option value=" . $companies->mxcp_id . ">" . $companies->mxcp_name . "</option>";
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
                                        <!--            <input type="text" name="email_from" id="email_from" class="form-control m-b-20" placeholder="enter email address">-->
                                        <!--            <span class="formerror" id="email_from_error"></span>-->


                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Message Subject</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="msg_subject" id="msg_subject" class="form-control m-b-20">
                                                    <span class="formerror" id="msg_subject_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Message Description</label>
                                                <div class="col-lg-9">
                                                    <textarea name="msg_desc" id="msg_desc" rows="5" cols="5" class="form-control" placeholder="Enter Message Description"></textarea>
                                                    <span class="formerror" id="msg_desc_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Email Subject</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="email_subject" id="email_subject" class="form-control m-b-20">
                                                    <span class="formerror" id="email_subject_error"></span>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <label class="col-lg-3 col-form-label">Email Description</label>
                                                <div class="col-lg-9">
                                                    <textarea name="email_desc" id="email_desc" rows="5" cols="5" class="form-control" placeholder="Enter Email Description"></textarea>
                                                    <span class="formerror" id="email_desc_error"></span>


                                                </div>
                                            </div>
                                        </div>
             <!--                           <div class="col-xl-6">-->
             <!--                               <div class="form-group row">-->
             <!--                                   <label class="col-lg-3 col-form-label">ID Card Image</label>-->
             <!--                                   <div class="col-lg-9">-->
             <!--                                       <img id="blah1" src="<?php echo base_url() . 'assets/img/160x160.png' ?>" hieght="160px" width="160px">-->
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
            <!-- Data Tables -->
            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">ID Card LIST</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            //print_r($pf_statutory);
                            //exit;
                            ?>
                            <div class="table-responsive">
                                <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Company Name</th>
                                            <th>Message Subject</th>
                                            <th>Message Desc</th>
                                            <!--<th>Email From</th>-->
                                            <th>Email Subject</th>
                                            <th>Email Desc</th>
                                            <!--<th>Image</th>-->
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        foreach ($idcards_data as $idcard) {
                                            echo '<tr>';
                                            echo '<td>' . $sno . '</td>';
                                            echo '<td>' . $idcard->mxcp_name . '</td>';
                                            echo '<td>' . $idcard->mxemp_idcard_msg_subject . '</td>';
                                            echo '<td>' . $idcard->mxemp_idcard_msg_description . '</td>';
                                            // echo '<td>' . $idcard->mxemp_idcard_email_from . '</td>';
                                            echo '<td>' . $idcard->mxemp_idcard_email_subject . '</td>';
                                            echo '<td>' . $idcard->mxemp_idcard_email_description . '</td>';
                                            // echo '<td><img src="' . base_url() .$idcard->mxemp_idcard_img_path.'" width="70px" height="70px" class="idcard_image" style="cursor:pointer"></td>';
                                            echo '<td>';
                                            echo '<div class="dropdown dropdown-action">';
                                            echo '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>';
                                            echo '<div class="dropdown-menu dropdown-menu-right">';
                                            
                                            if($this->session->userdata('user_role_edit') == 1){
                                            echo '<a class="dropdown-item" href="' . base_url() . 'admin/edit_idcard/' . $idcard->mxemp_idcard_id . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if($this->session->userdata('user_role_delete') == 1){ 
                                            echo '<a class="dropdown-item deletemodal income_delete" data-toggle="modal" data-target="#income_del_tab" data-id="' . $idcard->mxemp_idcard_id  . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            } 
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';

                                            $sno++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Data Tables -->

            <!-- Delete PF Statutory Modal -->
            <div class="modal custom-modal fade" id="income_del_tab" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete ID Card</h3>
                                <h3 style="color: red" id="inc_del_comp"></h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <input type="hidden" name="inc_id_hidden" id="inc_id_hidden">
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="processdeletedata_idcard">Delete</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Income Modal -->
            
            <div class="modal custom-modal fade" id="image_modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
      <!--                  <div class="modal-header">-->
						<!--	<h5 class="modal-title">ID Card Image</h5>-->
						<!--	<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
						<!--		<span aria-hidden="true">×</span>-->
						<!--	</button>-->
						<!--</div>-->
                        <div class="modal-body">
                           <img src="" class="modal_id_card_image" hieght="100%" width="100%">
                        </div>
                    </div>
                </div>
            </div>


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
    var page_type = 1;
</script>
<script src="<?php echo base_url(); ?>/assets/js/formsjs/add_idcard.js"></script>
