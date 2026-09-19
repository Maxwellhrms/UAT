<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Employee Card</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Employee Card</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

<!-- card -->

<style>
.emp-cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}

.card-container {
  width: 350px;
  background-color: #fff;
  margin: 10px;
  border-radius: 16px;
}

.cover-photo {
  height: 120px;
  border-radius: 10px;
  background: linear-gradient(to right , #367dbf, #fc6b6b);
  
}

.cover-photo img {
  width: 250px;
  width: 100%;
  border-radius: 10px;
}

.profile-img img {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  margin-top: -60px;
  text-align: center;
  border: 1px solid;
}

.emp-info {
  text-align: left;
}

.details {
  position: relative;
  overflow-wrap: break-word;
}

.emp-info-btn {
  text-align: center;
  margin: 15px 0px;
}

.emp-info-btn button {
  background-color: #3c3c3b;
  padding: 8px 40px;
  font-size: 14px;
  border: 1px solid black;
  border-radius: 5px;
  cursor: pointer;
  margin: 15px 0px;
  color: #fff;
}

</style>

    <?php 

    ?>
    

<div class="emp-cards col-md-12">
    <div class="card-container">
      <div class="cover-photo">
        <center style="color:#fff;"><h3><?php echo $emp['employeeinfo'][0]->mxcp_name ?></h3></center>
      </div>
      <div class="profile-img" style="width: 140px;">
        <img src="<?php echo base_url() . $emp['employeeinfo'][0]->mxemp_emp_img ?>" alt="emp-image" class="logo">
      </div>
      <div class="emp-info col-md-12">
          <div class="col-md-12">
          <p><b>Employee Code: </b><?php echo $emp['employeeinfo'][0]->mxemp_emp_id ?></p> 
          <p><b>Name: </b><?php echo $emp['employeeinfo'][0]->mxemp_emp_fname .' '. $emp['employeeinfo'][0]->mxemp_emp_lname; ?></p>
          <p><b>Phone: </b><?php echo $emp['employeeinfo'][0]->mxemp_emp_phone_no ?></p>
          <p><b>Email: </b><?php echo $emp['employeeinfo'][0]->mxemp_emp_email_id ?></p>
          <p><b>Designation: </b><?php echo $emp['employeeinfo'][0]->mxdesg_name ?></p>
          <p><b>Departement: </b><?php echo $emp['employeeinfo'][0]->mxdpt_name ?></p>
          </div>
          <hr>
          <div class="offset-3 col-md-6">

            <img src="<?php echo base_url() .'uploads/qrfiles/'. $emp['employeeinfo'][0]->mxemp_emp_id.'.png' ?>" alt="emp-image" class="logo" style="border-radius: 0px;  width: 120px;height: 120px;">

          </div>
      </div>
    </div>
  </div>
<!-- card -->
		

	</div>			
</div>
<!-- /Main Wrapper -->