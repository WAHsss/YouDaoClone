<?php
session_start();
require("conn.php");
$user_id = $_SESSION['id'];
$notebook_id = $_GET["q"];
$sql = "select * from note where userid ='$user_id'and notebookID = '$notebook_id'and isDelete='0'";
$result = mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($rows as $row) {
    $note =strip_tags($row["content"]);
    $mark_id = $row["markID"];
    $sql_1 = "select * from mark where id = '$mark_id' and isDelete = '0'";
    $result = mysqli_query($conn,$sql_1);//执行sql
    $data = mysqli_fetch_assoc($result);
    if(strlen($note)>20){
        $note = mb_substr($note,0,20,"utf8").'.....';
    }
   // echo "<div class=\"div2\" onclick=\"shownote1(".$row["id"]." )\"><h5>".$row["notename"]."</h5></div>";
    echo "<div class=\"panel panel-default my-middle-panel\" >
					<div class=\"panel-heading\">
						<span class=\"h3 panel-title\">".$row["notename"]."</span>
						<span class=\"pull-right\">
                        <span class=\"glyphicon glyphicon-tag\"></span>".$data["markName"]."
                    </span>
					</div>
					<div class=\"panel-body\"  onclick=\"shownote1(".$row["id"]." )\">
						<span>".$note."</span>
					</div>
					<div class=\"panel-footer\">
						<small>".$row["updateTime"]."</small>
						<button class=\"btn btn-danger btn-xs pull-right\" onclick=\"deletenote(".$row["id"]." )\">删除</button>
					</div>
				</div>";
}
$_SESSION['book_id'] = $notebook_id;
mysqli_close($conn);
?>