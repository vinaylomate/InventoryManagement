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
<td align="center"><u> '.strtoupper("Re - Order(Stock)Report").' </u></td>
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

include("mysql.connect.php");
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
	
//echo "ABCYY : ".$uloc."<Br>";

if(empty($_GET['catId']))
$catId="0";
else
$catId=$_GET['catId'];

if(empty($_GET['brand']))
$brand="0";
else
$brand=$_GET['brand'];

if(empty($_GET['srch']))
$srch="0";
else
$srch=$_GET['srch'];
	
if($locId=='0')
{
	$lcnt=0;
	if( strpos( $uloc, ',' ) !== false )
	{
		$locId=explode(',',$uloc);
		$lcnt=count($locId);
	}
	else
	{
		if($uloc=='0')
		$locId="0";
		
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

if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	  //echo "AD-2".$str."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-1".$str."<Br>";
	}	
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND l.ID='$locId' AND f.brand='$brand' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId-='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand!='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType' AND f.brand='$brand' ";
		//echo "AD-1".$str."<Br>";
	}					
	else 
	{
		$str=$str." AND c.ID='$compId'";
		//echo "AD-4".$str."<Br>";
	}
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),
CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,
a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,
a.stk_qty AS Closestk,
IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,
l.loc_code AS locNm 
FROM stock_tbl AS a 
LEFT JOIN company_tbl AS c ON a.compId=c.ID 
LEFT JOIN location_tbl AS l ON a.locId=l.ID 
LEFT JOIN rm_master AS r ON a.itemId=r.rmId 
LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
LEFT JOIN category_master AS rg ON r.catId=rg.catId 
LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str."  AND (a.stk_qty<(IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty))) ORDER BY a.ID";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),
CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,
a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,
a.stk_qty AS Closestk,
IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,
l.loc_code AS locNm 
FROM stock_tbl AS a 
LEFT JOIN company_tbl AS c ON a.compId=c.ID 
LEFT JOIN location_tbl AS l ON a.locId=l.ID 
LEFT JOIN rm_master AS r ON a.itemId=r.rmId 
LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
LEFT JOIN category_master AS rg ON r.catId=rg.catId 
LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId 
WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId'  AND (a.stk_qty<(IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty))) ORDER BY a.ID";
		//echo "B : ".$qq."<br>";
	}
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',fgg.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%')";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' AND f.brand='$brand' ";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',r.catId,f.category_id)='$catId' ";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId=='0' && $brand!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND f.brand='$brand' ";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),
CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,
a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,
a.stk_qty AS Closestk,
IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,
l.loc_code AS locNm 
FROM stock_tbl AS a 
LEFT JOIN company_tbl AS c ON a.compId=c.ID 
LEFT JOIN location_tbl AS l ON a.locId=l.ID 
LEFT JOIN rm_master AS r ON a.itemId=r.rmId 
LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
LEFT JOIN category_master AS rg ON r.catId=rg.catId 
LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2')  AND (a.stk_qty<(IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty))) ORDER BY a.ID";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
		$qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),
CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,
a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,
a.stk_qty AS Closestk,
IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,
l.loc_code AS locNm 
FROM stock_tbl AS a 
LEFT JOIN company_tbl AS c ON a.compId=c.ID 
LEFT JOIN location_tbl AS l ON a.locId=l.ID 
LEFT JOIN rm_master AS r ON a.itemId=r.rmId 
LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
LEFT JOIN category_master AS rg ON r.catId=rg.catId 
LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str."  AND (a.stk_qty<(IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty))) ORDER BY a.ID";
		//echo "A : ".$qq."<br>";
	}
		else
		{
		$qq="SELECT a.ID,a.iType,IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,
IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,
IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),
CONCAT(f.descc,' - ',fu.uom)) AS desp,'0' AS openstk,
a.in_qty AS IN_Qty,a.out_qty AS OUT_Qty,a.lock_qty AS Lock_Qty,
a.stk_qty AS Closestk,
IF(a.iType='1',r.rackNo,f.rackNo) AS rack,IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty) rorder,
l.loc_code AS locNm 
FROM stock_tbl AS a 
LEFT JOIN company_tbl AS c ON a.compId=c.ID 
LEFT JOIN location_tbl AS l ON a.locId=l.ID 
LEFT JOIN rm_master AS r ON a.itemId=r.rmId 
LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID 
LEFT JOIN fg_master AS f ON a.itemId=f.fgId 
LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID 
LEFT JOIN category_master AS rg ON r.catId=rg.catId 
LEFT JOIN category_master AS fgg ON f.category_id=fgg.catId 
LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId 
WHERE a.sts!='2' AND IF(a.iType='1',r.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId'  AND (a.stk_qty<(IF(a.iType='1',r.reorder_level_qty,f.reorder_level_qty))) ORDER BY a.ID";
		//echo "B : ".$qq."<br>";
		}
	}
	//echo "hhh : ".$qq."<br>";
}			
										
