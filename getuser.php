
<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
$sql = "select * from user where id  = '$user_id'";
$result = mysqli_query($conn,$sql);//执行sql
$data = mysqli_fetch_assoc($result);
echo $data["username"];
mysqli_close($conn);
?>