<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
$sql = "select * from note where userid ='$user_id'and isDelete='1'";
$result = mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($rows as $row){
    $note = $row["content"];
    $mark_id = $row["markID"];
    $sql_1 = "select * from mark where id = '$mark_id' ";
    $result = mysqli_query($conn,$sql_1);//执行sql
    $data = mysqli_fetch_assoc($result);
    if(strlen($note)>20){
        $note = mb_substr($note,0,20,"utf8").'.....';
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
                    <small>".$row["updateTime"]."</small>
                    <button class=\"btn btn-danger  pull-right\"style=\"margin-top: 5px\"  onclick=\"pack(".$row["id"]." )\">彻底删除</button>
                    <span class=\"pull - right\">&nbsp;&nbsp;</span> 
                    <button class=\"btn btn - success btn - xs pull - right\" style=\"background:#33cccc; color:#FFFFFF;\" onclick=\"restore_note(".$row["id"]." )\">还原</button>
                </div>
            </div>";
}
mysqli_close($conn);
?>