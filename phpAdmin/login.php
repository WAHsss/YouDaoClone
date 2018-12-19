<?php
session_start();
require("./conn.php");
$name = $_POST["username"];
$password =md5($_POST["userpassword"]) ;
if ($name && $password) {
    try{
        $sql1 = "select count(*) from \"noteuser\" where \"username\"  = '$name' and \"password\"= '$password'";//检测数据库是否有对应的username和password的sql
        $result = $conn->query($sql1);//执行sql
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        $row=current($rows);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    if ($row) {//0 false 1 true
        header("refresh:0;url=../demo.html");//如果成功跳转至.html页面
        try{
            $sql2 = "select \"id\" from \"noteuser\" where \"username\"  = '$name' and \"password\"= '$password'";//检测数据库是否有对应的username和password的sql
            $result = $conn->query($sql2);//执行sql
            $rows = $result->fetch(PDO::FETCH_ASSOC);
            $row=current($rows);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $_SESSION['id'] = $row;  //传送登录者id
        /* echo "<script>alert(\"登录成功\");</script>";
         exit; 直接跳转，不再提示登陆成功*/
    } else {
        echo "<script>alert(\"用户名或密码错误\");</script>";
    }
}
else {//如果用户名或密码有空
    echo "<script>alert(\"表单不完整\");history.back()</script>";

}

$conn=null;
?>