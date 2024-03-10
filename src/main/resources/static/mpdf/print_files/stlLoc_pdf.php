<?php ob_start();
$html='
		<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<style>
					body {	
					font-family: sans-serif;
					font-size: 10pt; }
					
					p {	margin: 0pt; }

					table.gridtable { 
					font-family: verdana,arial,sans-serif;
					font-size:12px;
					
					border-width: 1px;
					border-color: #96accd99;
					border-collapse: collapse; }
					
					table.gridtable th {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #96accd99;
					}

					table.gridtable td {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #96accd99;
					 }
			</style>
		</head>
<body>

<!--mpdf
			<htmlpageheader name="myheader">	';
			
$html=$html.'	<div align="center" style="font-size:15px" >
<p align="center" ><img src="logo1.jpg" style="height:180px;width:100%"></p>
<hr><br>
					<table width="100%"><tr>
					<td width="30%"></td>
					<td align="center"><u> '.strtoupper("Stock Report-Location Wise(RM)").' </u></td>
					<td align="right">Date : '.date('d-m-Y').'</td>
					</tr></table>
				</div>
				</htmlpageheader>
			';
	
$html = $html.'	<htmlpagefooter name="myfooter" >

 					<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 2mm; ">
					Page {PAGENO} of {nb}
					</div>

				</htmlpagefooter>	
				
					<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
					<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->		';

include("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');	
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];
	
//echo "ABCYY : ".$uloc."<Br>";

if(empty($_GET['catId']))
$catId="0";
else
$catId=$_GET['catId'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

$str=$strl="";

if($compId!='0' && $iType!='0' && $catId=='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND r.catId='$catId'";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND r.catId='$catId' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId!='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND r.catId='$catId' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId!='0' && $srch=='0')
{
	$str=$str." AND a.iType='$iType' AND r.catId='$catId' ";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else if($compId=='0' && $iType!='0' && $catId=='0' && $srch!='0')
{
	$str=$str." AND a.iType='$iType' AND (
      rg.category_nm LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' 
	  OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%')";
	$strl=$strl." AND company_id='$compId' AND iType='$iType'";
}
else	
{
	$str=$str." a.iType='$iType' ";
	$strl=$strl." AND iType='$iType' ";
}
if($uRole=='admin' && ($uiType=='3'||$uiType=='0'))
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId WHERE a.sts!='2' AND r.sts!='2' ".$str." GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";
}
else
{		
	$qq="SELECT r.focus_code,r.sage_code,CONCAT(r.description,' - ',ru.uom) AS desp FROM stock_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN category_master AS rg ON r.catId=rg.catId LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts!='2' AND r.sts!='2' ".$str." AND us.uid='$uId' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom ORDER BY SUBSTRING(r.focus_code,1,9), SUBSTRING(r.focus_code,10)*1";
}

include('mysql.connnect.php');

$html=$html. '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
<thead>
<tr style="background-color:#b02923">	
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>';
$ql="SELECT ID,loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$loc=array();
$l=0;	
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
	$loc[$l]=$row1['ID'];
	$l++;
	
	$html=$html. '<th style="color:#fff">'.$row1['loc_code']." - ".$row1['location_name'].'</th>';
}
$html=$html. '<th style="color:#fff;">Total</th>';
$html=$html.'</tr>
</thead>';	
$stmt=$mysql->prepare($qq);
$stmt->execute();
$paginationData=$stmt->fetchAll();
$cnt=1;
$a=$b=$c=$d=$e=0;	
$lcount=count($loc);
foreach ($paginationData as $row) 
{	
	//$id=$row['ID'];
	$html=$html.'<tr style="color:#000;font-weight:600;">';
	$html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['focus_code'].'</td>';
	$html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['sage_code'].'</td>';
	$html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['desp'].'</td>';

	$tot=0;
	for($i=0;$i<$lcount;$i++)
	{
		$qqq="SELECT r.focus_code,r.sage_code,r.description,ru.uom,SUM(a.stk_qty) AS stk FROM stock_tbl AS a LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE a.sts!='2' AND r.sts!='2' AND a.iType='1' AND r.focus_code='".$row['focus_code']."' AND r.sage_code='".$row['sage_code']."' AND a.locId='$loc[$i]' GROUP BY r.focus_code,r.sage_code,r.description,ru.uom";
		//if($row['focus_code']=='AC001' || $row['sage_code']=='RMSL-AC0001-000K0001')
		//$html=$html. $qqq."<Br>";
		$stl1=$mysql->prepare($qqq);
		$stl1->execute();
		$row11=$stl1->fetch(PDO::FETCH_ASSOC);
		$stk=0;
		if(!empty($row11['stk']))
		{
			$stk=$row11['stk'];
			$tot=$tot+$stk;
		}
		$html=$html. '<td style="background-color:#96accd99;color:#000">'.$stk.'</td>';
	}
	$html=$html. '<td style="background-color:#edd18361;color:#000">'.$tot.'</td>';
	$a=$a+$tot;
	$html=$html. '</tr>';  

	$cnt++;
}
$html=$html. '<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;"></th>';

$ql="SELECT loc_code,location_name FROM location_tbl WHERE sts!='2' ".$strl." ORDER BY loc_code";	
$stl=$mysql->prepare($ql);
$stl->execute();
$ct=$stl->rowCount();
$k=1;
while($row1=$stl->fetch(PDO::FETCH_ASSOC))
{
  if($k==$ct)
  {
    $html=$html. '<th style="color:#fff">Total</th> '; 
  }
  else
  {
     $html=$html. '<th style="color:#fff"></th> ';  
  }
$k++;  
}
$html=$html. '<th style="color:#fff;">'.$a.'</th>';
$html=$html.'</tr>
</tfoot>';
$html=$html. '</table>';	


$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',5,5,65,8,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Stock Report - Location Wise(RM)");
$mpdf->SetAuthor("");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoBottonMargin = 'stretch';
$mpdf->setAutoTopMargin = 'stretch';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output(); 
exit;
?>