<?php
session_start();
require("./conn.php");
$note_id = $_GET["q"];
$sql_1 = "select  \"markID\" from \"note\" where \"id\" = '$note_id'";
$result = $conn->query($sql_1);//执行sql
$data = $result->fetchAll(PDO::FETCH_COLUMN, 0);
$mark_id = $data[0];
$conn->exec("UPDATE mark set isDelete = '1' where id = '$mark_id'");
$sql = "UPDATE \"note\" SET \"isDelete\" = '1' WHERE \"id\" = '$note_id'";
$conn->exec($sql);
$conn=null;
?>