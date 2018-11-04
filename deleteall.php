<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
mysqli_query($conn,"DELETE FROM mark where userid = '$user_id' and isDelete='1'");
$sql = "DELETE FROM note WHERE userid = '$user_id' and isDelete ='1'";
mysqli_query($conn,$sql);
mysqli_query($conn,"DELETE FROM notebook where userid = '$user_id' and isDelete='1'");
mysqli_close($conn);
?>