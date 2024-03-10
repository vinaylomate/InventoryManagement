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

<!--mpdf <htmlpageheader name="myheader">';
$html=$html.'<div align="center">
<div align="center" style="font-size:20px">RITVER <span style="font-size:14px;font-weight:bold;">PAINTS & COATINGS</span></div>
<table width="100%"><tr>
<td width="30%"></td>
<td align="center"><u> '.strtoupper("Stock Entry Report").' </u></td>
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
if($lcnt==1)
{
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND c.ID='$locId'  AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND c.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND c.ID='$locId'  AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-4 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
		$str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-5 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
		//echo "Aa-6 : ".$str."<br>";
	}
	
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RM','FG ') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RM','FG ') AS iTypeNm,a.ref,a.notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_usr_loc AS us ON c.ID=us.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." AND us.uid='$uId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "B : ".$qq."<br>";
	}
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%')";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.docNo LIKE '%".$srch."%' OR b.company_code LIKE '%".$srch."%' OR b.company_name LIKE '%".$srch."%' OR c.loc_code LIKE '%".$srch."%' OR c.location_name LIKE '%".$srch."%' OR a.ref LIKE '%".$srch."%' OR a.notes LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND a.iType='$iType'  AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND b.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else 
	{
		$str=$str." AND b.ID='$compId'";
	  //echo "AA-4 : ".$str."<br>";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RM','FG ') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RM','FG ') AS iTypeNm,ref,notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RM','FG ') AS iTypeNm,a.ref,a.notes FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_usr_loc AS us ON c.ID=us.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='0' ".$str." AND us.uid='$uId' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	  //echo "AAB : ".$qq."<br>";
		}
	}
}
//$html=$html.$sql;
			$statement = $mysql->prepare($qq);
			$statement->execute();
			$paginationData=$statement->fetchAll();

			$count=1;

$html=$html.'
<table width="100%" class="gridtable" id="dataTable1"> 					
<thead>
<tr style="background-color:#b02923">
<th style="color:#000;">Date</th>
<th style="color:#000">Doc. No</th>
<!--<th style="color:#000">Company</th>-->
<th style="color:#000">Location</th>
<th style="color:#000">Product Category</th>
<th style="color:#000">Reference</th>
<th style="color:#000">Notes</th>
<th style="color:#000">No.</th>
<th style="color:#000">Focus Code</th>	
<th style="color:#000">Sage Code</th>	
<th style="color:#000">Batch / Lot No.</th>	
<th style="color:#000">Quantity</th>	
<th style="color:#000">Entry Type</th>
</tr>
</thead>"';

foreach ($paginationData as $row) 
{
  $id=$row['ID'];	
  $q="SELECT COUNT(*) AS cnt FROM inventory_info_tbl WHERE invId='$id' AND sts='0'";
  $statement2 = $mysql->prepare($q);
  $statement2->setFetchMode(PDO::FETCH_OBJ);
  $statement2->execute();
  $row2 = $statement2->fetch();
  $cnt=$row2->cnt;

  if($uRole=='admin' || $uiType=='3')
  {
    if($cnt>=1)
    {
        $q="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,b.batchNo,b.qty, e.entryNm FROM inventory_tbl AS a LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE b.invId='$id' AND b.sts='0'";
        //echo $q."<br>";
        $stmt = $mysql->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $c=0;
        while($row2 = $stmt->fetch())
        {			  
            if($row['iType']=='1')
            {
               if($c==0)
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
                $html=$html. '<td valign="top">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
                $html=$html. '<td valign="top">'.$row['docNo'].'</td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top">'.$row['loc_code'].'</td>';
                $html=$html. '<td valign="top">'.$row['iTypeNm'].'</td>';
                $html=$html. '<td valign="top">'.$row['ref'].'</td>';					  
                $html=$html. '<td valign="top">'.$row['notes'].'</td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
               else
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';					  
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
                $c++;
            }
            else
            {
               if($c==0)
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
                $html=$html. '<td valign="top">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
                $html=$html. '<td valign="top">'.$row['docNo'].'</td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top">'.$row['loc_code'].'</td>';
                $html=$html. '<td valign="top">'.$row['iTypeNm'].'</td>';	
                $html=$html. '<td valign="top">'.$row['ref'].'</td>';					  
                $html=$html. '<td valign="top">'.$row['notes'].'</td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
               else
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';	
                $html=$html. '<td valign="top"></td>';					  
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
                $c++;
            }
            $cnt++;
        }
    }
  }
  else
  {
    if($cnt>=1)
    {
        $q="SELECT IF(a.iType='1',r.focus_code,f.focus_code) AS focus_code,IF(a.iType='1',r.sage_code,f.sage_code) AS sage_code,b.batchNo,b.qty, e.entryNm FROM inventory_tbl AS a LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE b.invId='$id' AND b.sts='0'";
        //$html=$html. $q."<br>";
        $stmt = $mysql->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $c=0;
        while($row2 = $stmt->fetch())
        {			  
            if($row['iType']=='1')
            {
               if($c==0)
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
                $html=$html. '<td valign="top">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
                $html=$html. '<td valign="top">'.$row['docNo'].'</td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top">'.$row['loc_code'].'</td>';
                $html=$html. '<td valign="top">'.$row['iTypeNm'].'</td>';
                $html=$html. '<td valign="top">'.$row['ref'].'</td>';					  
                $html=$html. '<td valign="top">'.$row['notes'].'</td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
               else
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#96accd99;">';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';					  
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
                $c++;
            }
            else
            {
               if($c==0)
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
                $html=$html. '<td valign="top">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
                $html=$html. '<td valign="top">'.$row['docNo'].'</td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top">'.$row['loc_code'].'</td>';
                $html=$html. '<td valign="top">'.$row['iTypeNm'].'</td>';	
                $html=$html. '<td valign="top">'.$row['ref'].'</td>';					  
                $html=$html. '<td valign="top">'.$row['notes'].'</td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
               else
               {
                $html=$html.'<tr style="color:#000;font-weight:600;background-color:#edd18361;">';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';
                //$html=$html. '<td valign="top">'.$row['company_code'].' '.$row['company_name'].'</td>';
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top"></td>';	
                $html=$html. '<td valign="top"></td>';					  
                $html=$html. '<td valign="top"></td>';
                $html=$html. '<td valign="top">'.($c+1).'</td>';
                $html=$html. '<td valign="top">'.$row2['focus_code'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['sage_code'].'</td>';
                $html=$html. '<td valign="top">'.$row2['batchNo'].'</td>';
                $html=$html. '<td valign="top">'.$row2['qty'].'</td>';					  
                $html=$html. '<td valign="top">'.$row2['entryNm'].'</td>';
                $html=$html. '</tr>';
               }
                $c++;
            }
            $cnt++;
        }
    }
  }
}
					
					
$html=$html.'</table>';

$html = $html.'</body>';


$html = $html.'</html>';
$mysql=null;
//echo $html."<Br>";
define('_MPDF_PATH','../');
include("../mpdf.php");
//include("/var/www/vhosts/darshanuniforms.com/pr.darshanuniforms.com/mpdf/mpdf.php");

$mpdf=new mPDF('c','A4-L','','',10,5,25,10,5,5);

//('defalt','A4','font-size','font-family','margin-left','margin-right','margin-top','margin-botm','mar-head','mar-foor','L/P') 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Stock Entry Register");
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