<?php
session_start();
require("conn.php");
$book_id = $_GET["q"];
$user_id = $_SESSION['id'];
$sql = "UPDATE notebook SET isDelete = '1' WHERE id = '$book_id'";
mysqli_query($conn,$sql);
$sql_1 = "UPDATE note SET isDelete = '1' WHERE notebookID = '$book_id' and userid = '$user_id' ";
mysqli_query($conn,$sql_1);
mysqli_close($conn);
?>