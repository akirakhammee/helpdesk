<h3 class="card-title">จัดการข้อมูลสถานะข้อมูลการเเจ้งซ่อม</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ชื่อสถานะการเเจ้งซ่อม</label>
    <div class="col-sm-5">
      <input status="text" name="status_name" class="form-control" placeholder="ชื่อสถานะการเเจ้งซ่อม" required>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button status="submit" class="btn btn-info">เพิ่มข้อมูล</button>
      <a href="status.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php


// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['status_name'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $status_name =  $_POST['status_name'];

  //check duplicate
  $stmtDp = $condb->prepare("SELECT status_id FROM tbl_status WHERE status_name = :status_name");
  $stmtDp->bindParam(':status_name', $status_name, PDO::PARAM_STR);
  $stmtDp->execute();
  if ($stmtDp->rowCount() > 0) {
    echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "ชื่อสถานะ ซ้ำ !! ",  
                            text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                            status: "warning"
                        }, function() {
                            window.location = "status.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
  } else {
    //sql insert
    $stmt = $condb->prepare("INSERT INTO tbl_status
     (
      status_name
      )
    VALUES 
    (
        :status_name
        )
      ");

    //bin param

    $stmt->bindParam(':status_name', $status_name, PDO::PARAM_STR);

    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
                  status: "success"
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
                  status: "error"
              }, function() {
                  window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
  } //else dup

} //isset
?>