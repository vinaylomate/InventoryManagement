<?php
date_default_timezone_set('Asia/Calcutta');
$iType=$_GET['iType'];
$itemIds=$_GET['itemId'];
$itemId=explode(',',$itemIds);
echo '<pre>';
print_r($itemId);
echo '</pre>';

$dt=$_GET['dt'];
$cnt=count($itemId);
include('mysql.connect.php');
$expdt2="";
for($i=0;$i<$cnt;$i++)
{
	if($iType=='1')
	{
		$q="SELECT product_expiry AS expdt FROM rm_master WHERE rmId='$itemId[$i]' AND sts='0'";
	}
	else
	{
		$q="SELECT product_expiry AS expdt FROM fg_master WHERE fgId='$itemId[$i]' AND sts='0'";
	}
	echo $q."<Br>";
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
	echo $expdt."<Br>";
	$expdt2=implode(',',$expdt);
	print_r($expdt2);
}
echo $expdt2;
$mysql=null;
?>