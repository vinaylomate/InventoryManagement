<?php
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
include('mysql.connect.php');
if($iType=='1')
{
	$q="SELECT a.rmId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',a.description,' - ',b.uom) AS itemNm FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";
}
else
{
	$q="SELECT a.fgId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',a.brand,' ',a.descc,' - ',b.uom) AS itemNm FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
while($row=$s->fetch(PDO::FETCH_ASSOC))
{
  echo '<option value='.$row['ID'].'>'.$row['itemNm'].'</option>';	
}
$mysql=null;
?>