<?php
session_start();
require("./conn.php");
$user_id = $_SESSION['id'];
if ($user_id == null){
    echo "<a onclick='login()'>用户未登陆请登陆,点击这里重新登录！！！！</a>";
}else{
    try{
        $sql = "select count(*) from \"notebook\" where \"userid\" ='$user_id' and \"isDelete\"='0'";
        $result = $conn->query($sql);//执行sql
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        $row=current($rows);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    if($row>0) {
        try{
            $sql = "select * from \"notebook\" where \"userid\" ='$user_id' and \"isDelete\"='0'";
            $result = $conn->query($sql);//执行sql
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        foreach ($result as $row) {
            echo "<div class=\"row my-note-show\"><a  role=\"button\" type=\"button\" class=\" btn btn-default btn-sm  my-note-button \"  onclick=\"shownote(" . $row["id"] . " )\"><span class=\"glyphicon glyphicon-triangle-right\"  >" . $row["bookName"] . "  </span></a>
                <button  onclick=\"deletenotebook(" . $row["id"] . " )\" class=\"btn btn-danger btn-sm  pull-right glyphicon glyphicon-trash\"></button></div>";

        }
    }else{
        echo "<h2 style=\"color: #cccccc\">您当前没有笔记本，请先输入笔记本名点击新建即可创建！</h2>";
    }
}
$conn=null;
?>

