<?php ob_start();
include("mysql.connect.php");
date_default_timezone_set("Asia/Calcutta");
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
					color:#333333;
					border-width: 1px;
					border-color: #cdcdcd;
					border-collapse: collapse; }
					
					table.gridtable th {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #cdcdcd;
					}

					table.gridtable td {
					border-width: 1px;
					padding: 2px;
					border-style: solid;
					border-color: #cdcdcd;
					 }
			</style>
		</head>
<body>

<!--mpdf
			<htmlpageheader name="myheader">	';
$html=$html.'<div align="center">
<div align="center" style="font-size:20px">RITVER <span style="font-size:14px;font-weight:bold;">PAINTS & COATINGS</span></div>
<table width="100%"><tr>
<td width="30%"></td>
<td align="center"><u> '.strtoupper("Fast Moving Item Report").' </u></td>
<td align="right">Date : '.date('d-m-Y').'</td>
</tr></table>
</div><hr>
</htmlpageheader>';	
$html = $html.'	<htmlpagefooter name="myfooter" >

 					<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 2mm; ">
					Page {PAGENO} of {nb}
					</div>

				</htmlpagefooter>	
				
					<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
					<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->		';
$compId=$locId=$iType='0';
if(!empty($_GET['compId']))
$compId=$_GET['compId'];

if(!empty($_GET['locId']))
$locId=$_GET['locId'];

if(!empty($_GET['iType']))
$iType=$_GET['iType'];	

$uId=$_GET['uId'];
$uiType=$_GET['uiType'];
$uRole=$_GET['role'];

if(empty($_GET['uloc']))
$uloc="0";
else
$uloc=$_GET['uloc'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];

	
if(empty($_GET['fdt']))
$fdt="0";
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$tdt="0";
else
$tdt=$_GET['tdt'];

//echo $locId."<Br>";
	
if($locId==0)
{
	$lcnt=0;
	if( strpos( $uloc, ',' ) !== false )
	{
		$locId=explode(',',$uloc);
		$lcnt=count($locId);
	}
	else
	{
		$locId=$uloc;
		if($uloc!='0')
		$lcnt=1;
	}
}
else
{
	$lcnt=1;
}
$str="";
if($lcnt=='1')
{
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%')";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
		//echo "Aa-6 : ".$str."<br>";
	}

	if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		
  		$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
