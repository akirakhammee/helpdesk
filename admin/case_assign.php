<?php 
    if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act']=='assign'){
    $id = $_GET['id'];
    $stmt = $condb->prepare("SELECT c.*, t.type_name , s.status_name , 
    u.name as technicianName
    
    
    FROM tbl_case as c
    INNER JOIN tbl_type as t ON c.ref_type_id=t.type_id
    INNER JOIN tbl_status as s ON c.ref_status_id=s.status_id
    LEFT JOIN tbl_users as u ON c.ref_technician_id=u.id
    WHERE c.case_id=:id
    GROUP BY c.case_id
    
    ");

    $stmt->bindParam(':id', $id , PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>' ;
    // print_r($row);
    // exit;


    // echo $stmt->rowCount();
    // exit;



    //ถ้าคิวรี่ผิดพลาดให้ปิดการทำงาน
    if($stmt->rowCount() !=1){
      echo '<script>
               setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "คุณกรอกข้อมูลไม่ถูกต้อง",
                    type: "warning"
                }, function() {
                    window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                });
              }, 1000);
          </script>';         
        exit();
    }
  }//isset


  //คิวรี่ภาพประกอบ

  $stmtimg = $condb->prepare("SELECT * FROM tbl_img WHERE ref_case_id=:id");
  $stmtimg->bindParam(':id', $id , PDO::PARAM_INT);
  $stmtimg->execute();
  $rsimg= $stmtimg->fetchAll();
  ?>

<h3>รายละเอียดการเเจ้งซ่อม</h3>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="5%">No.</th>
			<th width="17%">อุปกรณ์</th>
			<th width="33%">รายละเอียด</th>
			<th width="15%">สถานะ</th>
			<th width="20%">การซ่อม</th>			

		</tr>
	</thead>
	<tbody>
		<tr>

			<td><?=$row['case_id'];?></td>
			<td><?=$row['type_name']?></td>
			<td>
				<?=$row['detail']?> <br>
				วดป.ที่เเจ้ง <?=date('d/m/Y H:i:s' , strtotime($row['dateCreate']))?> น.
			</td>
			<td><?=$row['status_name']?></td>
			<td>
				ช่าง.<?=$row['technicianName']?>
				<br>
				วันที่เสร็จ.<?
                if ($row['caseCloseDate'] !=''){
                echo date('d/m/Y H:i:s' , strtotime($row['caseCloseDate']));
                }
                ?> 	
                
		</tr>
	</tbody>
</table>	
</div>
<hr>
<h4>ภาพประกอบ</h4>
<div class="row">
	<div class="col-sm-8">
		<div class="row">	
		<?php foreach ($rsimg as $rsimg){?>
				<div class="col-sm-3 mb-3">
				<img src="../assets/img_case/<?=$rsimg['image_name'];?>" width="100%">
				</div>
  		<?php  } ?> 
	</div> <!-- ./row -->
</div> <!-- ./col 8 -->
	<div class="col-sm-4">
		<h4>เลือกช่าง</h4> 
        <?php 
        //คิวรี่ข้อมูลช่างเพื่อ assign งาน
$stmttechnician = $condb->prepare("SELECT * FROM tbl_users WHERE role_user='technician' ");
$stmttechnician ->execute();
$rstechnician = $stmttechnician ->fetchAll();
   
?>
<style>
    input[type=radio] {
    border: 0px;
    width: 100%;
    height: 1.5em;
    
}
</style>
        <form action="" method="post">



        <div class="table-responsive">
<table class="table table-bordered table-hover table-sm">
	<thead>
		<tr class="table table-info">
			<th width="10%">เลือก</th>
			<th width="50%">ชื่อช่าง</th>
			<th width="20%">กำลังทำ</th>
			<th width="20%">ปิดงาน</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rstechnician AS $rstechnician){ ?>
		<tr>
			<td><input type="radio" name="ref_technician_id" value="<?=$rstechnician['id'];?>"></td>				
			<td><?=$rstechnician['name']?></td>
			<td>xx</td>
			<td>xx</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
<input type="hidden" name="case_id" value="<?=$_GET['id'];?>">
<button type="submit" class="btn btn-primary">บันทึกการส่งงาน</button>	
</div>
	</div>
</div> <!-- ./row -->
</form>

<?php 
// echo '<pre>';
// print_r($_POST);
// exit();

if(isset($_POST['ref_technician_id']) && isset($_POST['case_id'])){


    //ประกาศตัวเเปรรับค่าจากฟอร์ม
    $ref_technician_id = $_POST['ref_technician_id'];
    $case_id = $_POST['case_id'];

    //sql update
    $stmt = $condb->prepare("UPDATE tbl_case SET
      ref_technician_id=:ref_technician_id,
      ref_status_id=2
      WHERE case_id=:case_id     
      ");

    //bin param
    $stmt->bindParam(':ref_technician_id', $ref_technician_id, PDO::PARAM_INT);
    $stmt->bindParam(':case_id', $case_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "มอบหมายงานสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    } else {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
} //isset

    ?>