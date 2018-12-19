<?php
session_start();
require("./conn.php");
$note_id = $_GET["q"];
$sql_1 = "select \"markID\" from \"note\" where \"id\" = '$note_id'";
$result = $conn->query($sql_1);//执行sql
$data = $result->fetchAll(PDO::FETCH_COLUMN, 0);
$mark_id = $data[0];
$sql = "DELETE FROM \"note\" WHERE \"id\" = '$note_id'";
$conn->exec($sql);
$conn->exec("delete from \"mark\" where \"id\" = '$mark_id'");
$conn->null;
?>