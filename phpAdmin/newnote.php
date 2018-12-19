<?php
session_start();
require("./conn.php");
$note_name =$_GET['q'];
$user_id = $_SESSION['id'];
$book_id = $_SESSION['book_id'];
try{
    $sql_0 = "select count(*) from \"note\" where \"notename\"  = '$note_name' and \"userid\" = '$user_id' and \"notebookID\"='$book_id' and \"isDelete\" = '0'";
    $result1 = $conn->query($sql_0);//执行sql
    $rows1 = $result1->fetch(PDO::FETCH_ASSOC);//取出一条数据0 or 1
    $row1=current($rows1);//返回数组第一个数据
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
if ($row1) {//0 false 1 true
    echo "used";
    exit;
}
else{
    try{
        //插入标签
        $sql_1 = "INSERT INTO \"mark\"(\"userid\",\"isStart\",\"isDelete\") VALUES ('$user_id','12','0')";
        $insertCount = $conn->exec($sql_1);
        //取出查找出的标签
        $sql_2 = "SELECT markid_seq.currval FROM dual";
        $result2 = $conn->query($sql_2);//执行sql
        $rows2 = $result2->fetch(PDO::FETCH_ASSOC);
        $row2=current($rows2);
        $mark_id = $row2;

        $sql = "INSERT INTO \"note\"(\"userid\",\"notebookID\",\"isStart\",\"notename\",\"markID\",\"isDelete\")VALUES('$user_id','$book_id','12','$note_name','$mark_id','0')";
        $result = $conn->exec($sql);
        $sql_3 = "SELECT noteid_seq.currval FROM dual";
        $result3 = $conn->query($sql_3);//执行sql
        $rows3 = $result3->fetch(PDO::FETCH_ASSOC);
        $row3=current($rows);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    if ($result) {
        $_SESSION['note_id'] = $row3;
        //echo "succeed";
    }else{
        echo'错误是：'.$conn->errno.':'.$conn->error;
    }
}
$conn=null;
?>