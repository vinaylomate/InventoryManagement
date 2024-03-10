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
<td align="center"><u> '.strtoupper("Non Moving Item Report").' </u></td>
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

$rep_tp=$_GET['rep_tp'];

$str=$str2=$str3="";

if($lcnt=='1')
{	
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
        $str=$str." AND a.compId='$compId' AND l.ID='$locId'  AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND a.compId='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND a.iType='$iType'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND a.compId='$compId'";
		
		$str2=$str2."";
		
		$str3=$str3."";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$uId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
		//echo "B : ".$qq."<br>";
	}
	//echo "B : ".$qq."<br>";
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
        $str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2." AND (r.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR ru.uom LIKE '%".$srch."%') ";
		
		$str3=$str3." AND (f.focus_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR fu.uom LIKE '%".$srch."%') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND a.iType='$iType'  AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      	$str=$str." AND a.compId='$compId' AND (b.dt BETWEEN '$fdt' AND '$tdt') ";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND a.compId='$compId'";
		
		$str2=$str2."";
		
		$str3=$str3."";
	  //echo "AA-4 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID WHERE a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.compId,a.locId,l.loc_code,l.location_name AS locNm,a.iType,a.itemId,SUM(b.in_qty+b.openstk) AS in_qty,SUM(a.stk_qty) AS stk_qty FROM stock_tbl AS a LEFT JOIN stock_tbl_2 AS b ON a.ID=b.stkId LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN admin_usr_loc AS u ON l.ID=u.locId WHERE u.uid='$userId' AND a.in_qty=a.stk_qty AND (a.out_qty='0' OR a.lock_qty='0') ".$str." GROUP BY a.ID,a.compId,a.locId,a.iType,a.itemId ORDER BY SUM(a.stk_qty) DESC";
	  //echo "AAB : ".$qq."<br>";
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
$cnt=1;
$html=$html.'
<table width="100%" class="gridtable" id="dataTable1"> 					
<thead>
<tr style="background-color:#b02923">
<th style="color:#000;">Location</th>
<th style="color:#000;">Focus Code</th>
<th style="color:#000">Sage Code</th>
<th style="color:#000;">Product</th>
<th style="color:#000;">Stock Qty</th>
</tr></thead><tbody>';
$a=0;
foreach ($paginationData as $row) 
{	
	if($uRole=='admin' || $uiType=='3')
    {  
		if($row['iType']=='1')
		{
			$qi="SELECT r.focus_code AS fc,r.sage_code AS sg,rc.category_nm AS catNm,r.description AS desp,ru.uom AS uom FROM rm_master AS r LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE location_id='".$row['locId']."' AND rmId='".$row['itemId']."' ".$str2." AND r.sts='0' ";
			//echo "iType : 1 = ".$row['itemId']." || ".$qi."<Br>";
			$si=$mysql->prepare($qi);
			$si->execute();
			$rowi=$si->fetch(PDO::FETCH_ASSOC);
			if(!empty($rowi['fc']))
			{
				$html=$html. '<tr style="color:#000;font-weight:bold;background-color:#96accd99;">';
				$html=$html.  '<td style="font-weight:bold;">'.$row['locNm'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['fc'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['sg'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['desp'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$row['stk_qty'].'</td>';		
				$html=$html.  '</tr>';  
				$a=$a+$row['stk_qty'];				  
				$cnt++; 
			}
		}
		else
		{
			$qi="SELECT f.focus_code AS fc,f.sage_code AS sg,fc.category_nm AS catNm,f.descc AS desp,fu.uom AS uom FROM fg_master AS f LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE location_id='".$row['locId']."' AND fgId='".$row['itemId']."' ".$str3." AND f.sts='0'";
			/*if($row['itemId']=='30780' || $row['itemId']=='30671')
			{
				echo "iType : 2 = ".$row['itemId']." || ".$qi."<Br>";
			}*/
			$si=$mysql->prepare($qi);
			$si->execute();
			$rowi=$si->fetch(PDO::FETCH_ASSOC);
			if(!empty($rowi['fc']) || $rowi['fc']=='0')
			{
				$html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
				$html=$html. '<td style="font-weight:bold;">'.$row['locNm'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['fc'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['sg'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['desp'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$row['stk_qty'].'</td>';		
				$html=$html. '</tr>';
				$a=$a+$row['stk_qty']; 				  
				$cnt++; 
			}
		}
    }
	else
	{
		if($row['iType']=='1')
		{
			$qi="SELECT r.focus_code AS fc,r.sage_code AS sg,rc.category_nm AS catNm,r.description AS desp,ru.uom AS uom FROM rm_master AS r LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID WHERE location_id='".$row['locId']."' AND rmId='".$row['itemId']."' ".$str2." AND r.sts='0' ";
			//echo "iType : 1 = ".$row['itemId']." || ".$qi."<Br>";
			$si=$mysql->prepare($qi);
			$si->execute();
			$rowi=$si->fetch(PDO::FETCH_ASSOC);
			if(!empty($rowi['fc']))
			{
				$html=$html. '<tr style="color:#000;background-color:#96accd99;">';
				$html=$html.  '<td style="font-weight:bold;">'.$row['locNm'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['fc'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['sg'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$rowi['desp'].'</td>';
				$html=$html.  '<td style="font-weight:bold;">'.$row['stk_qty'].'</td>';		
				$html=$html.  '</tr>';  
				$a=$a+$row['stk_qty'];				  
				$cnt++; 
			}
		}
		else
		{
			$qi="SELECT f.focus_code AS fc,f.sage_code AS sg,fc.category_nm AS catNm,f.descc AS desp,fu.uom AS uom FROM fg_master AS f LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE location_id='".$row['locId']."' AND fgId='".$row['itemId']."' ".$str3." AND f.sts='0'";
			/*if($row['itemId']=='30780' || $row['itemId']=='30671')
			{
				echo "iType : 2 = ".$row['itemId']." || ".$qi."<Br>";
			}*/
			$si=$mysql->prepare($qi);
			$si->execute();
			$rowi=$si->fetch(PDO::FETCH_ASSOC);
			if(!empty($rowi['fc']) || $rowi['fc']=='0')
			{
				$html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
				$html=$html. '<td style="font-weight:bold;">'.$row['locNm'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['fc'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['sg'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$rowi['desp'].'</td>';
				$html=$html. '<td style="font-weight:bold;">'.$row['stk_qty'].'</td>';		
				$html=$html. '</tr>';
				$a=$a+$row['stk_qty']; 				  
				$cnt++; 
			}
		}
	}
}
$html=$html."</tbody>";
$html=$html.'<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;" align="center"></th>
<th style="color:#fff;" align="center"></th>
<th style="color:#fff" align="center"></th>
<th style="color:#000" align="right">Total</th>
<th style="color:#000" align="left">'.$a.'</th>
</tr>
</tfoot>';
$html=$html."</table>";
$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

//$mpdf=new mPDF('c','A4','','',5,5,65,10,5,5);
$mpdf=new mPDF('c','A4','','',10,5,25,5,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Non Moving Item Report");
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