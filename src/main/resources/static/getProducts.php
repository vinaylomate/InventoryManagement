<?php
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$yr=$_GET['yr'];
$yr2=$_GET['yr2'];
$srch=$_GET['srch'];
include('mysql.connect.php');
/*if($iType=='1')
{
	$q="SELECT a.rmId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',a.description,' - ',b.uom) AS itemNm FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";
}
else
{
	$q="SELECT a.fgId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',a.brand,' ',a.descc,' - ',b.uom) AS itemNm FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";
}*/
if($iType=='1')
{
	$q="SELECT a.rmId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' AND (a.focus_code LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR b.uom LIKE '%".$srch."%' OR a.description LIKE '%".$srch."%') ORDER BY a.focus_code";
}
else
{
	$q="SELECT a.fgId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' AND (a.focus_code LIKE '%".$srch."%' OR a.sage_code LIKE '%".$srch."%' OR b.uom LIKE '%".$srch."%' OR a.descc LIKE '%".$srch."%' OR a.brand LIKE '%".$srch."%') ORDER BY a.focus_code";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
//echo '<option value="0">Select</option>';
$data=$s->fetchAll();
//while($row=$s->fetch(PDO::FETCH_ASSOC))
foreach($data as $row)
{
  echo '<option value='.$row['ID'].'>'.$row['itemNm'].'</option>';	
}
$mysql=null;
?>