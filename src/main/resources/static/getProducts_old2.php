<?php
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$yr=$_GET['yr'];
$yr2=$_GET['yr2'];
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
	$q="SELECT a.rmId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM rm_master AS a LEFT JOIN uom_tbl AS b ON a.UOM=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";
}
else
{
	/*$q="SELECT a.fgId AS ID, CONCAT(a.focus_code,' - ',a.sage_code,' - ',b.uom) AS itemNm FROM fg_master AS a LEFT JOIN uom_tbl AS b ON a.uom=b.ID WHERE a.sts='0' AND a.company_id='$compId' AND a.location_id='$locId' ORDER BY a.focus_code";*/
	$q="SELECT fgId AS ID,CONCAT(focus_code,' - ',sage_code) AS itemNm FROM fg_master WHERE sts='0' AND company_id='$compId' AND location_id='$locId' ORDER BY focus_code";
}
//echo $q."<Br>";
$s=$mysql->prepare($q);
$s->execute();
echo '<option value="0">Select</option>';
$data=$s->fetchAll();
//while($row=$s->fetch(PDO::FETCH_ASSOC))
foreach($data as $row)
{
  echo '<option value='.$row['ID'].'>'.$row['itemNm'].'</option>';	
}
echo"@";
$qq="SELECT loc_code FROM location_tbl WHERE sts!='2' AND ID='$locId'";
$st=$mysql->prepare($qq);
$st->execute();
$roww=$st->fetch(PDO::FETCH_ASSOC);
$lc_cd=$roww['loc_code'];

//series
$qq1="SELECT MAX(docNo)+1 AS nos FROM doc_no_tbl WHERE locId='$locId' AND yr='$yr2' ORDER BY docNo LIMIT 1";
$st1=$mysql->prepare($qq1);
$st1->execute();
$roww1=$st1->fetch(PDO::FETCH_ASSOC);
$nos=0;
if(empty($roww1['nos']))
{
	$nos=1;
}
else
{
	$nos=$roww1['nos'];
}
//end of series
$len=strlen($nos);
if($len==1)
{
	$docNo=$lc_cd.$yr.'0000'.$nos;
}
else if($len>1)
{
	$docNo=$lc_cd.$yr.'0000'.$nos;
}
else if($len>2)
{
	$docNo=$lc_cd.$yr.'000'.$nos;
}
else if($len>3)
{
	$docNo=$lc_cd.$yr.'00'.$nos;
}
else if($len>4)
{
	$docNo=$lc_cd.$yr.'0'.$nos;
}
else
{
	$docNo=$lc_cd.$yr.$nos;
}
echo $docNo;
$mysql=null;
?>