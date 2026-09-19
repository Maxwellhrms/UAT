<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
     <!-- Page Header -->
     <div class="page-header">
      <div class="row">
       <div class="col-sm-12">
        <h3 class="page-title"> <?php echo $title ;?>  </h3>
        <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Employee/employeedashboard">Dashboard</a></li>
         <li class="breadcrumb-item active"> <?php echo $title ;?>  </li>
     </ul>
 </div>
</div>
</div>
    <style>
        .holiday-card {
            border-radius: 14px;
            padding: 25px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
            height: 100%;
            transition: 0.2s;
        }

        .holiday-card:hover {
            transform: translateY(-3px);
        }

        .holiday-title {
            font-size: 16px;
            font-weight: 600;
            color: #444;
            margin-bottom: 10px;
        }

        .holiday-date {
            font-size: 52px;
            font-weight: 700;
            line-height: 1;
            color: #222;
        }

        .holiday-month {
            font-size: 18px;
            color: #444;
            margin-top: 8px;
        }

        .holiday-type {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .type-public {
            background: #e6f7ee;
            color: #1e7e34;
        }

        .type-optional {
            background: #fff3cd;
            color: #856404;
        }

    </style>
<div class="container mt-4">
    <div class="row">
        <!-- CARD -->
        <?php foreach ($holidayslist as $key => $val) { ?>
            <div class="col-md-4 mb-4">
                <div class="holiday-card">

                    <div class="holiday-title"><?php echo $val['holidayname']; ?></div>

                    <!-- DATE + TYPE -->
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="holiday-date"><?php echo date('d', strtotime($val['holidaydate'])); ?></div>

                        <div class="holiday-type type-public">
                            <?php echo $val['holiday_type']; ?>
                        </div>
                    </div>

                    <div class="holiday-month"><?php echo date('M Y', strtotime($val['holidaydate'])); ?></div>
                    <!-- <div class="holiday-name">Independence Day</div> -->

                </div>
            </div>
        <?php } ?>
    </div>
</div>