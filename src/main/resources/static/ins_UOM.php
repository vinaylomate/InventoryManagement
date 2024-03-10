<?php
/*if(isset($_POST['btn']))*/
include('mysql.connect.php');
$unit_name=$_POST['unit_name'];
if(empty($_POST['desc']) || $_POST['desc']=='0')
{
	$desp=$_POST['unit_name'];
}
else
{
$desp=$_POST['desc'];
}
$uid=$_POST['uid'];

$qry="INSERT INTO uom_tbl(uom,desp,uid)VALUES('$unit_name','$desp','$uid')";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();
$lastid=$mysql->lastInsertId();
$mysql=null;
echo 'Record Inserted Successfully....!!!';
?>