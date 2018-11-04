<?php
require("conn.php");
$user_name =  $_POST["user_name"];
$user_email =  $_POST["user_email"];
$password1 =  $_POST["user_password1"];
$password2 =  $_POST["user_password2"];
if($user_name && $password1 &&$user_email && $password2) {

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
    $pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
    //"/^[a-zA-Z0-9#_\^\$\.\*\+\-\?\=\!\:\|\\\/\(\)\[\]\{\}]+@[a-zA-Z0-9]+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/";
    if(!preg_match($pattern,$user_email)){
        echo "<script>alert(\"email不合法\");history.back();</script>";
        exit;
    }
    $names = "select * from user where username  = '$user_name'";//检测数据库是否有对应的username
    $result = mysqli_query($conn, $names);//执行sql
    $rowcount = mysqli_num_rows($result);//返回一个数值
    if ($rowcount) {//0 false 1 true
        echo "<script>alert(\"用户名已被使用\");history.back();</script>";
        exit;
        } else {
            $sql = "INSERT INTO user(username,password,email)VALUES ('$user_name','$user_password','$user_email')";
            if (mysqli_query($conn, $sql)) {
            echo "<script>alert(\"注册成功\");</script>";
            echo "
               <script>
                          setTimeout(function(){window.location.href='login.html';},500);
               </script>

                ";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

}else{
    echo "<script>alert(\"表单不完整\");history.back();</script>";
}
mysqli_close($conn);
?>