<?php
date_default_timezone_set('Asia/Calcutta');
$iType=$_GET['iType'];
$itemId=$_GET['itemId'];
$dt=$_GET['dt'];
$b=$_GET['b'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$type=$_GET['typ'];
$stkId2=$_GET['stkId2'];
$batch=$_GET['bct'];
$eType=$_GET['eType'];
include('mysql.connect.php');
if($iType=='1')
{
	$q="SELECT a.rmId AS ID,a.sage_code,a.focus_code,'-' AS barcode,CONCAT(a.description,' - ',b.uom) AS desp,a.product_expiry AS expdt,reorder_level_qty AS rordQty,a.rackNo FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.rmId='$itemId' AND a.sts='0'";
}
else
{
	if($type=='0')
	{
		$q="SELECT a.fgId AS ID,a.sage_code,a.focus_code,a.barcode,CONCAT(a.descc,' ',a.brand,' - ',b.uom)  AS desp,product_expiry AS expdt,reorder_level_qty AS rordQty,a.rackNo FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.fgId='$itemId' AND a.sts='0'";
	}
	else
	{
		$q="SELECT a.fgId AS ID,a.sage_code,a.focus_code,a.barcode,CONCAT(a.descc,' ',a.brand,' - ',b.uom)  AS desp,product_expiry AS expdt,reorder_level_qty AS rordQty,rackNo FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.barcode='$itemId' AND a.sts='0'";
	}
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
$row=$s->fetch(PDO::FETCH_ASSOC);
$expdt=$rordQty=$rackNo="";
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

$rordQty=$row['rordQty'];
$rackNo=$row['rackNo'];

if($eType=='2')
{
	$qq="SELECT stk_qty FROM stock_tbl_2 WHERE ID='$stkId2' AND stk_qty!='0' AND sts!='2' AND batchNo='$batch' AND itemId='$itemId'";
	echo $qq."<Br>";
	$st=$mysql->prepare($qq);
	$st->execute();
	$rw=$st->fetch(PDO::FETCH_ASSOC);
	$stkqty=0;
	if(empty($rw['stk_qty']))
	$stkqty=0;
	else
	$stkqty=$rw['stk_qty'];
	
	$expdt="-";
}
else
{
	$qq="SELECT stk_qty FROM stock_tbl WHERE compId='$compId' AND locId='$locId' AND iType='$iType' AND itemId='$itemId' AND sts='0'";
	echo $qq."<Br>";
	$st=$mysql->prepare($qq);
	$st->execute();
	$rw=$st->fetch(PDO::FETCH_ASSOC);
	$stkqty=0;
	if(empty($rw['stk_qty']))
	$stkqty=0;
	else
	$stkqty=$rw['stk_qty'];
}

echo $row['ID']."||".$row['sage_code']."||".$row['focus_code']."||".$row['barcode']."||".$row['desp']."||".$expdt."||".$stkqty."||".$rordQty."||".$rackNo;
$mysql=null;
?>