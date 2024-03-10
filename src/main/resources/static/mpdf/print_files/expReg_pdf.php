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
<td align="center"><u> '.strtoupper("Product Expiry Date Report").' </u></td>
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
	
//echo "ABC : ".$locId."<Br>";
	
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
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand=='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand!='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND IF(a.iType='1',d.catId,f.category_id)='$catId' AND f.brand='$brand' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand=='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND IF(a.iType='1',d.catId,f.category_id)='$catId' ";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $catId=='0' && $brand!='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND f.brand='$brand'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $catId!='0' && $brand=='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',d.catId,f.category_id)='$catId'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	  //echo "AD-2".$str."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$std."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	  //echo "AD-3".$str."<Br>";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
		//echo "AD-4".$str."<Br>";
	}
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$str." ORDER BY a.ID";
	//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' ORDER BY a.ID";
		//echo "B : ".$qq."<br>";
	}
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND (
      IF(a.iType='1',rg.category_nm LIKE '%".$srch."%',g.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',d.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',d.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',u.uom LIKE '%".$srch."%',u2.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',d.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(b.company_code,' - ',b.company_name) LIKE '%".$srch."%' OR 
      CONCAT(c.loc_code,' - ',c.location_name) LIKE '%".$srch."%')";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId=='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType'";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId!='0' && $brand!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',d.catId,f.category_id)='$catId' AND f.brand='$brand' ";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $catId!='0' && $brand=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND IF(a.iType='1',d.catId,f.category_id)='$catId' ";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
	}
	
	//echo $str."<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ORDER BY a.ID";
		//echo "AAA : ".$qq."<Br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$str." ORDER BY a.ID";
		//echo "AA : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.docNo,a.dt,a.compId,CONCAT(b.company_code,' - ',b.company_name) AS compNm,
	a.locId,c.loc_code  AS loc,a.iType,IF(a.iType='1','RM','FG') AS iTypeNm,a.itemId,
	IF(a.iType='1',d.focus_code,f.focus_code) AS fc,IF(a.iType='1',d.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(d.description,' - ',u.uom),CONCAT(f.descc,' - ',u2.uom)) AS itemNm,IF(a.iType='1',u.uom,u2.uom) AS uom,IF(a.stk_qty='0',a.openstk,a.stk_qty) AS qty,a.expdt,a.uid,TIMESTAMPDIFF(MONTH, CURRENT_DATE(),a.expdt) AS mnt,a.batchNo FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID 
	LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN rm_master AS d ON a.itemId=d.rmId	LEFT JOIN uom_tbl AS u ON d.UOM=u.ID 
	LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN uom_tbl AS u2 ON f.uom=u2.ID LEFT JOIN category_master AS g ON f.category_id=g.catId LEFT JOIN category_master AS rg ON d.catId=rg.catId LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.out_qty='0' AND IF(a.iType='1',d.sts!='2',f.sts!='2') ".$str." AND u.uid='$uId' ORDER BY a.ID";
		//echo "BB : ".$qq."<br>";
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

$html=$html.'
<table width="100%" class="gridtable" id="dataTable1"> 					
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff">Date</th>
<!--<th style="color:#fff">Doc. No</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff;">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff">Product</th>
<th style="color:#fff">Batch No</th>
<th style="color:#fff">Qty</th>
<th style="color:#fff">Prod. Exp. Date</th>
</tr>
</thead>
<tbody>"';
$crd=date('Y-m');	
foreach ($paginationData as $row) 
{
    $id=$row['iid'];

	$expdt=date('Y-m',strtotime($row['expdt']));
	//echo "Current : ".$crd."|| Expdt : ".$expdt."<Br>";
	$date_diff = abs(strtotime($crd) - strtotime($expdt));
	$years = floor($date_diff / (365*60*60*24));
	if($crd>$expdt)
	{
	  $mnt = "-".floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
	}
	else
	{
	  $mnt = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
	}
	//echo $id." : ".$date_diff." || Year : ".$years." || Months : ".$mnt."<Br>";

	  if($mnt <=1 && $mnt<2 && $years==0)
	  {
		  $html=$html.'<tr style="color:#F00;font-weight:bold;">';
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  $html=$html.'<td>'.$row['loc'].'</td>';
		  $html=$html.'<td>'.$row['fc'].'</td>';
		  $html=$html.'<td>'.$row['sg'].'</td>';
		  $html=$html.'<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  $html=$html.'<td>'.$row['batchNo'].'</td>';				  
		  $html=$html.'<td>'.$row['qty'].'</td>';		
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  $html=$html.'</tr>';
	  }
	  else if($mnt >=2 && $mnt<3 && $years==0)
	  {
		  $html=$html.'<tr style="color:orange;font-weight:bold;">';
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  $html=$html.'<td>'.$row['loc'].'</td>';
		  $html=$html.'<td>'.$row['fc'].'</td>';
		  $html=$html.'<td>'.$row['sg'].'</td>';
		  $html=$html.'<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  $html=$html.'<td>'.$row['batchNo'].'</td>';				  
		  $html=$html.'<td>'.$row['qty'].'</td>';		
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  $html=$html.'</tr>';
	  }	
	  else if($mnt=='3' && $years==0)
	  {
		  $html=$html.'<tr style="color:#0472c9;font-weight:bold;">';
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  $html=$html.'<td>'.$row['loc'].'</td>';
		  $html=$html.'<td>'.$row['fc'].'</td>';
		  $html=$html.'<td>'.$row['sg'].'</td>';
		  $html=$html.'<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  $html=$html.'<td>'.$row['batchNo'].'</td>';				  
		  $html=$html.'<td>'.$row['qty'].'</td>';		
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  $html=$html.'</tr>';
	  }				 
	  else
	  {
		  $html=$html.'<tr style="background-color:#FFF;color:#000;font-weight:bold;">';
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  $html=$html.'<td>'.$row['loc'].'</td>';
		  $html=$html.'<td>'.$row['fc'].'</td>';
		  $html=$html.'<td>'.$row['sg'].'</td>';
		  $html=$html.'<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  $html=$html.'<td>'.$row['batchNo'].'</td>';				  
		  $html=$html.'<td>'.$row['qty'].'</td>';		
		  $html=$html.'<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  $html=$html.'</tr>';
	  }
	$cnt++;

}
$html=$html."</tbody>";

$html=$html.'</table>';
	
$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

//$mpdf=new mPDF('c','A4','','',5,5,65,10,5,5);
$mpdf=new mPDF('c','A4-L','','',10,5,25,12,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Product Expiry Report");
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