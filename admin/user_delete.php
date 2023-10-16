<?php 

//print_r($_GET);

    if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act']=='delete'){
        //ประกาศตัวแปรรับค่าจาก param method get
        $id = $_GET['id'];
        $stmt = $condb->prepare('DELETE FROM tbl_users WHERE id=:id');
        $stmt->bindParam(':id', $id , PDO::PARAM_INT);
        $stmt->execute();


        if($stmt->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "user.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }else{
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
    }//isset
?>