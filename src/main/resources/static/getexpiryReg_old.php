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

include('mysql.connect.php');
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
	
	include('shripage.php');
    $totalRecordsPerPage=500;
    $paginationData=pagination_records($totalRecordsPerPage,$qq);
    //print_r($paginationData);
    $sn=pagination_records_counter($totalRecordsPerPage);
    $cnt=$sn;	
    $pagination=pagination($totalRecordsPerPage,$qq);
}	
?>
<div class="pagination">    
<?php echo $pagination; ?>
</div>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
<?php 

include('mysql.connect.php');
$cnt=1;
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
		  echo'<tr style="color:#F00;font-weight:bold;">';
		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  echo '<td>'.$row['loc'].'</td>';
		  echo '<td>'.$row['fc'].'</td>';
		  echo '<td>'.$row['sg'].'</td>';
		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  echo '<td>'.$row['batchNo'].'</td>';				  
		  echo '<td>'.$row['qty'].'</td>';		
		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  echo '</tr>';
	  }
	  else if($mnt >=2 && $mnt<3 && $years==0)
	  {
		  echo'<tr style="color:orange;font-weight:bold;">';
		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  echo '<td>'.$row['loc'].'</td>';
		  echo '<td>'.$row['fc'].'</td>';
		  echo '<td>'.$row['sg'].'</td>';
		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  echo '<td>'.$row['batchNo'].'</td>';				  
		  echo '<td>'.$row['qty'].'</td>';		
		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  echo '</tr>';
	  }	
	  else if($mnt=='3' && $years==0)
	  {
		  echo'<tr style="color:#0472c9;font-weight:bold;">';
		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  echo '<td>'.$row['loc'].'</td>';
		  echo '<td>'.$row['fc'].'</td>';
		  echo '<td>'.$row['sg'].'</td>';
		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  echo '<td>'.$row['batchNo'].'</td>';				  
		  echo '<td>'.$row['qty'].'</td>';		
		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  echo '</tr>';
	  }				 
	  else
	  {
		  echo'<tr style="background-color:#FFF;color:#000;font-weight:bold;">';
		  echo '<td>'.date('d-m-Y',strtotime($row['dt'])).'</td>';
		  echo '<td>'.$row['loc'].'</td>';
		  echo '<td>'.$row['fc'].'</td>';
		  echo '<td>'.$row['sg'].'</td>';
		  echo '<td>'.$row['itemNm'].' - '.$row['uom'].'</td>';
		  echo '<td>'.$row['batchNo'].'</td>';				  
		  echo '<td>'.$row['qty'].'</td>';		
		  echo '<td>'.date('d-m-Y',strtotime($row['expdt'])).'</td>';
		  echo '</tr>';
	  }
	$cnt++;

}
$mysql=null;
?>
<tbody>
</tbody>
</table>
<!-- Page level plugins -->
<!--<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>-->