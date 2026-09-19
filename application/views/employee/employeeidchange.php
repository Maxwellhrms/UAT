                    <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"> <?php echo $titlehead; ?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active"> Employee ID Change </li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

                    <form id="empidchange">
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-3">  
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="prevempid" id="prevempid" autocomplete="off">
                                    <label class="focus-label">Employee Code</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3" id="changeid" style='display:none;'>  
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="currentempid" id="currentempid" autocomplete="off">
                                    <label class="focus-label"> Current Employee Code</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">  
                                <button id="searchemployeefilterdata"  class="btn btn-success btn-block"   > Search </button>  
                            </div>     
                        </div>
                    </form>
                    <div id="changeemplist"> </div>
                </div>
            </div>

<script>
    
    $("form#empidchange").submit(function(e) {    
        e.preventDefault(); 
        var logempid = "<?php echo $this->session->userdata('user_id') ?>";
        if(logempid != '888666'){
            alert('You dont have access to this screen');
            return false;
        }
        var prevempid = $("#prevempid").val();    
        var currentempid = $("#currentempid").val();
        var mainurl = baseurl+'admin/employeeidlist';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'prevempid': prevempid,'currentempid': currentempid },
            success: function (data) {
                // console.log(data);
                // alert(data);
                $("#changeemplist").html(data);  
                var table = $('#dataTables-example1').DataTable({
                    dom: 'Bfrtip',
                    "destroy": true, //use for reinitialize datatable
                    lengthChange: false,
                    buttons: [
                        { extend: 'excelHtml5', footer: true }
                    ],
            });
            }
        });          
    });

    
    function updateemployeeid(){
        var logempid = "<?php echo $this->session->userdata('user_id') ?>";
        if(logempid != '888666'){
            alert('You dont have access to this screen');
            return false;
        }
        var prevempid = $("#prevempid").val();
        var pempid = prevempid.trim();
        if(pempid == ''){
            alert('Please enter Old Employeeid');
            return false;
        }
        var currentempid = $("#currentempid").val();
        var cntmpid = currentempid.trim();
        if(cntmpid == ''){
            alert('Please enter New Employeeid');
            return false;
        }    
        if(cntmpid == pempid ){
            alert('Old and New Employeeid should not be same');
            return false;
        }
        var ck = confirm("Do You Want To change the old employeeid "+ pempid + " to new employeeid "  + cntmpid);
        if(ck == true){
            var mainurl = baseurl+'admin/editemployeeid';
            $.ajax({
                url: mainurl,
                type: "post",
                async: false,
                data: {'currntempid': currentempid ,'prevempid':prevempid},
                success: function (data) {
                    // console.log(data);
                    if(data ==200){
                    alert("Sucessfully updated");
                    }else{
                        alert("Failed to update");
                    }
                }
            });
        }
    }

    
function deleteemployeeid(){
    var prevempid = $("#prevempid").val();
    var pempid = prevempid.trim();
    if(pempid == ''){
        alert('Please enter Old Employeeid');
        return false;
    }
    var ck = confirm("Do You Want To delete the  employeeid "+ pempid );
    if(ck == true){
        var mainurl = baseurl+'admin/deleteemployeeid';
        $.ajax({
            url: mainurl,
            type: "post",
            async: false,
            data: {'prevempid':prevempid},
            success: function (data) {
                // console.log(data);
                if(data ==200){
                alert("Sucessfully updated");
                }else{
                    alert("Failed to update");
                }
            }
        });
    }
}

</script>