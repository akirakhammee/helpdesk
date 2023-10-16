<h3 class="card-title">ฟอร์มเพิ่มข้อมูล</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ระดับ</label>
    <div class="col-sm-3">
      <select name="role_user" required class="form-control">
        <option value="">-เลือกระดับสมาชิก-</option>
        <option value="admin">admin</option>
        <option value="technician">technician</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-3">
      <input type="text" name="username" class="form-control" placeholder="username" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required minlength="3">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-3">
      <input type="text" name="name" class="form-control" placeholder="ชื่อแอดมิน/ช่าง" required minlength="3">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-info">เพิ่มข้อมูล</button>
      <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php


// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['role_user']) && isset($_POST['username']) && isset($_POST['name'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $role_user = $_POST['role_user'];
  $username =  $_POST['username'];
  $password =  sha1($_POST['password']);
  $name = $_POST['name'];

  //check duplicate
  $stmtDp = $condb->prepare("SELECT id FROM tbl_users WHERE username = :username");
  $stmtDp->bindParam(':username', $username, PDO::PARAM_STR);
  $stmtDp->execute();
  if ($stmtDp->rowCount() > 0) {
    echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "Username ซ้ำ !! ",  
                            text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "admin.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
  } else {
    //sql insert
    $stmt = $condb->prepare("INSERT INTO tbl_users
     (
      role_user,
      username,
      password, 
      name
      )
    VALUES 
    (
      :role_user, 
      :username,
      '$password',
      :name
      )
      ");

    //bin param
    $stmt->bindParam(':role_user', $role_user, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
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
  } //else dup

} //isset
?>