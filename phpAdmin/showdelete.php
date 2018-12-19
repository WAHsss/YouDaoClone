<?php
session_start();
require("./conn.php");
$user_id = $_SESSION['id'];
$sql = "select * from \"note\" where \"userid\" ='$user_id'and \"isDelete\"='1'";
$result = $conn->query($sql);
foreach ($result as $row){
    $row["content"] =stream_get_contents($row["content"]);
    $note =strip_tags($row["content"]);//进行格式筛选
    $note1 = iconv("GBK", "UTF-8", $note);

    $mark_id = $row["markID"];
    $sql_1 = "select \"markName\" from \"mark\" where \"id\" = '$mark_id'";
    $result1 = $conn->query($sql_1);//执行sql
    $rows = $result1->fetch(PDO::FETCH_ASSOC);
    $data = $rows;
    $updateTime1 = str_replace(".000000","",$row["updateTime"]);
    $updateTime = iconv("GBK", "UTF-8", $updateTime1);
    if(strlen($note1)>20){
        $note = mb_substr($note1,0,20,"utf8").'.....';
    }
    echo "<div class=\"panel panel-default my-middle-panel\">
                <div class=\"panel-heading\">
                    <span class=\"h3 panel-title\">".$row["notename"]."</span>
                    <span class=\"pull-right\">
                        <span class=\"glyphicon glyphicon-tag\"></span>".$data["markName"]."
                    </span>
                </div>
                <div class=\"panel-body\">
                    ".$note."
                </div>
                
                <div class=\"panel-footer\">
                    <small>".$updateTime."</small>
                    <button class=\"btn btn-danger  pull-right\"style=\"margin-top: 5px\"  onclick=\"pack(".$row["id"]." )\">彻底删除</button>
                    <span class=\"pull - right\">&nbsp;&nbsp;</span> 
                    <button class=\"btn btn - success btn - xs pull - right\" style=\"background:#33cccc; color:#FFFFFF;\" onclick=\"restore_note(".$row["id"]." )\">还原</button>
                </div>
            </div>";
}
$conn=null;
?>