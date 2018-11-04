<?php
session_start();
require("conn.php");
$note_id = $_GET["q"];
$sql_1 = "select * from note where id = '$note_id'";
$result = mysqli_query($conn,$sql_1);
$data = mysqli_fetch_assoc($result);
$mark_id = $data['markID'];
$sql = "DELETE FROM note WHERE id = '$note_id'";
mysqli_query($conn,$sql);
mysqli_query($conn,"delete from mark where id = '$mark_id'");
mysqli_close($conn);
?>