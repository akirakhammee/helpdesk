<?php 
//ข้อมูลอุปกรณ์ที่เเจ้งซ่อม
$stmttype = $condb->prepare("SELECT * FROM tbl_type");
$stmttype->execute();
$rstype= $stmttype->fetchAll();
?>






<h3 class="card-title">ฟอร์มเพิ่มข้อมูล</h3>
<br>
<hr>
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">อุปกรณ์</label>
    <div class="col-sm-3">
      <select name="ref_type_id" required class="form-control">
        <option value="">-เลือกอุปกรณ์-</option>
        <?php foreach ($rstype as $rstype){?>
        <option value="<?=$rstype['type_id'];?>"><?=$rstype['type_name'];?></option>
        <?php } ?>

       


      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">รายละเอียด</label>
    <div class="col-sm-5">
      <textarea name="detail" class="form-control" required placeholder="รายละเอียดอุปกรณ์ที่จะเเจ้งซ่อม"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ภาพประกอบ</label>
    <div class="col-sm-3">
      <input type="file" name="image_name[]" class="form-control" accept="image/*" multiple required>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-info">เพิ่มข้อมูล</button>
      <a href="index.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php


// echo '<pre>';
// print_r($_POST);
// exit;

//ถ้ามีค่าส่งมาจากฟอร์ม
if (isset($_POST['ref_type_id']) && isset($_POST['detail'])) {



  //ประกาศตัวแปรรับค่าจากฟอร์ม
  $ref_type_id = $_POST['ref_type_id'];
  $detail =  $_POST['detail'];
  $ref_room = $_SESSION['username']; //เลขห้อง

    //sql insert
    $stmt = $condb->prepare("INSERT INTO tbl_case
     (
      ref_user_id,
      ref_type_id,
      ref_status_id, 
      detail,
      ref_room
      )
    VALUES 
    (
      $user_id, 
      :ref_type_id,
      1,
      :detail,
      $ref_room
      )
      ");

    //bin param
    $stmt->bindParam(':ref_type_id', $ref_type_id, PDO::PARAM_INT);
    $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
    $result = $stmt->execute();

    //Get Latest Primary Key Inserted
    $lastID = $condb->lastInsertId();
 
    // //echo id ล่าสุดออกมาดูหน่อย ได้ตัวเลขออกมาไหม 
    //  echo $lastID;

    // exit();
    function reArrayFiles($file)
    {
        $file_ary = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);
        
        for($i=0;$i<$file_count;$i++)
        {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
    }

    $img = $_FILES['image_name'];

    if(!empty($img))
    {
    $img_desc = reArrayFiles($img);
    //print file detail
   // print_r($img_desc);
    
    foreach($img_desc as $val)
    {
    $newname = date('YmdHis',time()).mt_rand().'.jpg';
    move_uploaded_file($val['tmp_name'],'../assets/img_case/'.$newname);

        //sql
      $stmt2 = $condb->prepare("INSERT INTO tbl_img 
          (ref_case_id, image_name)
          VALUES 
          ('$lastID', '$newname')
          ");
          $result2 = $stmt2->execute();
    } //foreach
  }//if issets

 include 'line.php';
    $condb = null; //close connect db
    if ($result) {
      echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกการเเจ้งซ่อมสำเร็จ",
                  text:"กรุณาติดตามสถานะในระบบ",
                  type: "success"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
 

} //isset
?>