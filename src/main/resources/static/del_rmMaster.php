<?php
date_default_timezone_set('Asia/Calcutta');
$id=$_GET['id'];
//echo $id."<br>";
$uid=$_GET['userId'];
$dt=date('Y-m-d');
include('mysql.connect.php');
$qry="UPDATE rm_master SET sts='2' WHERE rmId='$id'";
//echo $qry."<br>";
$stmt=$mysql->prepare($qry);
$stmt->execute();

$q="UPDATE rm_master SET del_uid='$uid',del_dt='$dt' WHERE rmId='$id'";
$s=$mysql->prepare($q);
$s->execute();

$mysql=null;
?>