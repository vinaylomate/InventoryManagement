<?php
include("mysql.connect.php");
$eId=$_POST['eId'];
$uId=$_POST['uid'];
$company_id=$_POST['company_id'];
$pcompany_id=$_POST['pcompany_id'];
$location_name=$_POST['txtnm'];
$plocation_name=$_POST['ptxtnm'];
$description=$_POST['txtdesc'];
$pdescription=$_POST['ptxtdesc'];

$q="UPDATE location_tbl SET company_id='$company_id',location_name='$location_name',location_description='$description' WHERE ID='$eId'";
$s=$mysql->prepare($q);
$s->execute();

$qq="INSERT INTO edit_location_tbl(compId,pcompId,locId,plocName,locName,pdesp,desp,uid)
VALUES('$company_id','$pcompany_id','$eId','$plocation_name','$location_name','$pdescription','$description','$uId')";
$ss=$mysql->prepare($qq);
$ss->execute();

$mysql=null;
echo "Location Details Updated Successfully....";
?>