<?php
$txtitem=$_GET['txtitem'];
//echo $s_name;
include('mysql.connect.php');

$query="SELECT item_code FROM fg_master WHERE item_code='$txtitem'";
//echo $query;
$stmt=$mysql->prepare($query);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$item_code=$row['item_code'];
if($row=$stmt->rowCount()>0)
{
	echo 1;
}
else
{
	echo 0;
}
$mysql=null;
?>