<?php
session_start();
require("./conn.php");
$note_id = $_GET["q"];
$sql_1 = "select * from \"note\" where \"id\" = '$note_id'";
$result1 = $conn->query($sql_1);//执行sql
$data1 = $result1->fetch(PDO::FETCH_ASSOC);
$book_id = $data1['notebookID'];

$sql_2="UPDATE \"notebook\" set \"isDelete\" = '0' where \"id\" = '$book_id'";
$conn->exec($sql_2);

$sql_3 = "select \"markID\" from \"note\" where \"id\" = '$note_id'";
$result2 = $conn->query($sql_3);//执行sql
$data2 = $result2->fetchAll(PDO::FETCH_COLUMN, 0);
$mark_id = $data2[0];

$sql_4="UPDATE \"mark\" set \"isDelete\" = '0' where \"id\" = '$mark_id'";
$conn->exec($sql_4);
$sql_5 = "UPDATE \"note\" SET \"isDelete\" = '0' WHERE \"id\" = '$note_id'";
$conn->exec($sql_5);
$conn=null;
?>