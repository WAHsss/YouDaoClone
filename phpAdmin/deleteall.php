<?php
session_start();
require("./conn.php");
$user_id = $_SESSION['id'];
$conn->exec("DELETE FROM \"mark\" where \"userid\" = '$user_id' and \"isDelete\"='1'");
$sql = "DELETE FROM \"note\" WHERE \"userid\" = '$user_id' and \"isDelete\" ='1'";
$conn->exec($sql);
$conn->exec("DELETE FROM \"notebook\" where \"userid\" = '$user_id' and \"isDelete\"='1'");
$conn=null;
?>