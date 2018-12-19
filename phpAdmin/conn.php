<?php
header('Content-Type: text/html; charset=utf-8');
$param = $_POST;
$db_username = 'oranote';
$db_password = "123456";
$db = "oci:dbname=orcl";

try{
    $conn = new PDO($db,$db_username,$db_password);
}catch(PDOException $e){
    echo ($e->getMessage());
    echo "数据库链接失误！";
}


?>