SUM(b.qty) AS OUT_QTY,
CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
WHERE a.sts!='2'  AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND b.qty!='0' 
  GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC
 ";

		//echo "A : ".$qq."<br>";
	}
	else
	{
		
  	$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
SUM(b.qty) AS OUT_QTY,
CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId 
 WHERE a.sts!='2' AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' AND b.qty!='0' 
 GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
	}
	
}
else
{
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%')";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%'
  OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%'
  OR rg.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%'
  OR fgg.category_nm LIKE '%".$srch."%' OR f.brand LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR
  fu.uom LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
	  //echo "AA-4 : ".$str."<br>";
	}
			if($compId=='0')
			{

				$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
				IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
				IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
				CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp,
				SUM(b.qty) AS OUT_QTY,
				CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
				LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
				 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
				 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
				 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
				 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
				 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
				 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
				 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
				 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
				 WHERE a.sts!='2' AND b.eType='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') AND b.qty!='0'
				 GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC ";

				 
			}
			else
			{
				if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
				{
					$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
						IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
						IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
						CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
						,SUM(b.qty) AS OUT_QTY,
						CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
						LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
						 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
						 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
						 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
						 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
						 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
						 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
						 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
						 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
						  WHERE a.sts!='2' AND b.eType='2' AND IF(a.iType='q',r.sts!='2',f.sts!='2') ".$str." AND b.qty!='0'
						   GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
				}
				else
				{
					$qq="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
						IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
						IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),
						CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)) AS desp
						,SUM(b.qty) AS OUT_QTY,CONCAT(l.loc_code,' - ',l.location_name)AS locNm,a.iType FROM inventory_tbl AS a
						LEFT JOIN `inventory_info_tbl` AS b ON a.ID=b.invId
						 LEFT JOIN company_tbl AS c ON a.compId=c.ID 
						 LEFT JOIN location_tbl AS l ON a.locId=l.ID 
						 LEFT JOIN rm_master AS r ON b.itemId=r.rmId 
						 LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
						 LEFT JOIN fg_master AS f ON b.itemId=f.fgId 
						 LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
						 LEFT JOIN category_master AS rg ON r.catId=rg.catId 
						 LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId
						 LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId 
						  WHERE a.sts!='2' AND b.eType='2' AND  IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' AND b.qty!='0' GROUP BY IF(a.iType='1',r.focus_code,f.focus_code), IF(a.iType='1',r.sage_code,f.sage_code), IF(a.iType='1',CONCAT(rg.category_nm,' - ',r.description,' - ',ru.uom),CONCAT(fgg.category_nm,' - ',f.brand,' ',f.descc,' - ',fu.uom)), CONCAT(l.loc_code,' - ',l.location_name) ,a.iType ORDER BY SUM(b.qty) DESC";
				}

				
			}

}
$sql=$qq;
//echo $sql."<Br>";
//$html=$html.$sql;
$statement = $mysql->prepare($sql);
$statement->execute();
$paginationData=$statement->fetchAll();
$cnt=1;
$html=$html.'
<table width="100%" class="gridtable" id="dataTable1"> 					
<thead>
<tr style="background-color:#b02923">
<th style="color:#000;">Sr.No.</th>
<th style="color:#000;">Location</th>
<th style="color:#000;">Focus Code</th>
<th style="color:#000;">Sage Code</th>
<th style="color:#000;">Product</th>
<th style="color:#000;">OUT</th>
</tr></thead><tbody>';
$a=0;
foreach ($paginationData as $row) 
{
	$a=$a+$row['OUT_QTY'];
	if($uRole=='admin' || $uiType=='3')
    {
      if($row['iType']=='1')
      {
        $html=$html. '<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
		$html=$html.' <td>'.$cnt.'</td>';
		$html=$html.' <td>'.$row['locNm'].'</td>';
		$html=$html.'<td>'.$row['focus_code'].'</td>';
		$html=$html.'<td>'.$row['sage_code'].'</td>';
		$html=$html.'<td>'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
		$html=$html.'<td>'.$row['OUT_QTY'].'</td>';
		
		$html=$html.'</tr>';  
      }
      else
      {
        $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
		$html=$html.' <td>'.$cnt.'</td>';
		$html=$html.'<td>'.$row['locNm'].'</td>';
		$html=$html.'<td>'.$row['focus_code'].'</td>';
		$html=$html.'<td>'.$row['sage_code'].'</td>';
		$html=$html.'<td>'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
		$html=$html.'<td>'.$row['OUT_QTY'].'</td>';
		
		$html=$html.'</tr>'; 
      }
      $cnt++;
    }
	else
	{
		if($row['iType']=='1')
        {
        $html=$html. '<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
		$html=$html.' <td>'.$cnt.'</td>';
		$html=$html.'<td>'.$row['locNm'].'</td>';
		$html=$html.'<td>'.$row['focus_code'].'</td>';
		$html=$html.'<td>'.$row['sage_code'].'</td>';
		$html=$html.'<td>'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
		$html=$html.'<td>'.$row['OUT_QTY'].'</td>';
		
		$html=$html.'</tr>';  
        }
        else
        {          
        $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
		$html=$html.' <td>'.$cnt.'</td>';
		$html=$html.'<td>'.$row['locNm'].'</td>';
		$html=$html.'<td>'.$row['focus_code'].'</td>';
		$html=$html.'<td>'.$row['sage_code'].'</td>';
		$html=$html.'<td>'.$row['desp'].'</td>';
		/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
		$html=$html.'<td>'.$row['OUT_QTY'].'</td>';
        }
        $cnt++;
	}
}
$html=$html."</tbody>";
$html=$html.'<tfoot>
<tr style="background-color:#b02923">
<th style="color:#000"></th>
<th style="color:#000"></th>
<th style="color:#000;"></th>
<th style="color:#000"></th>
<th style="color:#000;">Total</th>
<th style="color:#fff">'. round($a,2).'</th>
</tr></tfoot>';
$html=$html."</table>";
$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

//$mpdf=new mPDF('c','A4','','',5,5,65,10,5,5);
$mpdf=new mPDF('c','A4-L','','',10,5,25,5,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Fast Moving Item Report");
$mpdf->SetAuthor("");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = false;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
//$mdf->setAutoBottonMargin = 'stretch';
$mpdf->setAutoTopMargin = 'stretch';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output(); 
exit;
?>