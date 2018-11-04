<?php
//创建数据库连接的文件。凡是需要数据库连接的文件，都要引用此文件

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','123456');
define('DB_NAME','team3note');    // 对数据库服务器、用户名、密码、数据库名称进行常量定义，避免错误。
$conn=@new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//选择指定数据库（DB_NAME)team3note
if ($conn->connect_errno){
    die("数据库连接错误：".$conn->mysqli_error);
}

?>