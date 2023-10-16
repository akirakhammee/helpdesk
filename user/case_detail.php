<?php 
    if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act']=='detail'){
    $id = $_GET['id'];
    $stmt = $condb->prepare("SELECT c.*, t.type_name , s.status_name , 
    u.name as technicianName
    
    
    FROM tbl_case as c
    INNER JOIN tbl_type as t ON c.ref_type_id=t.type_id
    INNER JOIN tbl_status as s ON c.ref_status_id=s.status_id
    LEFT JOIN tbl_users as u ON c.ref_technician_id=u.id
    WHERE c.case_id=:id
    AND c.ref_user_id=$user_id
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
    <?php foreach ($rsimg as $rsimg){?>
    <div class="col-sm-3 mb-3">
    <img src="../assets/img_case/<?=$rsimg['image_name'];?>" width="100%">

    </div>
        <?php } ?>
    </div>