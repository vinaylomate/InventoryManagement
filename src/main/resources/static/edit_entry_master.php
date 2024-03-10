<?php
include("mysql.connect.php");
$entry_type=$_POST['entry_type'];
$pentry_type=$_POST['pentry_type'];
$etype=$_POST['eType'];
$petype=$_POST['peType'];
$eId=$_POST['eId'];
$uid=$_POST['uid'];
$q="UPDATE entry_type_tbl SET entryNm='$entry_type',eType='$etype' WHERE entryId='$eId'";
$s=$mysql->prepare($q);
$s->execute();

$qq="INSERT INTO edit_entry_type_tbl(entryId,entryNm,pentryNm,eType,peType,uid)
VALUES('$eId','$entry_type','$pentry_type','$etype','$petype','$uid')";
$ss=$mysql->prepare($qq);
$ss->execute();
$mysql=null;
echo 'Entry Type Details Updated Successfully....';
?>