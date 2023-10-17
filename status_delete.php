<?php 

//print_r($_GET);

    if(isset($_GET['status_id']) && isset($_GET['act']) && $_GET['act']=='delete'){
        //ประกาศตัวแปรรับค่าจาก param method get
        $status_id = $_GET['status_id'];
        $stmt = $condb->prepare('DELETE FROM tbl_status WHERE status_id=:status_id');
        $stmt->bindParam(':status_id', $status_id , PDO::PARAM_INT);
        $stmt->execute();


        if($stmt->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
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
                      window.location = "status.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }
    }//isset
?>