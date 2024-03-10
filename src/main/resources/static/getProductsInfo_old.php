<?php
date_default_timezone_set('Asia/Calcutta');
$iType=$_GET['iType'];
$itemId=$_GET['itemId'];
$dt=$_GET['dt'];
include('mysql.connect.php');
if($iType=='1')
{
$q="SELECT product_expiry AS expdt FROM rm_master WHERE rmId='$itemId' AND sts='0'";
}
else
{
$q="SELECT product_expiry AS expdt FROM fg_master WHERE fgId='$itemId' AND sts='0'";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
$row=$s->fetch(PDO::FETCH_ASSOC);
$expdt="";
if( strpos( $row['expdt'], 'Year' ) !== false || strpos( $row['expdt'], 'YEAR' ) !== false || strpos( $row['expdt'], 'year' ) !== false) 
{
	$v=explode(" ",$row['expdt']);
	$expdt=date('Y-m-d', strtotime('+'.$v[0].' year', strtotime($dt)));
	//$expdt=date('Y-m-d', strtotime('+'.$v[0].' year - 1day', strtotime($dt)));
}
else if( strpos( $row['expdt'], 'Month' ) !== false || strpos( $row['expdt'], 'MONTH' ) !== false || strpos( $row['expdt'], 'month' ) !== false) 
{
	$v=explode(" ",$row['expdt']);
	$expdt=date('Y-m-d', strtotime('+'.$v[0].' month', strtotime($dt)));
}
else
{
	$v=explode(" ",$row['expdt']);
	$expdt=date('Y-m-d', strtotime('+'.$v[0].' year', strtotime($dt)));
	//$expdt=date('Y-m-d', strtotime('+'.$v[0].' year - 1day', strtotime($dt)));
}

echo $expdt;
$mysql=null;
?>