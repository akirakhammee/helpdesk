<h3 class="card-title">ฟอร์มเพิ่มข้อมูล</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">เลขห้อง</label>
    <div class="col-sm-3">
      <input type="text" name="username" class="form-control" placeholder="เลขห้อง" required>
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
if (isset($_POST['username'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $username =  $_POST['username'];
  $password =  sha1($_POST['username']);

  //check duplicate
  $stmtDp = $condb->prepare("SELECT id FROM tbl_users WHERE username = :username");
  $stmtDp->bindParam(':username', $username, PDO::PARAM_STR);
  $stmtDp->execute();
  if ($stmtDp->rowCount() > 0) {
    echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เลขห้อง ซ้ำ !! ",  
                            text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "admin.php?act=add&role_user=user"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
  } else {
    //sql insert
    $stmt = $condb->prepare("INSERT INTO tbl_users
     (
      username,
      password,
      role_user
      )
    VALUES 
    (
        :username,
        '$password',
        'user'
        )
      ");

    //bin param

    $stmt->bindParam(':username', $username, PDO::PARAM_INT);

    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location ="admin.php"; //หน้าที่ต้องการให้กระโดดไป
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