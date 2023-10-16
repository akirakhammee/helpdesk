<?php
include 'header.php';
include 'nav.php';
include 'sidebar_menu.php';  

//จำนวนรายการใหม่
      $Status1 = $condb->prepare("SELECT COUNT(case_id) as totalStatus1
      FROM tbl_case WHERE ref_status_id=1;");
      $Status1->execute();
      $rowStatus1 = $Status1->fetch(PDO::FETCH_ASSOC);

//จำนวนรอดำเนินการ
$Status2 = $condb->prepare("SELECT COUNT(case_id) as totalStatus2
FROM tbl_case WHERE ref_status_id=2;");
$Status2->execute();
$rowStatus2 = $Status2->fetch(PDO::FETCH_ASSOC);

//จำนวนดำเนินการเสร็จสิ้น
$Status3 = $condb->prepare("SELECT COUNT(case_id) as totalStatus3
FROM tbl_case WHERE ref_status_id=3;");
$Status3->execute();
$rowStatus3 = $Status3->fetch(PDO::FETCH_ASSOC);

//จำนวนที่ยกเลิก
$Status4 = $condb->prepare("SELECT COUNT(case_id) as totalStatus4
FROM tbl_case WHERE ref_status_id=4;");
$Status4->execute();
$rowStatus4 = $Status4->fetch(PDO::FETCH_ASSOC);





?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>รายการเเจ้งซ่อม
  <a href="index.php?act=new" class="btn btn-primary">รอดำเนินการ (<?=$rowStatus1['totalStatus1'];?>)</a>
  <a href="index.php?act=repairing" class="btn btn-warning">กำลังดำเนินการซ่อม (<?=$rowStatus2['totalStatus2'];?>) </a>
  <a href="index.php?act=complete" class="btn btn-success">ดำเนินการเสร็จสิ้น (<?=$rowStatus3['totalStatus3'];?>) </a>
  <a href="index.php?act=cancle" class="btn btn-danger">ยกเลิก (<?=$rowStatus4['totalStatus4'];?>) </a>

          </h1>
        </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                <div class="col-sm-12">
                <?php 
                $act = (isset($_GET['act']) ? $_GET['act'] : '');
                if ($act=='detail'){
                  include 'case_detail.php'; 
                }else if($act=='new'){
                  include 'case_list1.php';   
                }else if($act=='repairing'){
                  include 'case_list2.php'; 
                }else if($act=='complete'){
                  include 'case_list3.php';
                }else if($act=='cancle'){
                  include 'case_list4.php';
                }else if($act=='assign'){
                  include 'case_assign.php';     
                }else if($act=='complete'){
                  include 'case_complete.php';         
                }else{
                  include 'case_list1.php';
                }            
                ?>
                 </div>
                 </div> <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php';?>