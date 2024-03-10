<?php
include('mysql.connect.php');
date_default_timezone_set('Asia/Calcutta');
$date=date('Y-m-d');
$sage_code=$_POST['sage_code'];
$focus_code=$_POST['focus_code'];
$desc=$_POST['txtdesc'];
$packing_size=$_POST['packing_size'];
$uom=$_POST['uom'];
$company_name=$_POST['company_name'];
$location=$_POST['location'];
$reorder_level_qty=$_POST['reorder_level_qty'];
$product_expiry=$_POST['product_expiry'];
$rackNo=$_POST['rackNo'];
$uid=$_POST['uid'];
$cid=$_POST['cat_id'];

$q="SELECT rmId FROM rm_master WHERE sage_code='$sage_code' AND focus_code='$focus_code' AND location_id='$location' AND company_id='$company_name' AND sts='0' AND catId='$cid'";
$stmt=$mysql->prepare($q);
$stmt->execute();
$rw=$stmt->fetch(PDO::FETCH_ASSOC);
if(empty($rw['rmId']))
{
	$qry="INSERT INTO rm_master(dt,sage_code,focus_code,description,UOM,company_id,	location_id,reorder_level_qty,product_expiry,uid,rackNo,catId)VALUES('$date','$sage_code','$focus_code','$desc','$uom','$company_name','$location','$reorder_level_qty','$product_expiry','$uid','$rackNo','$cid')";
	$stm=$mysql->prepare($qry);
	$stm->execute();
	$lastId=$mysql->lastInsertId();
	
	/*$qq="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,out_qty,reord_qty,rackNo,uid)
	VALUES('$company_name','$location','1','$lastId','0','0','$reorder_level_qty','$rackNo','$uid')";
	$st=$mysql->prepare($qq);
	$st->execute();*/
	
	$mysql=null;
	echo "Record Inserted Successfully...!";
}
else
{
	$mysql=null;
	echo "Record Already Exists...!";	
}
?>