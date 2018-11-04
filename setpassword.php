<?php
session_start();
require("conn.php");
$id = $_SESSION['set_id'];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
if ($password1&&$password2){
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
    echo "<script>alert(\"密码修改成功\");setTimeout(function(){window.location.href='login.html';},500);</script>";
}else{
    echo "<script>alert(\"表单不完整\");history.back();</script>";
}
mysqli_close($conn);
?>