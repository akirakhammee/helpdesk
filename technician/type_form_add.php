<h3 class="card-title">ฟอร์มเพิ่มข้อมูล</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal">
  
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ชื่อประเภท</label>
    <div class="col-sm-5">
      <input type="text" name="type_name" class="form-control" placeholder="ชื่อประเภท" required>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-info">เพิ่มข้อมูล</button>
      <a href="type.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php


// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['type_name'])) {

  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $type_name =  $_POST['type_name'];

  //check duplicate
  $stmtDp = $condb->prepare("SELECT type_id FROM tbl_type WHERE type_name = :type_name");
  $stmtDp->bindParam(':type_name', $type_name, PDO::PARAM_STR);
  $stmtDp->execute();
  if ($stmtDp->rowCount() > 0) {
    echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "ชื่อประเภท ซ้ำ !! ",  
                            text: "เพิ่มข้อมูลใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "type.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
  } else {
    //sql insert
    $stmt = $condb->prepare("INSERT INTO tbl_type
     (
      type_name
      )
    VALUES 
    (
        :type_name
        )
      ");

    //bin param

    $stmt->bindParam(':type_name', $type_name, PDO::PARAM_STR);

    $result = $stmt->execute();

    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
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
  } //else dup

} //isset
?>