$sql=$qq;
//echo $sql."<Br>";
//$html=$html.$sql;
$statement = $mysql->prepare($sql);
$statement->execute();
$paginationData=$statement->fetchAll();
$count=1;
set_time_limit(0);
$html=$html.'
<table width="100%" class="gridtable" id="dataTable1"> 					
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff;">Product</th>
<!--<th style="color:#fff">Opening Stock</th>-->
<th style="color:#fff;">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff;">Lock Qty</th>
<th style="color:#fff;"><!--Closing-->Avail. Stock</th>
<th style="color:#fff">Re - Order Level</th>
<th style="color:#fff">Re - Order Req.</th>
<th style="color:#fff">Rack No.</th>
</tr>
</thead>
<tbody>"';
$a=$b=$c=$d=$e=0;	
foreach ($paginationData as $row) 
{
    if($row['Closestk']<$row['rorder'])
	{
		//$id=$row['ID'];
		$a=$a+$row['openstk'];
		$b=$b+$row['IN_Qty'];
		$c=$c+$row['OUT_Qty'];
		$d=$d+$row['Lock_Qty'];
		$e=$e+$row['Closestk'];
		if($row['iType']=='1')
		{
			 $html=$html.'<tr style="color:#000;font-weight:600;">';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['locNm'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['focus_code'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['sage_code'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['desp'].'</td>';
			/*echo '<td style="background-color:#0d69f445;color:#000">'.$row['openstk'].'</td>';*/
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['IN_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['OUT_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['Lock_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['Closestk'].'</td>';
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['rorder'].'</td>';
			if($row['Closestk']<$row['rorder'])
			{
			   $html=$html. '<td style="background-color:#96accd99;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			   $html=$html. '<td style="background-color:#96accd99;color:#000">No</td>';  
			}
			 $html=$html. '<td style="background-color:#96accd99;color:#000">'.$row['rack'].'</td>';
			 $html=$html. '</tr>';  
		}
		else
		{
			 $html=$html.'<tr style="color:#000;font-weight:600;">';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['locNm'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['focus_code'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['sage_code'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['desp'].'</td>';
			/*echo '<td style="background-color:#f4b80d61;color:#000">'.$row['openstk'].'</td>';*/
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['IN_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['OUT_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['Lock_Qty'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['Closestk'].'</td>';
			 $html=$html. '<td style="background-color:#edd18361;color:#000">'.$row['rorder'].'</td>';
			if($row['Closestk']<$row['rorder'])
			{
			   $html=$html. '<td style="background-color:#edd18361;color:#F00;font-weight:bold;">Yes</td>';
			}
			else
			{
			   $html=$html.'<td style="background-color:#edd18361;color:#000">No</td>';  
			}
			 $html=$html.'<td style="background-color:#edd18361;color:#000">'.$row['rack'].'</td>';
			 $html=$html.'</tr>';  
		}				  
		 $count++;
	}
}
$html=$html."</tbody>";
$html=$html.'<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff;">Total</th>
<th style="color:#fff">'. round($b,2).'</th>
<th style="color:#fff;">'. round($c,2).'</th>
<th style="color:#fff">'.round($d,2).'</th>
<th style="color:#fff;">'.round($e,2).'</th>
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<!--<th style="color:#fff"></th>-->
</tr>
</tfoot>';
$html=$html.'</table>';
	
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
$mpdf->SetTitle("Re-Order Stock Report");
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