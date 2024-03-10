<?php
$txtmob=$_GET['txtmob'];
//echo $s_name;
include('mysql.connect.php');

$query="SELECT mob FROM supplier_tbl WHERE mob='$txtmob'";
//echo $query;
$stmt=$mysql->prepare($query);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$mob=$row['mob'];
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