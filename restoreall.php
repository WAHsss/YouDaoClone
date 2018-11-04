<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
mysqli_query($conn,"UPDATE notebook set isDelete = '0' where userid = '$user_id'");
mysqli_query($conn,"UPDATE mark set isDelete = '0' where userid = '$user_id'");
$sql = "UPDATE note SET isDelete = '0' WHERE userid = '$user_id'";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>