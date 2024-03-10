<?php

include('mysql.connect.php');
$company_id=$_POST['company_id'];
$loc_code=$_POST['txtlcode'];
$name=$_POST['txtnm'];
$desc=$_POST['description'];
$uid=$_POST['uid'];
$iType=$_POST['iType'];


$qry="INSERT INTO location_tbl(company_id,location_name,location_description,uid,loc_code,iType)VALUES('$company_id','$name','$desc','$uid','$loc_code','$iType')";
$stm=$mysql->prepare($qry);
$stm->execute();
$mysql=null;
echo 'Record Inserted Successfully...';
?>