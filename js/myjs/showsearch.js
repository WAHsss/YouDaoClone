function showsearchmain() {
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var cont=document.getElementById("searchtxt").value;
    if(cont.length==0){
        alert('请输入要查询的内容！');
        return false;
    }
    xmlhttp.onreadystatechange=function () {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("note").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET",'http://localhost:63342/test/phpAdmin/searchmain.php?cont='+cont,true);
    xmlhttp.send();
}
function showsearchrecycle() {
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var cont1=document.getElementById("searchtxt").value;
    if(cont1.length==0){
        alert('请输入要查询的内容！');
        return false;
    }
    xmlhttp.onreadystatechange=function () {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("searchDeleteNote").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET",'http://localhost:63342/test/phpAdmin/searchrecycle.php?cont='+cont1,true);
    xmlhttp.send();
}