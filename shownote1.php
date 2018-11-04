<?php
session_start();
require("conn.php");
$note_id = $_GET["q"];
$_SESSION['note_id'] = $note_id;
$sql = "select * from note where id ='$note_id'";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($result);
echo $data["content"];
mysqli_close($conn);
?>