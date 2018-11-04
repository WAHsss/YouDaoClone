<?php
session_start();
require("conn.php");
$note_name =$_GET['q'];
$user_id = $_SESSION['id'];
$book_id = $_SESSION['book_id'];

$sql_0 = "select * from note where notename  = '$note_name' and userid = '$user_id' and notebookID='$book_id' and isDelete = '0'";
$result0 = mysqli_query($conn,$sql_0);//执行sql
$rowcount = mysqli_num_rows($result0);//返回一个数值
if ($rowcount) {//0 false 1 true
    echo "used";
    exit;
}
else{
	$sql_1 = "INSERT INTO mark(userid,isStart) VALUES ('$user_id','12')";
	mysqli_query($conn,$sql_1);
	$mark_id = mysqli_insert_id($conn);

	$sql = "INSERT INTO note(userid,notebookID,isStart,notename,markID)VALUES 			('$user_id','$book_id','12','$note_name','$mark_id')";
	$result = mysqli_query($conn,$sql);
	$data = mysqli_fetch_assoc($result);
	if ($result) {
   	    $_SESSION['note_id'] = $data["id"];
    //echo "succeed";
	}else{
    	echo'错误是：'.$conn->errno.':'.$conn->error;
	}
}
mysqli_close($conn);
?>