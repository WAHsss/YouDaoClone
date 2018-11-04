<?php
require("conn.php");
$user_name = $_POST["username"];
$use_email = $_POST["email"];
$pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
//"/^[a-zA-Z0-9#_\^\$\.\*\+\-\?\=\!\:\|\\\/\(\)\[\]\{\}]+@[a-zA-Z0-9]+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/";
if(!preg_match($pattern,$use_email)){
    echo "<script>alert(\"email不合法\");history.back();</script>";
}else{
    $sql1="select * from user where username = '$user_name' and email = '$use_email'";
    $result = mysqli_query($conn,$sql1);//执行sql
    $data = mysqli_fetch_assoc($result);//查找这一行数据
    $rowcount = mysqli_num_rows($result);
    if ($rowcount){
        $use_id = $data['id'];
        $toke = md5($data['username'].$data['password']);
        //$url = "http://localhost:8080/project/resrt.php?id=".$use_id."&toke=".$toke;
		$url = "http://localhost/test/resrt.php?id=".$use_id."&toke=".$toke;
        $send = sendmail($use_email,$url);
        if($send==1){
            echo "<script>alert(\"已经向您的邮箱发送一封重置密码邮件请点击邮件中链接重置密码\");setTimeout(function(){window.location.href='login.html';},500);</script>";
        }else{
            echo "<script>alert(\"wqwqw\");history.back();</script>";
        }

    }else{
        echo "<script>alert(\"用户名或邮箱错误！\");history.back();</script>";
    }
}

function sendmail($email,$url){
    include_once("Smtp.class.php");
    $smtpserver = "smtp.yeah.net"; //SMTP服务器，如smtp.163.com
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "ls1031527554@yeah.net"; //SMTP服务器的用户邮箱
    $smtpuser = "ls1031527554@yeah.net"; //SMTP服务器的用户帐号
    $smtppass = "1234567qwer"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
    //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "找回密码";
    $emailbody = "用户".$email."：<br/>您提交了找回密码请求,请点击下面的链接重置密码: <br/><a href='".$url."'target='_blank'>".$url."</a>";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
    return $rs;
}
mysqli_close($conn);
?>