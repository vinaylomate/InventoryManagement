<?php
$contact=$_GET['txtcontact'];
//echo $s_name;
include('mysql.connect.php');

$query="SELECT contact FROM supplier_tbl WHERE contact='$contact'";
//echo $query;
$stmt=$mysql->prepare($query);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$contact=$row['contact'];
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