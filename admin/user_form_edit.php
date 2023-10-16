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
    <label class="col-sm-2 col-form-label">เลขห้อง</label>
    <div class="col-sm-3">
      <input type="text" name="username" class="form-control" placeholder="เลขห้อง" value="<?=$row['username'];?>" required>
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
if (isset($_POST['username']) && isset($_POST['id'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $username = $_POST['username'];
  $id = $_POST['id'];

    //sql update
    $stmt = $condb->prepare("UPDATE tbl_users SET
      username=:username
      WHERE id=:id     
      ");

    //bin param
    $stmt->bindParam(':username', $username, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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