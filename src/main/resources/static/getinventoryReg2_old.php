<?php
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


include('mysql.connect.php');
$str="";
if($lcnt==1)
{	
	if($compId!='0' && $locId!='0' && $iType!='0' && $srch=='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $iType!='0' && $srch=='0' && $fdt=='0' && $tdt=='0')
	{
		$str=$str." AND c.ID='$compId' AND a.iType='$iType'";
		//echo "AD-1".$str."<Br>";
	}
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $locId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	  //echo "AD-2".$str."<Br>";
	}		
	else if($compId!='0' && $locId=='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	  //echo "AD-2".$str."<Br>";
	}			
	else if($compId!='0' && $locId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND l.ID='$locId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	  //echo "AD-2".$str."<Br>";
	}
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	  //echo "AD-2".$str."<Br>";
	}	
	else if($compId!='0' && $locId=='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	  //echo "AD-2".$str."<Br>";
	}																		
	else 
	{
		$str=$str." AND c.ID='$compId'";
		//echo "AD-4".$str."<Br>";
	}
	//echo "<Br>";
	
    if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
	{
		$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "A : ".$qq."<br>";
	}
	else
	{
		$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='0' AND c.ID='$compId' AND a.iType='$uiType' AND a.lsts='0' AND u.uid='$uId' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "B : ".$qq."<br>";
	}
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}
else
{	
	if($compId!='0' && $srch!='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
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
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt=='0' && $tdt=='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' ";
	}
	else if($compId!='0' && $srch!='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	}
	else if($compId!='0' && $srch=='0' && $iType!='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND a.iType='$iType' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	}
	else if($compId!='0' && $srch!='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (
      IF(a.iType='1',rc.category_nm LIKE '%".$srch."%',fc.category_nm LIKE '%".$srch."%') OR
      IF(a.iType='1',r.sage_code LIKE '%".$srch."%',f.sage_code LIKE '%".$srch."%') OR
      IF(a.iType='1',r.focus_code LIKE '%".$srch."%',f.focus_code LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.description LIKE '%".$srch."%',f.descc LIKE '%".$srch."%') OR 
      IF(a.iType='1',ru.uom LIKE '%".$srch."%',fu.uom LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.reorder_level_qty LIKE '%".$srch."%',f.reorder_level_qty LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.product_expiry LIKE '%".$srch."%',f.product_expiry LIKE '%".$srch."%') OR 
      IF(a.iType='1',r.rackNo LIKE '%".$srch."%',f.rackNo LIKE '%".$srch."%') OR 
      CONCAT(c.company_code,' - ',c.company_name) LIKE '%".$srch."%' OR 
      CONCAT(l.loc_code,' - ',l.location_name) LIKE '%".$srch."%') AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	}
	else if($compId!='0' && $srch=='0' && $iType=='0' && $fdt!='0' && $tdt!='0')
	{
      $str=$str." AND c.ID='$compId' AND (a.dt BETWEEN '$fdt' AND '$tdt')";
	}
	else 
	{
		$str=$str." AND c.ID='$compId'";
	}
	
	//echo "<Br>";
	
	if($compId=='0')
	{
		$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='0' ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
	}
	else
	{
		if($uRole=='admin' && ($uiType=='3' || $uiType=='0'))
		{
			$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId WHERE a.sts='0' AND b.sts='0' AND a.lsts='0' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "A : ".$qq."<br>";
	}
		else
		{
			$qq="SELECT DATE_FORMAT(a.dt,'%d-%m-%Y') AS dt,a.iType,IF(a.iType='1','RAW MATERIAL','FINISHED GOODS') AS iTypeNm,a.compId,a.locId,l.loc_code,l.location_name,a.docNo,a.ref ,a.notes,IF(a.iType='1',r.focus_code,f.focus_code) AS fc,IF(a.iType='1',r.sage_code,f.sage_code) AS sg,IF(a.iType='1',CONCAT(r.description,' - ',ru.uom),CONCAT(f.descc,' - ',fu.uom)) AS desp,IF(b.eType='1','IN','OUT') AS EntryType,e.entryNm,b.qty AS Quantity,b.batchNo,IF(b.expdt='-','-',DATE_FORMAT(b.expdt,'%d-%m-%Y')) AS expdt FROM inventory_tbl AS a LEFT JOIN company_tbl AS c ON a.compId=c.ID LEFT JOIN location_tbl AS l ON a.locId=l.ID LEFT JOIN inventory_info_tbl AS b ON a.ID=b.invId LEFT JOIN rm_master AS r ON b.itemId=r.rmId LEFT JOIN category_master AS rc ON r.catId=rc.catId LEFT JOIN uom_tbl AS ru ON r.UOM=ru.ID LEFT JOIN fg_master AS f ON b.itemId=f.fgId LEFT JOIN category_master AS fc ON f.category_id=fc.catId LEFT JOIN uom_tbl AS fu ON f.uom=fu.ID LEFT JOIN entry_type_tbl AS e ON b.entryId=e.entryId LEFT JOIN admin_usr_loc AS u ON a.locId=u.locId WHERE a.sts='0' AND b.sts='0' AND a.lsts='0' AND c.ID='$compId' AND a.iType='$uiType' AND a.lsts='0' AND u.uid='$uId' ".$str." ORDER BY substring(a.docNo,1,9), substring(a.docNo,10)*1 DESC";
		//echo "B : ".$qq."<br>";
		}
	}
	//echo "hhh : ".$qq."<br>";
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}	
//echo $qq."<Br>";
?>
<div class="pagination">    
<?php echo $pagination; ?>
</div>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background-color:#b02923">
<th style="color:#fff;">Date</th>
<th style="color:#fff">Doc. No</th>
<!--<th style="color:#fff">Company</th>-->
<th style="color:#fff">Location</th>
<th style="color:#fff">Product Category</th>
<th style="color:#fff">Reference</th>
<!--<th style="color:#fff">Notes</th>-->
<th style="color:#fff">Focus Code</th>
<th style="color:#fff">Sage Code</th>
<th style="color:#fff">Product</th>
<th style="color:#fff">Entry Type</th>
<th style="color:#fff">Batch / Lot No.</th>
<th style="color:#fff">IN</th>
<th style="color:#fff">OUT</th>
<th style="color:#fff">Expiry Date</th>
</tr>
</thead>
<tbody>
<?php
$a=$b=0;	
foreach ($paginationData as $row) 
{
	//$id=$row['ID'];
	/*$a=$a+$row['openstk'];
	$b=$b+$row['IN_Qty'];
	$c=$c+$row['OUT_Qty'];
	$d=$d+$row['Lock_Qty'];
	$e=$e+$row['Closestk'];*/

	if($row['iType']=='1')
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['dt'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['docNo'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['loc_code'].' - '.$row['location_name'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['iTypeNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#0d69f445;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['batchNo'].'</td>';
		if($row['EntryType']=='IN')
		{
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['Quantity'].'</td>';
			$a=$a+$row['Quantity'];		  	
		}
		else
		{
			echo '<td style="background-color:#0d69f445;color:#000">0</td>';		  	
		}
		
		
		if($row['EntryType']=='OUT')
		{
			echo '<td style="background-color:#0d69f445;color:#000">'.$row['Quantity'].'</td>';	
			$b=$b+$row['Quantity'];	  	
		}
		else
		{
			echo '<td style="background-color:#0d69f445;color:#000">0</td>';		  	
		}
		echo '<td style="background-color:#0d69f445;color:#000">'.$row['expdt'].'</td>';
		echo '</tr>';  
	
	}
	else
	{
		echo'<tr style="color:#000;font-weight:600;">';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['dt'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['docNo'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['loc_code'].' - '.$row['location_name'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['iTypeNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['ref'].'</td>';
		//echo '<td style="background-color:#f4b80d61;color:#000">'.$row['notes'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['fc'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['sg'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['desp'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['entryNm'].'</td>';
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['batchNo'].'</td>';
		if($row['EntryType']=='IN')
		{
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Quantity'].'</td>';
			$a=$a+$row['Quantity'];		  	
		}
		else
		{
			echo '<td style="background-color:#f4b80d61;color:#000">0</td>';		  	
		}
		
		
		if($row['EntryType']=='OUT')
		{
			echo '<td style="background-color:#f4b80d61;color:#000">'.$row['Quantity'].'</td>';	
			$b=$b+$row['Quantity'];	  	
		}
		else
		{
			echo '<td style="background-color:#f4b80d61;color:#000">0</td>';		  	
		}
		echo '<td style="background-color:#f4b80d61;color:#000">'.$row['expdt'].'</td>';
		echo '</tr>';  
	}				  
	$cnt++;	
}	
$mysql=null;	
?>	
</tbody>
<tfoot>
<tr style="background-color:#b02923">
<th style="color:#fff;"></th>
<th style="color:#fff"></th>
<!--<th style="color:#fff">Company</th>
<th style="color:#fff"></th>-->
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff"></th>
<th style="color:#fff">Total</th>
<th style="color:#fff"><?php echo $a;?></th>
<th style="color:#fff"><?php echo $b;?></th>
<th style="color:#fff"></th>
</tr>
</tfoot>					
</table>	
<div class="pagination">    
<?php echo $pagination; ?>
</div>
 <!-- Page level plugins -->
  <!--<script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <script src="js/demo/datatables-demo.js"></script>-->