<?php
session_start();
include 'header.php';
?>
<div class="container" style="margin-top: 100px;">
	<div class="row">
		<div class="col col-sm-4"></div>
		<div class="col-sm-4">
			<h3 style="color: #213ddb">Form Login</h3>
			<form  method="post">
				<div class="form-group">					
					<input text="email" name="username" class="form-control" required minlength="3" autocomplete="off" placeholder="เลขห้อง/Username">
				</div>
				<div class="form-group">					
					<input type="password" name="password" class="form-control" required minlength="2" autocomplete="off" placeholder="รหัสผ่าน/Password">
				</div>
				<button type="submit" name="btn" value="login" class="btn btn-primary" style="width: 100%">Login</button>
			</form>
		</div>
	</div>
</div>


<?php

// echo '<pre>';
// print_r($_POST);
// exit;

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!='' && $_POST['password']!='' && $_POST['btn'] == 'login') {
	//print_r($_POST);
	//ประกาศตัวแปรรับค่าจากฟอร์ม

    $username = $_POST['username'];
    $password = sha1($_POST['password']); //เก็บรหัสผ่านในรูปแบบ sha1 
 
    //check username  & password
      $stmtL = $condb->prepare("SELECT id,name,role_user,username FROM tbl_users
      	WHERE username = :username AND password = :password");
      $stmtL->bindParam(':username', $username , PDO::PARAM_STR);
      $stmtL->bindParam(':password', $password , PDO::PARAM_STR);
      $stmtL->execute();

    //   echo $stmtL->rowCount();
    //   exit;
 
      //กรอก username & password ถูกต้อง
      if($stmtL->rowCount() == 1){
        //fetch เพื่อเรียกคอลัมภ์ที่ต้องการไปสร้างตัวแปร session
        $rowL = $stmtL->fetch(PDO::FETCH_ASSOC);
        //สร้างตัวแปร session
        $_SESSION['id'] = $rowL['id'];
        $_SESSION['name'] = $rowL['name'];
        $_SESSION['role_user'] = $rowL['role_user'];
        $_SESSION['username'] = $rowL['username'];

        //เช็คว่ามีตัวแปร session อะไรบ้าง

       	// print_r($_SESSION);
       	// exit();


        //สร้างเงื่อนไขการตรวจสอบสิทธิ์ก่อนการใช้งาน
        if($_SESSION['role_user'] =='admin'){
            header('Location: admin/'); //login ถูกต้องและกระโดดไปหน้าตามที่ต้องการ
        }else if($_SESSION['role_user'] =='technician'){
              header('Location: technician/'); 
        }else if($_SESSION['role_user'] =='user'){
              header('Location: user/'); 
        }else{
            echo 'เกิดข้อผิดพลาด';
        }
        

          
      }else{ //ถ้า username or password ไม่ถูกต้อง
      	  $condb = null; //close connect db
         echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                             text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
                            type: "warning"
                        }, function() {
                            window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                  </script>';
            } //else
    } //isset 
?>

<?php include 'footer.php';?>