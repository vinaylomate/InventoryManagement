<?php
date_default_timezone_set('Asia/Calcutta');
$id=$_GET['id'];
$uid=$_GET['userId'];
$dt=date('Y-m-d');
include('mysql.connect.php');

$qry="UPDATE cust_tbl SET sts='2' WHERE cId='$id'";
//echo $qry."<br>";
$stmt=$mysql->prepare($qry);
$stmt->execute();

$q="UPDATE cust_tbl SET del_uid='$uid',del_dt='$dt' WHERE cId='$id'";
$s=$mysql->prepare($q);
$s->execute();

$mysql=null;
?>