<?php
$iType=$_GET['iType'];
$compId=$_GET['compId'];
$locId=$_GET['locId'];
$yr=$_GET['yr'];
$yr2=$_GET['yr2'];
include('mysql.connect.php');
$qq="SELECT loc_code FROM location_tbl WHERE sts!='2' AND ID='$locId'";
$st=$mysql->prepare($qq);
$st->execute();
$roww=$st->fetch(PDO::FETCH_ASSOC);
$lc_cd=$roww['loc_code'];

//series
$qq1="SELECT MAX(docNo)+1 AS nos FROM doc_no_lk_tbl WHERE locId='$locId' AND yr='$yr2' ORDER BY docNo LIMIT 1";
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
if($len>=1)
{
	$docNo=$lc_cd.$yr.'LC00'.$nos;
}
else if($len>2)
{
	$docNo=$lc_cd.$yr.'LC00'.$nos;
}
else if($len>3)
{
	$docNo=$lc_cd.$yr.'LC0'.$nos;
}
else if($len>4)
{
	$docNo=$lc_cd.$yr.'LC_'.$nos;
}
else
{
	$docNo=$lc_cd.$yr.'_LC_'.$nos;
}
echo $docNo;
$mysql=null;
?>