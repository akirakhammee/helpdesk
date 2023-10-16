<?php 
    if(isset($_GET['type_id']) && isset($_GET['act']) && $_GET['act']=='edit'){
      $type_id = $_GET['type_id'];
      $stmt = $condb->prepare("SELECT * FROM tbl_type WHERE type_id=:type_id");
      $stmt->bindParam(':type_id', $type_id , PDO::PARAM_INT);
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
                      window.location = "type.php"; //หน้าที่ต้องการให้กระโดดไป
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
      <input type="text" name="type_name" class="form-control" placeholder="ชื่อประเภท" value="<?=$row['type_name'];?>" required>
    </div>
  </div>
  

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <input type="hidden" name="type_id" value="<?=$row['type_id'];?>">
      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
      <a href="type.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php

// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['type_name']) && isset($_POST['type_id'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $type_name = $_POST['type_name'];
  $type_id = $_POST['type_id'];

    //sql update
    $stmt = $condb->prepare("UPDATE tbl_type SET
      type_name=:type_name
      WHERE type_id=:type_id     
      ");

    //bin param
    $stmt->bindParam(':type_name', $type_name, PDO::PARAM_STR);
    $stmt->bindParam(':type_id', $type_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "type.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "type.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
 

} //isset
?>