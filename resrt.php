<?php
session_start();
require("conn.php");
$id = stripslashes(trim($_GET['id']));
$_SESSION['set_id'] = $id;
$toke = stripslashes(trim($_GET['toke']));
$sql="select * from user where id = '$id'";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($result);
$toke1 = md5($data['username'].$data['password']);
if($toke == $toke1){
    echo " <script>window.location.href='resrt.html'</script>";
}else{
    echo "链接错误请重新发送";
}
mysqli_close($conn);
?>