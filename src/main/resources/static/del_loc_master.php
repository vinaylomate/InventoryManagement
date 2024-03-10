<?php
date_default_timezone_set('Asia/Calcutta');
$id=$_GET['id'];
//echo $id."<br>";
$uid=$_GET['userId'];
$dt=date('Y-m-d');
include('mysql.connect.php');


$qry="UPDATE location_tbl SET sts='2' WHERE ID='$id'";
//echo $qry."<br>";
$stmt=$mysql->prepare($qry);
$stmt->execute();

$q="UPDATE location_tbl SET del_uid='$uid',del_dt='$dt' WHERE ID='$id'";
$s=$mysql->prepare($q);
$s->execute();

$mysql=null;
?>