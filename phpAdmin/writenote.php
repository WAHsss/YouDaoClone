<?php
session_start();
require("./conn.php");
$note =$_POST['note'];
$mark = $_POST['mark'];
$note_id = $_SESSION['note_id'];
if($mark != null) {
    $sql_1 = "select * from \"note\" where \"id\" = '$note_id' and \"isDelete\" = '0'";   //查找标签ID
    $result = $conn->query($sql_1);//执行sql
    $data = $result->fetch(PDO::FETCH_ASSOC);
    $mark_id = $data["markID"];
    $sql_2 = "UPDATE \"mark\" SET \"markName\" = '$mark' WHERE \"id\" = '$mark_id'";
    $insertCount = $conn->exec($sql_2);
}
$sql = "UPDATE \"note\" SET \"content\" = :note WHERE \"id\" = '$note_id'";
$sth = $conn->prepare($sql);
$note1 = iconv("UTF-8", "GBK", $note);
$sth->bindParam(':note', $note1, PDO::PARAM_STR, 3500);
$sth->execute();
$conn=null;
?>