<?php
include('mysql.connect.php');

$cat_id=$_POST['cat_id'];
/*$code=$_POST['txtcode'];*/
$sage_code=$_POST['sage_code'];
$focus_code=$_POST['focus_code'];
$desc=$_POST['desc'];
$brand=$_POST['brand'];
$uom=$_POST['uom'];
$company_name=$_POST['company_name'];
$location=$_POST['location'];
$reorder_level_qty=$_POST['reorder_level_qty'];
$product_expiry=$_POST['product_expiry'];
$rackNo=$_POST['rackNo'];
$barcode=$_POST['barcode'];

$uid=$_POST['uid'];

$q="SELECT fgId FROM fg_master WHERE category_id='$cat_id' AND sage_code='$sage_code' AND brand='$brand' AND capacity='$uom' AND company_id='$company_name' AND location_id='$location' AND barcode='$barcode' AND sts='0'";
$stmt=$mysql->prepare($q);
$stmt->execute();
$rw=$stmt->fetch(PDO::FETCH_ASSOC);
if(empty($rw['fgId']))
{
	$qry="INSERT INTO fg_master(category_id,`sage_code`,focus_code,descc,brand,uom,	company_id,location_id,reorder_level_qty,product_expiry,uid,rackNo,barcode)VALUES('$cat_id','$sage_code','$focus_code','$desc','$brand','$uom','$company_name','$location','$reorder_level_qty','$product_expiry','$uid','$rackNo','$barcode')";
	$stm=$mysql->prepare($qry);
	$stm->execute();	
	$lastId=$mysql->lastInsertId();
	
	/*$qq="INSERT INTO stock_tbl(compId,locId,iType,itemId,in_qty,out_qty,reord_qty,rackNo,uid)
	VALUES('$company_name','$location','2','$lastId','0','0','$reorder_level_qty','$rackNo','$uid')";
	$st=$mysql->prepare($qq);
	$st->execute();*/
	
	$mysql=null;
	echo 'Record Inserted Successfully...!';
}
else
{
	$mysql=null;
	echo "Record Already Exists...!";	
}
?>