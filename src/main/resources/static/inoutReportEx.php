<?php
include ("mysql.connect.php");
date_default_timezone_set('Asia/Calcutta');
set_time_limit(0);
$filename="inoutReportEx_".date('d.m.Y H:i:s a').".xls";
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
$fdt=date('Y-m-d');
else
$fdt=$_GET['fdt'];

if(empty($_GET['tdt']))
$fdt=date('Y-m-d');
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


include('mysql.connect.php');
$str="";
if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' ";
		//echo "Aa-1 : ".$str."<br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%')";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%')";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%')";
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
      $str=$str." AND c.ID='$compId' AND l.ID='$locId'  AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-2 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
		//echo "Aa-3 : ".$str."<br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
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
	
	//echo "<Br>";
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT a.compId,a.iType,IF(a.iType='1' , 'RAW MATERIAL','FINISHED GOODS') AS iTypeNm,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',r.description,f.descc) AS desp,SUM(a.openstk) AS opstk,SUM(IF(a.rsts='0','0',a.lock_qty)+in_qty) AS inq,SUM(out_qty)AS outq,SUM(a.lock_qty) AS lockq,a.locId,a.itemId FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS c ON a.compId=c.Id LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts='0' AND a.itemId!='0' ".$str." GROUP BY a.compId,a.iType,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),a.locId,a.itemId";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT a.compId,a.iType,IF(a.iType='1' , 'RAW MATERIAL','FINISHED GOODS') AS iTypeNm,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',r.description,f.descc) AS desp,SUM(a.openstk) AS opstk,SUM(IF(a.rsts='0','0',a.lock_qty)+in_qty) AS inq,SUM(out_qty)AS outq,SUM(a.lock_qty) AS lockq,a.locId,a.itemId FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS c ON a.compId=c.Id LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts='0' AND a.itemId!='0'  AND us.uid='$uId' ".$str." GROUP BY a.compId,a.iType,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),a.locId,a.itemId";
		//echo "B : ".$qq."<br>";
	}
	//echo "III : ".$qq."<br>";
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%')";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%')";
	  //echo "AA-2 : ".$str."<br>";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
	  //echo "AA-3 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
	  //echo "AA-1 : ".$str."<br>";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (c.company_code LIKE '%".$srch."%' OR c.company_name LIKE '%".$srch."%' OR l.loc_code LIKE '%".$srch."%' OR l.location_name LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%' OR r.focus_code LIKE '%".$srch."%' OR f.focus_code LIKE '%".$srch."%' OR r.sage_code LIKE '%".$srch."%' OR f.sage_code LIKE '%".$srch."%' OR r.description LIKE '%".$srch."%' OR f.descc LIKE '%".$srch."%' OR  f.brand LIKE '%".$srch."%' OR rc.category_nm LIKE '%".$srch."%' OR fc.category_nm LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt') ";
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
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT a.compId,a.iType,IF(a.iType='1' , 'RAW MATERIAL','FINISHED GOODS') AS iTypeNm,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',r.description,f.descc) AS desp,SUM(a.openstk) AS opstk,SUM(IF(a.rsts='0','0',a.lock_qty)+in_qty) AS inq,SUM(out_qty)AS outq,SUM(a.lock_qty) AS lockq,a.locId,a.itemId FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS c ON a.compId=c.Id LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts='0' AND a.itemId!='0' GROUP BY a.compId,a.iType,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),a.locId,a.itemId";
	  //echo "AAC : ".$qq."<br>";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT a.compId,a.iType,IF(a.iType='1' , 'RAW MATERIAL','FINISHED GOODS') AS iTypeNm,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',r.description,f.descc) AS desp,sum(a.openstk) AS opstk, SUM(in_qty) AS inq,SUM(out_qty)AS outq,SUM(IF(a.rsts='1','0',lock_qty)) AS lockq,a.locId,a.itemId FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS c ON a.compId=c.Id LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID WHERE a.sts='0' AND a.itemId!='0' ".$str." GROUP BY a.compId,a.iType,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),a.locId,a.itemId,a.locId,a.itemId";
	  		//echo "AABB : ".$qq."<br>";
		}
		else
		{
			$qq="SELECT a.compId,a.iType,IF(a.iType='1' , 'RAW MATERIAL','FINISHED GOODS') AS iTypeNm,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',r.description,f.descc) AS desp,SUM(a.openstk) AS opstk,SUM(IF(a.rsts='0','0',a.lock_qty)+in_qty) AS inq,SUM(out_qty)AS outq,SUM(a.lock_qty) AS lockq,a.locId,a.itemId FROM stock_tbl_2 AS a LEFT JOIN company_tbl AS c ON a.compId=c.Id LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN rm_master AS r ON a.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON a.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN admin_usr_loc AS us ON l.ID=us.locId WHERE a.sts='0' AND a.itemId!='0'  AND us.uid='$uId' ".$str." GROUP BY a.compId,a.iType,c.company_name,l.loc_code,l.location_name,IF(a.iType='1',r.focus_code,f.focus_code),IF(a.iType='1',r.sage_code,f.sage_code),IF(a.iType='1',r.description,f.descc),a.locId,a.itemId";
	  //echo "AAB : ".$qq."<br>";
		}
	}
	//echo "hhh : ".$qq."<br>";
}		
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Focus Code</th>
<th style="color:#fff">Sage Code</th>	
<th style="color:#fff">Proudct</th>		
<th style="color:#fff">Opening Stock</th>	
<th style="color:#fff">IN</th>
<th style="color:#fff">OUT</th>	
<th style="color:#fff">Closing Stock</th>
</tr>
</thead>';
$cnt=1;
$a=$b=$c=$d=$e=0;	
$stmt=$mysql->prepare($qq);
$stmt->execute();
$paginationData=$stmt->fetchAll();
foreach ($paginationData as $row) 
{
	$itemId=$row['itemId'];
	$qqOp="SELECT oqty FROM stock_op_tbl WHERE compId='".$row['compId']."' AND locId='".$row['locId']."' AND iType='".$row['iType']."' AND itemId='".$row['itemId']."' AND cdt='$fdt'";
	//if($row['fc']=='NC0003')
	//echo $qqOp."<Br>";
	$st1=$mysql->prepare($qqOp);
	$st1->execute();
	$rw1=$st1->fetch(PDO::FETCH_ASSOC);
	$opstk=0;
    if(!empty($rw1['oqty']))
    $opstk=$rw1['oqty'];
	else	
    $opstk=$row['opstk'];	
	
	if($uRole=='admin' || $uiType=='3')
    {
      if($row['iType']=='1')
      {
          echo'<tr style="color:#000;font-weight:600;background-color:#0d69f445;">';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
          echo '<td>'.$row['fc'].'</td>';					  
          echo '<td>'.$row['sg'].'</td>';							  
          echo '<td>'.$row['desp'].'</td>';							  
          echo '<td>'.$opstk.'</td>';		
		  
		  if($row['inq']=='0')
		  $inq=0;
		  else
		  $inq=$row['inq'];
		  
          echo '<td>'.$inq.'</td>';							  
          echo '<td>'.($row['outq']+$row['lockq']).'</td>';	
		  $stk=0;
		  $stk=($opstk+$inq)-($row['outq']+$row['lockq']);					  
          echo '<td>'.$stk.'</td>';						  					  
          
          echo '</tr>';
		  $a=$a+$inq;
		  $b=$b+($row['outq']+$row['lockq']);
		  $c=$c+$stk;
      }
      else
      {
          echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
          echo '<td>'.$row['fc'].'</td>';					  
          echo '<td>'.$row['sg'].'</td>';							  
          echo '<td>'.$row['desp'].'</td>';							  
          echo '<td>'.$opstk.'</td>';		
		  
		  if($row['inq']=='0')
		  $inq=0;
		  else
		  $inq=$row['inq'];
		  
          echo '<td>'.$inq.'</td>';							  
          echo '<td>'.($row['outq']+$row['lockq']).'</td>';	
		  $stk=0;
		  $stk=($opstk+$inq)-($row['outq']+$row['lockq']);	
		  //echo $opstk." : ".$inq." : ".$row['outq']." : ".$row['lockq']."<Br>";
          echo '<td>'.$stk.'</td>';						  					  
          
          echo '</tr>';
		  $a=$a+$inq;
		  $b=$b+($row['outq']+$row['lockq']);
		  $c=$c+$stk;
      }
      $cnt++;
    }
	else
	{
		if($row['iType']=='1')
        {
          echo'<tr style="color:#000;font-weight:600;background-color:#0d69f445;">';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
          echo '<td>'.$row['fc'].'</td>';					  
          echo '<td>'.$row['sg'].'</td>';							  
          echo '<td>'.$row['desp'].'</td>';							  
          echo '<td>'.$opstk.'</td>';		
		  
		  if($row['inq']=='0')
		  $inq=0;
		  else
		  $inq=$row['inq'];
		  
          echo '<td>'.$inq.'</td>';							  
          echo '<td>'.($row['outq']+$row['lockq']).'</td>';	
		  $stk=0;
		  $stk=($opstk+$inq)-($row['outq']+$row['lockq']);						  
          echo '<td>'.$stk.'</td>';						  					  
          
          echo '</tr>';
		  $a=$a+$inq;
		  $b=$b+($row['outq']+$row['lockq']);
		  $c=$c+$stk;
        }
        else
        {
          echo'<tr style="color:#000;font-weight:600;background-color:#f4b80d61;">';
          echo '<td>'.$row['loc_code'].' '.$row['location_name'].'</td>';
          echo '<td>'.$row['iTypeNm'].'</td>';
          echo '<td>'.$row['fc'].'</td>';					  
          echo '<td>'.$row['sg'].'</td>';							  
          echo '<td>'.$row['desp'].'</td>';							  
          echo '<td>'.$opstk.'</td>';		
		  
		  if($row['inq']=='0')
		  $inq=0;
		  else
		  $inq=$row['inq'];
		  
          echo '<td>'.$inq.'</td>';							  
          echo '<td>'.($row['outq']+$row['lockq']).'</td>';	
		  $stk=0;
		  $stk=($opstk+$inq)-($row['outq']+$row['lockq']);						  
          echo '<td>'.$stk.'</td>';							  					  
          
          echo '</tr>';
		  $a=$a+$inq;
		  $b=$b+($row['outq']+$row['lockq']);
		  $c=$c+$stk;
        }
        $cnt++;
	}
}
echo '<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>	
<th style="color:#fff"></th>
<th style="color:#fff">Total</th>
<th style="color:#fff">'.$a.'</th>
<th style="color:#fff;">'.$b.'</th>
<th style="color:#fff"></th>
</tr>	
</tfoot>';
echo '</table>';
$mysql=null;
?>