<?php 
define('LINE_API',"https://notify-api.line.me/api/notify");
 
$token = "ZzktNIcvqMhL0uNgGCqP0JUJKPs0FLE651165BsIuDW"; //ใส่Token ที่copy เอาไว้
$str = "มีงานซ่อมใหม่  
ห้อง : " .$_SESSION['username'].' 
รายละเอียด : '.$_POST['detail']; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
 
$res = notify_message($str,$token);
//print_r($res);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}
?>