<?php
session_start();
require("conn.php");
$book_name = $_GET["q"];
$user_id = $_SESSION['id'];
$sql_1 = "select * from notebook where bookName  = '$book_name'and userid = '$user_id' and isDelete = '0'";
$result = mysqli_query($conn,$sql_1);//执行sql
$rowcount = mysqli_num_rows($result);//返回一个数值
if ($rowcount) {//0 false 1 true
    echo "used";
    exit;
}else {   
    $sql = "INSERT INTO notebook(userid,bookName,isStart)VALUES ('$user_id','$book_name','12')";
    $result2=mysqli_query($conn, $sql);	
	$data = mysqli_fetch_assoc($result2);//查找这一行数据
    if ($result2) {
        $_SESSION['book_id'] = $data["id"];    //储存book  ID
        //echo "succeed";		
    }
}

mysqli_close($conn);
?>