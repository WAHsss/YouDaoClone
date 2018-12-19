<?php
require("./conn.php");
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
    try {
        $names = "select * from \"noteuser\" where \"username\"  = '$user_name'";//检测数据库是否有对应的username
        $result = $conn->query($names);//执行sql
        $rows = $result->fetchAll(PDO::FETCH_COLUMN, 1);
        $row=current($rows);

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    if ($row != $user_name) {
        try{
            $sql = "INSERT INTO \"noteuser\" (\"username\",\"password\",\"email\")VALUES('$user_name','$user_password','$user_email')";
            $insertCount = $conn->exec($sql);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        if ($insertCount) {
            //echo "<script>alert(\"注册成功\");</script>";
            echo "
               <script>
                          setTimeout(function(){window.location.href='../login.html';},500);
               </script>

                ";
        } else {
            echo "Error: " . $sql . "<br>";
            print_r($conn->errorInfo());
        }

   } else {

        echo "<script>alert(\"用户名已被使用\");history.back();</script>";
        exit;
    }

}else{
    echo "<script>alert(\"表单不完整\");history.back();</script>";
}
$conn=null; //关闭链接
?>