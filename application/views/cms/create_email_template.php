<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">


                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="tab-content profile-tab-content">
                                
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Create Templates</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Templates</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
                                
                                <!-- Create Client Tab -->
                                <div id="createclient" class="tab-pane fade show active">
                                    <button class="btn btn-white float-end ms-3" data-bs-toggle="modal" data-bs-target="#add_client_popup" onclick="getemailtemplate('')"><i class="fa fa-plus"></i> Add Template</button>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Template Id</th>
                                                    <th>Division</th>
                                                    <th>Title</th>
                                                    <th>Subject</th>
                                                    <th>To</th>
                                                    <th>CC</th>
                                                    <th>BCC</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $snoc = 1; foreach ($list['emailstemplates'] as $ckey => $cvalue) { ?>
                                                <tr>
                                                    <td><?php echo $cvalue->id; ?></td>
                                                    <td>
                                                        <?php if(array_key_exists($cvalue->email_division,$divisionjob)){ echo $divisionjob[$cvalue->email_division];}else{echo 'ALL';} ?>
                                                    </td>
                                                    <td><?php echo $cvalue->email_title; ?></td>
                                                    <td><?php echo $cvalue->email_subject; ?></td>
                                                    <td><?php echo $cvalue->email_to; ?></td>
                                                    <td><?php echo $cvalue->email_cc; ?></td>
                                                    <td><?php echo $cvalue->email_bc; ?></td>
                                                    <td>
                                                        <a type="button" data-bs-toggle="modal" data-bs-target="#add_client_popup" onclick="getemailtemplate('<?php echo $cvalue->id ?>')" class="float-end btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                        <?php if($cvalue->email_status == 1){ ?>
                                                        <a style="margin-right: 10px;" type="button" onclick="deleteemailtemplateinfobyid('<?php echo $cvalue->id ?>','DeActivate')" class="float-end btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                        <?php }else{ ?>
                                                        <a style="margin-right: 10px;" type="button" onclick="deleteemailtemplateinfobyid('<?php echo $cvalue->id ?>','Activate')" class="float-end btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $snoc++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Create Client Tab -->
                            </div>
                        </div>
                    </div>
    </div>
    <!-- /Page Content -->
    
</div>
<!-- /Page Wrapper -->


<!-- Add Client Modal -->
<div id="add_client_popup" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Template</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <form id="addnewemailtemplate" method="POST" enctype='multipart/form-data'>
            <div class="modal-body" id="emailtemplatepopup_display">

            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Client Modal -->

<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>

<script>
    function getemailtemplate(id){
    mainurl = baseurl+'Reports/getemailtemplate';
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: {'id':id},
     success: function (data) {
        $('#emailtemplatepopup_display').html(data);
         // ckeditor
        //   var users = mentionsemails,
            tags = ['american','asian','baking','breakfast','cake','caribbean','chinese','chocolate','cooking','dairy','delicious','delish','dessert','desserts','dinner','eat','eating','eggs','fish','food','foodgasm','foodie','foodporn','foods','french','fresh','fusion','glutenfree','greek','grilling','halal','homemade','hot','hungry','icecream','indian','italian','japanese','keto','korean','lactosefree','lunch','meat','mediterranean','mexican','moroccan','nom','nomnom','paleo','poultry','snack','spanish','sugarfree','sweet','sweettooth','tasty','thai','vegan','vegetarian','vietnamese','yum','yummy'
            ];

          CKEDITOR.replace('desc', {
            // plugins: 'mentions,emoji,basicstyles,undo,link,wysiwygarea,toolbar, pastefromgdocs, pastefromlibreoffice, pastefromword',
            contentsCss: [
              baseurl+'assets/ckeditor/contents.css',
              baseurl+'assets/ckeditor/mentions/contents.css'
            ],
            height: 350,
            toolbar: [
              { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview' ] },
              [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
              { name: 'links', items: [ 'Link', 'Unlink','JustifyLeft','JustifyCenter', 'JustifyRight', 'JustifyBlock','NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote','Table' ] },
              { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
              { name: 'tools', items: ['Maximize', 'ShowBlocks']},
            ],
            mentions: [{
                feed: dataFeed,
                itemTemplate: '<li data-id="{id}">' +
                  '<img class="photo" style="border: 2px solid #fff;border-radius: 100%; height:30px; width:30px;" src="{avatar}" />' +
                  '<strong class="username">{username}</strong>' +
                  ' <span class="fullname">[{email}]</span>' +
                  '</li>',
                outputTemplate: '<a href="mailto:{email}">[{email}]</a><span>&nbsp;</span>',
                minChars: 0
              },
              {
                feed: tags,
                marker: '#',
                itemTemplate: '<li data-id="{id}"><strong>{name}</strong></li>',
                // outputTemplate: '<a href="https://example.com/social?tag={name}">{name}</a><span>&nbsp;</span>',
                minChars: 1
              }
            ],
            removeButtons: 'PasteFromWord'
          });

          function dataFeed(opts, callback) {
            var matchProperty = 'username',
              data = users.filter(function(item) {
                return item[matchProperty].indexOf(opts.query.toLowerCase()) == 0;
              });

            data = data.sort(function(a, b) {
              return a[matchProperty].localeCompare(b[matchProperty], undefined, {
                sensitivity: 'accent'
              });
            });

            callback(data);
          }
         // ckeditor
     }
    }); 
}


// -------------------------- submit the button -------------------


$("form#addnewemailtemplate").submit(function(e) {
    e.preventDefault(); 
    var title = $("#title").val();
    if (title.trim() == "") {
        alert('Please Enter Title');
        return false;
    }

    var subject = $("#subject").val();
    if (subject.trim() == "") {
        alert('Please Enter Subject');
        return false;
    }

   for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
   }

    var desc = $("#desc").val();
    if (desc.trim() == "") {
        alert('Please Enter Description');
        return false;
    }
      var formData = new FormData(this);
      var showinletters = 0;
        if ($("#showinletters").prop("checked")) {
        showinletters = 1;
        }
      formData.append('showinletters', showinletters);
    //   console.log(formData);
      mainurl = baseurl+'Reports/saveemailtemplate';
      $.ajax({
         url: mainurl,
         type: 'POST',
         data: formData,
         success: function (data) {
        var result = $.parseJSON(data);
            // console.log(data);
        if(result.respone == 200){
            alert('Successfully');
            setTimeout(function(){
              window.location.reload();
            }, 100); 
        } else {
            alert('Failed To Save Please TryAgain Later');
        }
        },
        cache: false,
        contentType: false,
        processData: false
      });      
});

function deleteemailtemplateinfobyid(companyid,status){
    var confirmSubmit = confirm('Are you sure you want to ' + status);
    if (!confirmSubmit) {
        return false;
    }
    mainurl = baseurl+'Reports/deleteemailtemplateinfobyid';
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: {'id':companyid, 'status':status},
     success: function (data) {
        var result = $.parseJSON(data);
         if(result.respone == 200){
            alert('Successfully');
            setTimeout(function(){
               window.location.reload();
            }, 100); 
         } else {
            alert('Failed To Save Please TryAgain Later');
         }
     }
    }); 
}

</script>


