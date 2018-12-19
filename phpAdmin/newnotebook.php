<?php
session_start();
require("./conn.php");
$book_name = $_GET["q"];
$user_id = $_SESSION['id'];
try{
    $sql_1 = "select count(*) from \"notebook\" where (\"bookName\"  = '$book_name' and \"userid\" = '$user_id' and \"isDelete\" = '0')";
    $result = $conn->query($sql_1);//执行sql
    $rows = $result->fetch(PDO::FETCH_ASSOC);
    $row=current($rows);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if ($row) {//0 false 1 true
    echo "used";
    exit;
}else {
    try{
        $sql = "INSERT INTO \"notebook\"(\"userid\",\"bookName\",\"isStart\",\"isDelete\")VALUES ('$user_id','$book_name','12','0')";
        $insertCount = $conn->exec($sql);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    try{
        //获取bookid
        $sqlid = "select \"id\" from \"notebook\" where \"bookName\"='$book_name'";
        $result = $conn->query($sqlid);//执行sql
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        $row=current($rows);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    if ($row) {
        $_SESSION['book_id'] = $row;    //储存book  ID
        //echo "succeed";
    }
}

$conn=null;
?>