<?php	
class DBCLASS
{
	public static function db()
	{
		$hostname="localhost";
		$port="3308";
		$uname="root";
		$pass="usbw";
		$dbname="inventory_db";
		try
		{
			$mysql=new PDO("mysql:host=$hostname;port=$port;dbname=$dbname",$uname,$pass);
			$mysql->exec("SET NAMES utf8");
			return $mysql;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	function dbSelect($q)
	{
		$con=DBCLASS::db();
		//echo $q."<Br>";
		$stmt=$con->prepare($q);
		$stmt->execute();
		$res=$stmt->fetchAll();
		$con=null;
		return $res;
	}
}
?>