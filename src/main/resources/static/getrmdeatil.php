<?php
$txtRM_code=$_GET['txtRM_code'];
//echo $s_name;
include('mysql.connect.php');

$query="SELECT item_code,price FROM rm_master WHERE `code`='$txtRM_code'";
//echo $query;
$stmt=$mysql->prepare($query);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$item_code=$row['item_code'];
$price=$row['price'];
echo $item_code."@".$price;
$mysql=null;
?>