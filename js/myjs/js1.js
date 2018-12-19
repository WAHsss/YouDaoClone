
// 调用富文本框插件

var E = window.wangEditor;
var editor = new E('#div1', '#div2');// 两个参数也可以传入 elem 对象，class 选择器
editor.create();


function information() {
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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("username").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/getuser.php",true);
    xmlhttp.send();

}
function newnotebook() {
    if (window.XMLHttpRequest) {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    } else {
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var bookname = document.getElementById("bookname");
    if (bookname.value.length == 0) {
        alert("请输入笔记本名称");
        return;
    }
	var cf = window.confirm("您要新建"+bookname.value+"么？");
	if(cf == true) {
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
               var text1 = xmlhttp.responseText;
               if(text1 == 'used') {
                   alert("该笔记本已存在！");
                   return;
               } else {
                   alert("创建成功");
                   location.reload();
               }
            }
        }
        xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/newnotebook.php?q="+bookname.value,false);
        xmlhttp.send();
	} else {
		return;
	}

}
function newnote() {      //新建笔记
    var notename = document.getElementById("notename");
    if (notename.value.length == 0)
    {
        alert("请输入笔记标题");
        return;
    }
	
	var cf = window.confirm("您要新建笔记"+notename.value+"么？");
	if(cf == true)
	{
	xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           var text1 = xmlhttp.responseText;
           if(text1=='used'){
               alert("该笔记已存在于此笔记本中！");
			   return;
           }else {
               alert("创建成功");
               location.reload();
           }
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/newnote.php?q="+notename.value,false);
    xmlhttp.send();
	}
	else
	{
		return;
	}
	
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
    /*
	xmlhttp.open("GET","newnote.php?q="+notename.value,true);
    xmlhttp.send();
    location.reload();
	*/	
}


function writenote() {     //写笔记
    var text1=editor.txt.html();
    var text=text1.replace(/&nbsp;/g,'　');
    var mark = document.getElementById("mark");
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

    xmlhttp.open("POST","http://localhost:63342/test/phpAdmin/writenote.php?",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("note="+text+"&mark="+mark.value);
    location.reload();
}


function shownotebook() {
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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("notebook").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/shownotebook.php",true);
    xmlhttp.send();

}
function shownote(book_id) {     //显示笔记
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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("note").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/shownote.php?q="+book_id,true);
    xmlhttp.send();

}


function shownote1(note_id) {   //输出笔记内容
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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var text=xmlhttp.responseText;
            editor.txt.html(text);
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/shownotecontent.php?q="+note_id,true);
    xmlhttp.send();

}



function deletenote(note_id) {
	
	var confirm=window.confirm("您要删除该笔记么？");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/deletenote.php?q="+note_id,true);
    	xmlhttp.send();
    	location.reload();
	}
	else
	{
        return;
	}
	
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
}

function deletenotebook(note_id) {
             
	var confirm=window.confirm("您要删除该笔记本及其所有笔记么？");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/deletenotebook.php?q="+note_id,true);
   		xmlhttp.send();
        location.reload();
	}
	else
	{
        return;
	}
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
}


function showdelete() {
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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("show_delete").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/showdelete.php",true);
    xmlhttp.send();

}
function restore_note(note_id) {
	var confirm=window.confirm("您要还原该笔记么？（还原的笔记将复原回原笔记本）");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/restorenote.php?q="+note_id,true);
    	xmlhttp.send();
    	location.reload();
	}
	else
	{
        return;
	}
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
}
function pack(note_id) {
	
	var confirm=window.confirm("您要彻底删除该笔记么？（删除后不可复原）");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/packnote.php?q="+note_id,true);
    	xmlhttp.send();
    	location.reload();
	}
	else
	{
        return;
	}
	
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
}

function delete_all() {
	
	var confirm=window.confirm("您要彻底删除所有笔记么？（删除后不可复原）");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/deleteall.php",true);
    	xmlhttp.send();
    	location.reload();
	}
	else
	{
        return;
	}
	
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
}

function restore_all() {
	
	var confirm=window.confirm("您要还原所有笔记么？（还原的笔记将复原回原笔记本）");			   
	if(confirm == true)
    {
		xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/restoreall.php",true);
    	xmlhttp.send();
    	location.reload();
	}
	else
	{
        return;
	}
	
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
    
}

function logout() {
	
	var confirm=window.confirm("您要注销该账号么？");
	if(confirm)
    {
        xmlhttp.open("GET","http://localhost:63342/test/phpAdmin/logout.php",true);
        xmlhttp.send();
        window.location.href="login.html"
	}
	else
	{

        return;
	}
	
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
    
}
function login() {
    window.location.href='login.html';
}