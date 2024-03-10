<?php
include("mysql.connect.php");
$eId=$_POST['eId'];
$userId=$_POST['uid'];
$company_code=$_POST['txtcode'];
$pcompany_name=$_POST['txtnm'];
$company_name=$_POST['txtpnm'];
$description=$_POST['txtdesc'];
$pdescription=$_POST['txtpdesc'];

$qq="INSERT INTO edit_company_tbl(compId,uid,pcomp_nm,comp_nm,p_adrs,adrs)
VALUES('$eId','$userId','$pcompany_name','$company_name','$pdescription','$description')";
$ss=$mysql->prepare($qq);
$ss->execute();

$q="UPDATE company_tbl SET company_name='$company_name',company_description='$description' WHERE ID='$eId'";
$s=$mysql->prepare($q);
$s->execute();

echo "Company Details Updated Successfully....";

$mysql=null;
?>