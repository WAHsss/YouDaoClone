<?php
session_start();
require("./conn.php");
$id = $_SESSION['id'];
$agopassword=$_POST["agopassword"];
$agopwd=md5($agopassword);
$password1 = $_POST["password"];
$password2 = $_POST["makesurepwd"];
if ($agopassword&&$password1&&$password2){
        $check = "select count(*) from \"noteuser\" where \"password\"  = '$agopwd'";//检测数据库中密码是否匹配
        $result1 = $conn->query($check);//执行sql
        $rows1 = $result1->fetch(PDO::FETCH_ASSOC);
    $rowcount=current($rows1);
        if($rowcount){
                    if ($password1 == $password2  && (strlen($password1)>=6 && strlen($password1)<=18))
                    {
                        $user_password = md5($password1);

                    } else if($password1 != $password2){
                        echo "<script>alert(\"密码不一致\");history.back();</script>";
                        exit;
                    }else{
                        echo "<script>alert(\"密码长度错误\");history.back();</script>";
                        exit;
                    }
                    $conn->exec("UPDATE \"noteuser\" set \"password\" = '$user_password' where \"id\" = '$id'");
                    echo "<script>alert(\"密码修改成功,请重新登陆！\");setTimeout(function(){window.location.href='../login.html';},500);</script>";
        }else{
            echo "<script>alert(\"原密码输入不正确，请重新输入！\");history.back();</script>";
            exit;
        }
}else{
     echo "<script>alert(\"表单不完整\");history.back();</script>";
}
$conn=null;
?>
