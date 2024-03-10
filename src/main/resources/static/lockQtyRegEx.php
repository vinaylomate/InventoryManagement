<?php
include ("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');
set_time_limit(0);
$filename="lockQtyRegEx_".date('d.m.Y H:i:s a').".xls";
$date=date('Y-m-d');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
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
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' ".$str." AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' AND a.lsts='1' ".$str." AND u.uid='$uId' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
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
		$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' ".$str." AND s.sts!='2' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,ref,notes ,a.salemnId,s.UserNm AS salemanNm FROM inventory_tbl AS a LEFT JOIN company_tbl AS b ON a.compId=b.ID LEFT JOIN location_tbl AS c ON a.locId=c.ID LEFT JOIN admin_tbl AS s ON a.salemnId=s.id LEFT JOIN admin_usr_loc AS u ON c.ID=u.locId WHERE a.sts!='2' AND b.sts!='2' AND c.sts!='2' AND a.lsts='1' AND s.sts!='2' AND a.lsts='1' ".$str." AND u.uid='$uId' GROUP BY a.ID,a.dt,a.compId,a.locId,a.iType,a.docNo,a.yr,a.yr2,b.company_code,b.company_name,c.loc_code,c.location_name,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS'),ref,notes ,a.salemnId,s.UserNm ORDER BY SUBSTRING(a.docNo,1,9), SUBSTRING(a.docNo,10)*1 DESC";
	  		//echo "AAB : ".$qq."<br>";
		}
	}
}	
//echo $qq."<Br>";
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<!--<th style="color:#fff">Company</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Salesman</th>
<th style="color:#fff">Reference</th>
<th style="color:#fff">Notes</th>
<th style="color:#fff">No.</th>
<th style="color:#fff">Focus Code</th>	
<th style="color:#fff">Sage Code</th>	
<th style="color:#fff">Batch / Lot No.</th>	
<th style="color:#fff">Quantity</th>	
<th style="color:#fff">Entry Type</th>
</tr>
</thead>';
$cnt=1;
$a=$b=$c=$d=$e=0;	
$stmt=$mysql->prepare($qq);
$stmt->execute();
$paginationData=$stmt->fetchAll();
foreach ($paginationData as $row) 
{
	$id=$row['ID'];	
    $q11="SELECT COUNT(*) AS cnt FROM inventory_info_tbl WHERE invId='$id' AND sts='0'";
	//echo $q11."<Br>";
    $statement21 = $mysql->prepare($q11);
    $statement21->setFetchMode(PDO::FETCH_OBJ);
    $statement21->execute();
    $row21 = $statement21->fetch();
    $cnt2=$row21->cnt;
	//echo $cnt2."<Br>";
	
    if($uRole=='admin' || $uiType=='3')
    {
	  if($cnt2>=1)
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
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['docNo'].'</td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['loc_code'].' '.$row['location_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['iTypeNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['salemanNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['ref'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['notes'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				 else
				 {
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				  $c++;
			  }
			  else
			  {
				 if($c==0)
			  	 {
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['docNo'].'</td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['loc_code'].' '.$row['location_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['iTypeNm'].'</td>';	
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['salemanNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['ref'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['notes'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				 else
				 {
				  echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';	
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				  $c++;
			  }
			  $cnt++;
		  }
	  }
    }
	else
	{
	  if($cnt2>=1)
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
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['docNo'].'</td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['loc_code'].' '.$row['location_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['iTypeNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['salemanNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['ref'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['notes'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				 else
				 {
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';						  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';			  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#0d69f445;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				  $c++;
			  }
			  else
			  {
				 if($c==0)
			  	 {
				  echo'<tr>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.date('d-m-Y',strtotime($row['dt'])).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['docNo'].'</td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['loc_code'].' '.$row['location_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['iTypeNm'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['salemanNm'].'</td>';	
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['ref'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['notes'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				 else
				 {
				  echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  //echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row['company_code'].' '.$row['company_name'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';	
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';				  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;"></td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.($c+1).'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['focus_code'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['sage_code'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['batchNo'].'</td>';
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['qty'].'</td>';					  
				  echo '<td valign="top" style="color:#000;font-weight:600;background-color:#f4b80d61;">'.$row2['entryNm'].'</td>';
				  echo '</tr>';
				 }
				  $c++;
			  }
			  $cnt++;
		  }
	  }
	}
}
echo '</table>';
$mysql=null;
?>