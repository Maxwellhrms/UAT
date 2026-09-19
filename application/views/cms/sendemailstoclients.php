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
								<h3 class="page-title">Send Emails</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Send Emails</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

                                <!-- Create Client Tab -->
                                <div id="senmails" class="tab-pane fade show active">
                      
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <span><span style="color:red">Note:</span> Please add Mutiple <span style="color:red"><b>To (or) Cc (or) Bcc</b></span> as Test@gmail.com<span style="color:red"><b>,</b></span>Test2@gmail.com (Dont forget use , when there are Mutiples. If single Don't use ,)</span>
                                    <form id="sendemailstoclients_user_form" action="<?php echo base_url() ?>Reports/viewpdf" method="post" target="_blank">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select type="text" name="templates" id="templates" class="form-control select2" onchange="getemailtemplatesbyid()">
                                                        <option value="">Select Template</option>
                                                        <?php foreach ($list as $key => $val) { ?>
                                                           <option value="<?php echo $val->id ?>"><?php echo $val->email_title ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Subject" name="subject" id="subject" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="To" name="to" id="to" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Cc" name="cc" id="cc" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Bcc" name="bcc" id="bcc" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mail Body</label>
                                            <textarea rows="4" class="form-control" name="mdesc" id="mdesc" placeholder="Enter your message here"></textarea>
                                        </div>
                                        <div class="form-group"  style="display: none;" id="desc_atta">
                                            <label>Attachements Body</label>
                                            <textarea rows="4" class="form-control" name="desc" id="desc" placeholder="Enter your message here"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="text-center">
                                            <!-- style="display: none" -->
                                                <button class="btn btn-primary" type="button" onclick="sendmailspdf()"><span>Send Email</span> <i class="fa fa-send m-l-5"></i></button>
                                                <button  id="em_pdf" class="btn btn-dark m-l-5"  style="display: none;" type="submit"><span>Preview Pdf</span> <i class="la la-file-pdf-o m-l-5"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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


<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>


<script>
// ckeditor
// var users = mentionsemails,
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


// ckeditor

CKEDITOR.replace('mdesc', {
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


function sendmailspdf(){
  
  for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
   }
    var title = $("#templates").val();
    if (title.trim() == "") {
        alert('Please Select Templates');
        return false;
    }

    var subject = $("#subject").val();
    if (subject.trim() == "") {
        alert('Please Enter Subject');
        return false;
    }

    var to = $("#to").val();
    if (to.trim() == "") {
        alert('Please Enter To');
        return false;
    }

    var desc = $("#desc").val();
    if (desc.trim() == "") {
        alert('Please Enter Description');
        return false;
    }

    var confirmSubmit = confirm('Are you sure you want to Send');
    if (!confirmSubmit) {
        return false;
    }

  var formData = $('#sendemailstoclients_user_form').serialize();
  mainurl = baseurl+'Reports/sendcustomemailswithpdf';
      $.ajax({
         url: mainurl,
         type: 'POST',
         data: formData,
         success: function (data) {
          var result = $.parseJSON(data);
           if(result.respone == 200){
              alert('Successfully');
              setTimeout(function(){
                 window.location.reload();
              }, 100); 
           } else {
              alert('Failed To Send Please TryAgain Later');
           }
         },
      });  
}

function getemailtemplatesbyid(){
  $("#desc_atta").show();
  $("#em_pdf").show();
  var client ='';
  var project ='';
  var type='';
  var ticket ='';
  var id = $('#templates').val();
    mainurl = baseurl+'reports/getemailtemplatesbyid';
    $.ajax({
     url: mainurl,
     type: 'POST',
     data: {'id':id},
     complete: function (data) {
        //  console.log(data.responseText);
      if(data.responseText.length > 10){
          var json = $.parseJSON(data.responseText);
          $("#subject").val(json[0].email_subject);
          $("#to").val(json[0].email_to);
          $("#cc").val(json[0].email_cc);
          $("#bcc").val(json[0].email_bc);
          CKEDITOR.instances['desc'].setData(json[0].email_body);
      }else{
          $("#subject").val('');
          $("#to").val('');
          $("#cc").val('');
          $("#bcc").val('');
          $("#desc").val('');
          CKEDITOR.instances['desc'].setData('');
        }
      }
    }); 
}

</script>

