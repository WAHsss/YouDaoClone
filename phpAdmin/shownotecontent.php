<?php
session_start();
require("./conn.php");
$note_id = $_GET["q"];
$_SESSION['note_id'] = $note_id;
$sql = "select \"content\" from \"note\" where \"id\" ='$note_id'";
$result = $conn->query($sql);//执行sql
$data = $result->fetchAll(PDO::FETCH_COLUMN, 0);
if(is_resource($data[0]) && $row =stream_get_contents($data[0])){
    $note = iconv("GBK", "UTF-8", $row);
    echo $note;
}
$conn=null;
?>