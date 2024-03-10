<?php
include("mysql.connect.php");
$eId=$_POST['eId'];
$unit_name=$_POST['unit_name'];
$desp=$_POST['desc'];

$q="update uom_tbl set uom='$unit_name',desp='$desp' where ID='$eId'";
$s=$mysql->prepare($q);
$s->execute();

echo "UOM Details Updated Successfully....";

$mysql=null;
?>