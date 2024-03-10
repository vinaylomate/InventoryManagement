<?php
/*if(isset($_POST['btn']))*/
include('mysql.connect.php');
$iType=$_POST['iType'];
$rackNo=$_POST['txtrkNo'];
$uid=$_POST['uid'];

$qry="INSERT INTO rack_tbl(iType,rackNo,uid)VALUES('$iType','$rackNo','$uid')";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();
$lastid=$mysql->lastInsertId();
$mysql=null;
echo 'Record Inserted Successfully....!!!';
?>