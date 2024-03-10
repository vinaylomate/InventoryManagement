<?php
include('mysql.connect.php');
$q1="SELECT MAX(nos)+1 AS nos FROM cnt_tbl";
$st1=$mysql->prepare($q1);
$st1->execute();
$rw1=$st1->fetch(PDO::FETCH_ASSOC);
$nos=0;
if(empty($rw1['nos']))
$nos=1;
else
$nos=$rw1['nos'];


$q11="INSERT INTO cnt_tbl(nos)VALUES('$nos')";
$st11=$mysql->prepare($q11);
$st11->execute();
$mysql=null;
?>