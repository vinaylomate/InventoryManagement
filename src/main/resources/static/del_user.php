<?php
$id=$_GET['id'];
//echo $id."<br>";
include('mysql.connect.php');

$qry="UPDATE admin_tbl SET sts='2' WHERE id='$id'";
//echo $qry."<br>";
$stmt=$mysql->prepare($qry);
$stmt->execute();
$mysql=null;
?>