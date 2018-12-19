
<?php
session_start();
require("./conn.php");
$user_id = $_SESSION['id'];
$sql = "select \"username\" from \"noteuser\" where \"id\"  = '$user_id'";
$result = $conn->query($sql);//执行sql
$data = $result->fetch(PDO::FETCH_ASSOC);
echo $data["username"];
$conn=null;
?>