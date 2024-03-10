<?php
date_default_timezone_set("Asia/Calcutta");
include('mysql.connect.php');

$eId=$_POST['eId'];
$uid=$_POST['uid'];

$date=date("Y-m-d");

$sage_code=$_POST['sage_code'];
$p_sage_code=$_POST['p_sage_code'];

$focus_code=$_POST['focus_code'];
$p_focus_code=$_POST['p_focus_code'];

$desc=$_POST['txtdesc'];
$p_description=$_POST['p_description'];

$uom=$_POST['uom'];
$p_UOM=$_POST['p_UOM'];

$company_name=$_POST['company_name'];
$p_company_id=$_POST['p_company_id'];

$location=$_POST['location'];
$p_location_id=$_POST['p_location_id'];

$reorder_level_qty=$_POST['reorder_level_qty'];
$p_reorder_level_qty=$_POST['p_reorder_level_qty'];

$product_expiry=$_POST['product_expiry'];
$p_product_expiry=$_POST['p_product_expiry'];


$qry="UPDATE rm_master SET sage_code='$sage_code',`focus_code`='$focus_code',description='$desc',
packing_size='$packing_size',UOM='$uom',company_id='$company_name',location_id='$location',reorder_level_qty='$reorder_level_qty',product_expiry='$product_expiry' WHERE rmId='$eId'";
//echo $qry."<br>";
$stm=$mysql->prepare($qry);
$stm->execute();

$q="INSERT INTO edit_rm_master(rmId,uid,p_sage_code,sage_code,p_focus_code,`focus_code`,p_description,description,p_packing_size,packing_size,p_UOM,UOM,p_company_id,company_id,p_location_id,location_id,p_reorder_level_qty,reorder_level_qty,p_product_expiry,product_expiry)VALUES('$eId','$uid','$p_sage_code','$sage_code','$p_focus_code','$focus_code','$p_description','$desc','$p_packing_size','$packing_size','$p_UOM','$uom','$p_company_id','$company_name','$p_location_id','$location','$p_reorder_level_qty','$reorder_level_qty','$p_product_expiry','$product_expiry')";
$s=$mysql->prepare($q);
$s->execute();		
$mysql=null;
echo "RM Details Updated Successfully......";
?>