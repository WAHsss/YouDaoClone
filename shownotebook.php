<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
if ($user_id == null){
    echo "<a onclick='login()'>用户未登陆请登陆,点击这里重新登录！！！！</a>";
}else{
$sql = "select * from notebook where userid ='$user_id' and isDelete='0'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            echo "<dd class=\"row my-note-show\"><a  role=\"button\" type=\"button\" class=\" btn btn-default btn-sm  my-note-button \"  onclick=\"shownote(" . $row["id"] . " )\"><span class=\"glyphicon glyphicon-triangle-right\"  >" . $row["bookName"] . "  </span></a>
                <button  onclick=\"deletenotebook(" . $row["id"] . " )\" class=\"btn btn-danger btn-sm  pull-right glyphicon glyphicon-trash\"></button></dd>";

        }
    }else{
    echo "<h2 style=\"color: #cccccc\">您当前没有笔记本，请先输入笔记本名点击新建即可创建！</h2>";
    }
}
mysqli_close($conn);
?>

