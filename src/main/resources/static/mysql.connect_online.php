<?php
$hostname="103.14.97.84";
$port="3306";
$uname="rar_inventory_admin";
$pass="[FPaY!9SDZWZ";
$dbname="rar_inventory_db";
try
{
	$mysql_online=new PDO("mysql:host=$hostname;port=$port;dbname=$dbname",$uname,$pass);
	$mysql_online->exec("set names utf8");
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>