<?php
session_start();
require("./conn.php");
$user_id = $_SESSION['id'];
$sql_1="UPDATE \"notebook\" set \"isDelete\" = '0' where \"userid\" = '$user_id'";
$conn->exec($sql_1);
$sql_2="UPDATE \"mark\" set \"isDelete\" = '0' where \"userid\" = '$user_id'";
$conn->exec($sql_2);
$sql_3 = "UPDATE \"note\" SET \"isDelete\" = '0' WHERE \"userid\" = '$user_id'";
$conn->exec($sql_3);
$conn=null;
?>