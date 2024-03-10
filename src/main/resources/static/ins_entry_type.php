<?php
include("mysql.connect.php");
$uid=$_POST['uid'];
$txtetypenm=$_POST['txtetypenm'];
$eType=$_POST['eType'];
$q="insert into entry_type_tbl(entryNm,eType,uid)
values('$txtetypenm','$eType','$uid')";
$s=$mysql->prepare($q);
$s->execute();
echo 'Record Inserted Successfully..';
$mysql=null;
?>