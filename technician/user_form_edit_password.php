<?php 
    if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act']=='password'){
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
                      window.location = "user.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';         
          exit();
      }
    }//isset



?>

<h3 class="card-title">ฟอร์มเเก้ไขรหัสผ่าน</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">เลขห้อง</label>
    <div class="col-sm-3">
      <input type="text" name="username" class="form-control" placeholder="เลขห้อง" value="<?=$row['username'];?>" disabled>
    </div>
  </div>
  
  
  <div class="form-group row">
    <label class="col-sm-3 col-form-label">New Password</label>
    <div class="col-sm-3">
      <input type="password" name="password1" class="form-control" placeholder="New Password" required minlength="3">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-3 col-form-label">Confirm Password</label>
    <div class="col-sm-3">
      <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required minlength="3">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-3">
      <input type="hidden" name="id" value="<?=$row['id'];?>">
      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
      <a href="user.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php

// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['password1']) && isset($_POST['id']) && isset($_POST['password2'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $name = $_POST['id'];


  //ตรวจสอบรหัสผ่านว่าตรงกันมั้ย
  if($password1 != $password2){
    //echo 'รหัสผ่านไม่ตรงกัน'; 
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "รหัสผ่านไม่ตรงกัน",
                  text: "กรอกรหัสผ่านใหม่อีกครั้ง",
                  type: "error"
              }, function() {
                  window.location = "user.php?id=' .$id. '&act=password"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
        exit;
  }else{
    $password = sha1($_POST['password1']);
    //echo 'ส่งไปแก้ไขได้';
        //sql update
        $stmt = $condb->prepare("UPDATE tbl_users SET
          password='$password'
          WHERE id=:id     
          ");

        //bin param
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
                      window.location = "user.php"; //หน้าที่ต้องการให้กระโดดไป
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
                      window.location = "user.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }
    
  }//เช็ครหัสผ่าน

  

} //isset
?>