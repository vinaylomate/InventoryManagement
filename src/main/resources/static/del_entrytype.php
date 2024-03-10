<?php
date_default_timezone_set('Asia/Calcutta');
$id=$_GET['id'];
//echo $id."<br>";
$uid=$_GET['userId'];
$dt=date('Y-m-d');
include('mysql.connect.php');
$qry="UPDATE entry_type_tbl SET sts='2' WHERE entryId='$id'";
//echo $qry."<br>";
$stmt=$mysql->prepare($qry);
$stmt->execute();
$q="UPDATE entry_type_tbl SET del_uid='$uid',del_dt='$dt' WHERE entryId='$id'";
$s=$mysql->prepare($q);
$s->execute();
$mysql=null;
?>