<?php 

//print_r($_GET);

    if(isset($_GET['type_id']) && isset($_GET['act']) && $_GET['act']=='delete'){
        //ประกาศตัวแปรรับค่าจาก param method get
        $type_id = $_GET['type_id'];
        $stmt = $condb->prepare('DELETE FROM tbl_type WHERE type_id=:type_id');
        $stmt->bindParam(':type_id', $type_id , PDO::PARAM_INT);
        $stmt->execute();


        if($stmt->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "type.php"; //หน้าที่ต้องการให้กระโดดไป
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
                      window.location = "type.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
        }
    }//isset
?>