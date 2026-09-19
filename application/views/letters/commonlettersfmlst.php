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
								<h3 class="page-title">Create Appoinment letter</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Create Appoinment letter</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
                    <!-- Filters -->
                            <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filter Recruitment
                        <button class="btn btn-primary float-end ms-3" style="float:right;" data-bs-toggle="modal" data-bs-target="#add_client_popup" onclick="letterform('')"><i class="fa fa-plus"></i> Add Appoinment letter</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="processcmpdetails" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>From Date:</label>
                                                <input type="text" name="fromdatefilter" id="fromdatefilter" class="form-control datetimepicker" value="<?php  echo date('d-m-Y'); ?>" required="">
                                                <span class="formerror" id="fromdateerror"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>To Date:</label>
                                                <input type="text" name="todatefilter" id="todatefilter" class="form-control datetimepicker" value="<?php  echo date('d-m-Y'); ?>" required="">
                                                <span class="formerror" id="todateerror"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Letter Type:</label>
                                                <select name="typeofletterfilter" id="typeofletterfilter" class="form-control">
                                                    <option value="">Select Letter Type</option>
                                                    <?php foreach ($type as $key => $stvalue) { ?>
                                                        <option value="<?php echo $key ?>" ><?php echo $stvalue ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <select name="letter_statusfilter" id="letter_statusfilter" class="form-control select2" style="width: 100%;" autocomplete="off">
                                                <option value="">Select Status</option>
                                                <?php foreach ($app_status as $apkey => $apstvalue) { ?>
                                                    <option value="<?php echo $apkey ?>"><?php echo $apstvalue ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" onclick="filterlist()">Get Details</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    <!-- Filters -->
                                
                                <!-- Create Client Tab -->
                                <br>
                                <div id="createclient" class="tab-pane fade show active">
                                    <div class="table-responsive" id="listview">
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
                <h4 class="modal-title">Letters</h4>
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
    function letterform(id){
    mainurl = baseurl+'Recruitment/letterform';
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
            height: 150,
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

        CKEDITOR.replace('pdfdata', {
            // plugins: 'mentions,emoji,basicstyles,undo,link,wysiwygarea,toolbar, pastefromgdocs, pastefromlibreoffice, pastefromword',
            contentsCss: [
              baseurl+'assets/ckeditor/contents.css',
              baseurl+'assets/ckeditor/mentions/contents.css'
            ],
            height: 150,
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
    // var title = $("#title").val();
    // if (title.trim() == "") {
    //     alert('Please Enter Title');
    //     return false;
    // }

    // var subject = $("#subject").val();
    // if (subject.trim() == "") {
    //     alert('Please Enter Subject');
    //     return false;
    // }

   for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
   }
    var trnsid = $("#trnsid").val();
    var desc = $("#desc").val();
    var typeofletter = $("#typeofletter").val();
    if(typeofletter != '4'){
        if (desc.trim() == "") {
            alert('Please Enter Address');
            return false;
        }
    }
      var formData = new FormData(this);
      mainurl = baseurl+'Recruitment/saveletters';
      $.ajax({
         url: mainurl,
         type: 'POST',
         data: formData,
         success: function (data) {
        var result = $.parseJSON(data);
            // console.log(data);
        if(result.respone == 200){
            alert('Successfully');
            if(trnsid ==''){
            setTimeout(function(){
               window.location.reload();
            }, 100);
            }
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
    mainurl = baseurl+'Recruitment/deletelettersinfobyid';
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

function filterlist(){
    var formData = $('#processcmpdetails').serialize();
    mainurl = baseurl+'Recruitment/letterlists';
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: formData,
     success: function (data) {
        // console.log(data);
        $('#listview').html(data);
        var table = $('.datatable').removeAttr('width').DataTable({
        dom: 'Bfrtip',
         buttons: [
              { 
                extend : 'excel',
                exportOptions : {
                  format: {
                    body: function( data, row, col, node ) {
                        // console.log(col)
                      if (col == 14) {
                        return table
                          .cell( {row: row, column: col} )
                          .nodes()
                          .to$()
                          .find(':selected')
                          .text()
                       } else {
                          return data;
                       }
                    }
                  }
                },
                
              }
            ],
        });
     }
    }); 
}

$( document ).ready(function() {
    filterlist();
});
</script>


