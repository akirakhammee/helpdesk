<?php 
    if(isset($_GET['status_id']) && isset($_GET['act']) && $_GET['act']=='edit'){
      $status_id = $_GET['status_id'];
      $stmt = $condb->prepare("SELECT * FROM tbl_status WHERE status_id=:status_id");
      $stmt->bindParam(':status_id', $status_id , PDO::PARAM_INT);
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
                      window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';         
          exit();
      }
    }//isset



?>

<h3 class="card-title">ฟอร์มเเก้ไขข้อมูล</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ชื่อประเภท</label>
    <div class="col-sm-5">
      <input type="text" name="status_name" class="form-control" placeholder="ชื่อประเภท" value="<?=$row['status_name'];?>"  required>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <input type="hidden" name="status_id" value="<?=$row['status_id'];?>">
      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
      <a href="status.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php

// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['status_name']) && isset($_POST['status_id'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $status_name = $_POST['status_name'];
  $status_id =  $_POST['status_id']; 

    //sql update
    $stmt = $condb->prepare("UPDATE tbl_status SET
      status_name=:status_name
      WHERE status_id=:status_id     
      ");

    //bin param
    $stmt->bindParam(':status_name', $status_name, PDO::PARAM_STR);
    $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
 

} //isset
?>