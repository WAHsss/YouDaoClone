<?php
session_start();
require("conn.php");
$note_id = $_GET["q"];
$sql_1 = "select * from note where id = '$note_id'";
$result = mysqli_query($conn,$sql_1);
$data = mysqli_fetch_assoc($result);
$mark_id = $data['markID'];
mysqli_query($conn,"UPDATE mark set isDelete = '1' where id = '$mark_id'");
$sql = "UPDATE note SET isDelete = '1' WHERE id = '$note_id'";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>