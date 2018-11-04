function alteruserinfo() {


    var agopassword=document.getElementById("agopassword").value;
    var password=document.getElementById("password").value;
    var makesurepwd=document.getElementById("makesurepwd").value;
    if(agopassword=="" || password=="" || makesurepwd=="")
    {
        alert('不能有空！');
        return false;
    }else {
        if(password!=makesurepwd){
            alert('两次密码输入不一致！');
        }
    }


}