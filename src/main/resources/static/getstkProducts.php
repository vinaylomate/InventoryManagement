<?php
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
//$srch=$_GET['srch'];
include('mysql.connect.php');
$q="SELECT IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,IF(a.iType='1',CONCAT(r.sage_code,' ',r.focus_code,' ',r.description,' ',r.UOM),CONCAT(f.sage_code,' ',f.focus_code,' ',f.descc,' ',f.brand,' ',f.capacity, ' ',f.uom)) AS itemNm FROM stock_tbl AS a LEFT JOIN location_tbl AS b ON a.locId=b.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN rm_master AS r ON a.itemId=r.rmId WHERE a.compId='$compId' AND a.locId='$locId' AND a.iType='$iType'";
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
$data=$s->fetchAll();
//while($row=$s->fetch(PDO::FETCH_ASSOC))
foreach($data as $row)
{
  echo '<option value='.$row['itemId'].'>'.$row['itemNm'].' ('.$row['iTypeNm'].')'.'</option>';	
}
$mysql=null;
?>