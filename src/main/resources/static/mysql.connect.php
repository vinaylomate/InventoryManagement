<?php
$hostname="localhost";
$port="3308";
$uname="root";
$pass="usbw";
$dbname="inventory_db";

try{
	
	$mysql=new PDO("mysql:host=$hostname;port=$port;dbname=$dbname",$uname,$pass);
	$mysql->exec("set names utf8");
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>