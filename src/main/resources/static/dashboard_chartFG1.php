<?php 
header('Content-Type: application/json');
$iType=$_GET['iType'];
$cdt=date('m-Y');
include('mysql.connect.php');
/*$sqlQuery ="SELECT a.dt,DATE_FORMAT(a.dt,'%m') AS mnt,DATE_FORMAT(a.dt,'%Y') AS yr,ROUND(SUM(qty),2) AS qty,a.compId,a.iType,a.locId FROM inventory_tbl AS a LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId WHERE a.sts='0' AND b.eType='2' AND DATE_FORMAT(a.dt,'%m-%Y')='$cdt' AND a.iType='$iType' AND b.sts='0' GROUP BY a.dt,a.compId,a.iType,a.locId,DATE_FORMAT(a.dt,'%m'),DATE_FORMAT(a.dt,'%Y') ORDER BY DATE_FORMAT(a.dt,'%m'),SUM(qty) DESC";*/ 	
$sqlQuery="SELECT DATE_FORMAT(a.dt,'%m-%Y') AS yr,ROUND(SUM(b.qty),2) AS qty FROM inventory_tbl AS a LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId WHERE a.sts='0' AND b.eType='2' AND a.iType='$iType' AND b.sts='0' GROUP BY DATE_FORMAT(a.dt,'%m-%Y') ORDER BY DATE_FORMAT(a.dt,'%m-%Y'),SUM(b.qty) DESC LIMIT 5";

//echo $sqlQuery;
$result = $mysql->prepare($sqlQuery);
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);

$dataPoints = array();
while($row=$result->fetch())
{
	$pr=(double)$row["qty"];
	$dt1=explode('-',$row['yr']);
	$month_name = date("F", mktime(0, 0, 0, $dt1[0], 10));
	$Yr=$month_name."-".$dt1[1];
	$stuff = array("label" => $Yr,"y" => $pr,"indexLabel" => "{y}");
	array_push($dataPoints,$stuff);	
} 
$mysql=null; 
echo json_encode($dataPoints); 
?>