<?php
session_start();
require("conn.php");
$id = $_SESSION['id'];
$agopassword=$_POST["agopassword"];
$agopwd=md5($agopassword);
$password1 = $_POST["password"];
$password2 = $_POST["makesurepwd"];
if ($agopassword&&$password1&&$password2){
        $check = "select * from user where password  = '$agopwd'";//检测数据库中密码是否匹配
        $result = mysqli_query($conn, $check);//执行sql
        $rowcount = mysqli_num_rows($result);//返回一个数值
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
                    mysqli_query($conn,"UPDATE user set password = '$user_password' where id = '$id'");
                    echo "<script>alert(\"密码修改成功,请重新登陆！\");setTimeout(function(){window.location.href='login.html';},500);</script>";
        }else{
            echo "<script>alert(\"原密码输入不正确，请重新输入！\");history.back();</script>";
            exit;
        }
}else{
     echo "<script>alert(\"表单不完整\");history.back();</script>";
}
mysqli_close($conn);
?>
