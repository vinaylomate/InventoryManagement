<?php
$name=$_GET['nm'];
include('mysql.connect.php');

$qry="SELECT UserNm FROM admin_tbl WHERE UserNm='$name' AND sts='0'";
$st=$mysql->prepare($qry);
$st->execute();
$row=$st->fetch(PDO::FETCH_ASSOC);
if($st->rowCount()>0)
{
	echo "1";
}
$mysql=null;
?>