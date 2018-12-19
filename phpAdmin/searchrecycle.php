<?php
session_start();
require("conn.php");
$cont=$_GET['cont'];
$user_id = $_SESSION['id'];
//$notebook_id = $_GET["q"];
$sql = "select count(*) from \"note\" where \"userid\" ='$user_id' and \"isDelete\"='0' and \"notename\" like '%$cont%'" ;
$result1 = $conn->query($sql);//执行sql
$rows1 = $result1->fetch(PDO::FETCH_ASSOC);
$row1=current($rows1);
if($row1!=0){
    $sql1 = "select * from \"note\" where \"userid\" ='$user_id' and \"isDelete\"='0' and \"notename\" like '%$cont%'" ;
    $rows = $conn->query($sql1);//执行sql
    foreach ($rows as $row) {
        try{
            $row["content"] =stream_get_contents($row["content"]);
            $note1 =strip_tags($row["content"]);//进行格式筛选
            $note = iconv("GBK", "UTF-8", $note1);
            $mark_id = $row["markID"];
            //查询markname
            $sql_1 = "select \"markName\" from \"mark\" where \"id\" = '$mark_id' and \"isDelete\" = '0'";
            $result = $conn->query($sql_1);//执行sql
            $rows = $result->fetch(PDO::FETCH_ASSOC);
            $data = $rows;

            $updateTime1 = str_replace(".000000","",$row["updateTime"]);
            $updateTime = iconv("GBK", "UTF-8", $updateTime1);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
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
						<small>".$updateTime."</small>
						<button class=\"btn btn-danger btn-xs pull-right\" onclick=\"deletenote(".$row["id"]." )\">删除</button>
					</div>
				</div>";
    }
}else{
    echo "<h3 style=\"color: red\">查询结果为空！</h3>";
}
//$_SESSION['book_id'] = $notebook_id;
$conn=null;
?>
