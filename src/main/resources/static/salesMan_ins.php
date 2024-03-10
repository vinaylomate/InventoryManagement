<?php
include('mysql.connect.php');
$company_id=$_POST['company_id'];
$iType=$_POST['iType'];
$locatn=$_POST['locatn'];
$txtnm=$_POST['txtnm'];
$uid=$_POST['uid'];

$qry="INSERT INTO salesman_tbl(compId,iType,locId,salemanNm,uid)
VALUES('$company_id','$iType','$locatn','$txtnm','$uid')";
$stm=$mysql->prepare($qry);
$stm->execute();
$mysql=null;
echo 'Record Inserted Successfully...';
?>