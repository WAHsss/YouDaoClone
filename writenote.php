<?php
session_start();
require("conn.php");
$note =$_POST['note'];
$mark = $_POST['mark'];
$note_id = $_SESSION['note_id'];
if($mark != null) {
    $sql_1 = "select * from note where id = '$note_id' and isDelete = '0'";   //查找标签ID
    $result = mysqli_query($conn, $sql_1);//执行sql
    $data = mysqli_fetch_assoc($result);
    $mark_id = $data["markID"];
    $sql_2 = "UPDATE mark SET markName = '$mark' WHERE id = '$mark_id'";
    mysqli_query($conn, $sql_2);
}
$sql = "UPDATE note SET content = '$note' WHERE id = '$note_id'";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>