<?php
session_start();
require("conn.php");
$note_id = $_GET["q"];
$sql_1 = "select * from note where id = '$note_id'";
$result = mysqli_query($conn,$sql_1);
$data = mysqli_fetch_assoc($result);
$book_id = $data['notebookID'];
mysqli_query($conn,"UPDATE notebook set isDelete = '0' where id = '$book_id'");
$sql_1 = "select * from note where id = '$note_id'";
$result = mysqli_query($conn,$sql_1);
$data = mysqli_fetch_assoc($result);
$mark_id = $data['markID'];
mysqli_query($conn,"UPDATE mark set isDelete = '0' where id = '$mark_id'");
$sql = "UPDATE note SET isDelete = '0' WHERE id = '$note_id'";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>