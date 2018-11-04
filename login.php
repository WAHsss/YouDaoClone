<?php
session_start();
require("conn.php");
    $name = $_POST["username"];
    $password =md5($_POST["userpassword"]) ;
    if ($name && $password) {
        $sql = "select * from user where username  = '$name' and password= '$password'";//检测数据库是否有对应的username和password的sql
        $result = mysqli_query($conn,$sql);//执行sql
        $data = mysqli_fetch_assoc($result);//查找这一行数据
        $rowcount = mysqli_num_rows($result);//返回一个数值
        if ($rowcount) {//0 false 1 true
            header("refresh:0;url=demo.html");//如果成功跳转至.html页面
            $_SESSION['id'] = $data["id"];  //传送登录者id
           /* echo "<script>alert(\"登录成功\");</script>";
            exit; 直接跳转，不再提示登陆成功*/
        } else {
            echo "<script>alert(\"用户名或密码错误\");history.back();</script>";
        }
    }
    else {//如果用户名或密码有空
        echo "<script>alert(\"表单不完整\");history.back()</script>";

    }

mysqli_close($conn);
?>