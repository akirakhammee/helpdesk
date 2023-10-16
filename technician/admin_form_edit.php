<?php 
    if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act']=='edit'){
      $id = $_GET['id'];
      $stmt = $condb->prepare("SELECT * FROM tbl_users WHERE id=:id");
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
                      window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
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
    <label class="col-sm-2 col-form-label">ระดับ</label>
    <div class="col-sm-3">
      <select name="role_user" required class="form-control">
        <option value="<?=$row['role_user'];?>">-<?=$row['role_user'];?>-</option>
        <option disabled>-เลือกระดับสมาชิก-</option>
        <option value="admin">admin</option>
        <option value="technician">technician</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-3">
      <input type="text" name="username" class="form-control" placeholder="username" value="<?=$row['username'];?>" disabled>
    </div>
  </div>
  
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-3">
      <input type="text" name="name" class="form-control" placeholder="ชื่อแอดมิน/ช่าง" required minlength="3" value="<?=$row['name'];?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <input type="hidden" name="id" value="<?=$row['id'];?>">
      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
      <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php

// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['role_user']) && isset($_POST['id']) && isset($_POST['name'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $role_user = $_POST['role_user'];
  $username =  $_POST['id']; 
  $name = $_POST['name'];

    //sql update
    $stmt = $condb->prepare("UPDATE tbl_users SET
      role_user=:role_user,
      name=:name
      WHERE id=:id     
      ");

    //bin param
    $stmt->bindParam(':role_user', $role_user, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
 

} //isset
?>