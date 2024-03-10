<?php
$Id=$_GET['Id'];
include('mysql.connect.php');
$q="SELECT eType FROM entry_type_tbl WHERE sts='0' AND entryId='$Id'";
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
$row=$s->fetch(PDO::FETCH_ASSOC);
$eType=$row['eType'];
$mysql=null;
echo $eType;
?>